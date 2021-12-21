<?php
namespace app\utils;

require __DIR__ . '/../vendor/autoload.php';

use Google\Auth\CredentialsLoader;
use Google\Auth\OAuth2;
use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\v201809\cm\OrderBy;
use Google\AdsApi\AdWords\v201809\cm\Paging;
use Google\AdsApi\AdWords\v201809\cm\Selector;
use Google\AdsApi\AdWords\v201809\cm\SortOrder;
use Google\AdsApi\AdWords\v201809\mcm\ManagedCustomer;
use Google\AdsApi\AdWords\v201809\mcm\ManagedCustomerService;
use Google\AdsApi\Common\OAuth2TokenBuilder;

class GoogleApi
{
    const PAGE_LIMIT = 500;

    /**
     * @var string the OAuth2 scope for the AdWords API
     * @see https://developers.google.com/adwords/api/docs/guides/authentication#scope
     */
    const ADWORDS_API_SCOPE = 'https://www.googleapis.com/auth/adwords';

    /**
     * @var string the OAuth2 scope for the Ad Manger API
     * @see https://developers.google.com/ad-manager/docs/authentication#scope
     */
    const AD_MANAGER_API_SCOPE = 'https://www.googleapis.com/auth/dfp';

    /**
     * @var string the Google OAuth2 authorization URI for OAuth2 requests
     * @see https://developers.google.com/identity/protocols/OAuth2InstalledApp#formingtheurl
     */
    const AUTHORIZATION_URI = 'https://accounts.google.com/o/oauth2/v2/auth';

    /**
     * @var string the redirect URI for OAuth2 installed application flows
     * @see https://developers.google.com/identity/protocols/OAuth2InstalledApp#formingtheurl
     */
    const REDIRECT_URI = 'https://dev.convrsus.ai/~estevar/convrsusV1/web/google-actions/getrefreshtoken';
    

    const CLIENT_ID = "130187367003-rrae1b66bhu6ncc8aj027uub94m9s7mk.apps.googleusercontent.com";
    const CLIENT_SECRET = "JmyatyI8TXcK0x7rkCJ3Tk3P";
    const DEVELOPER_TOKEN = "1JF6V5krOpWkuddPo7DKuw";

    var $session = null;

    function __construct($userID = null){
        $refresh_token = "1//0fK13KtZtl2AoCgYIARAAGA8SNwF-L9IrPBU0dp-2IuuPfmgQX69GD4cEldEtolcYt0Jc5Gb_ko4aSm-aiGq1N9zXkioVxXwxJRQ";
        $oAuth2Credential = (new OAuth2TokenBuilder())->withClientId(self::CLIENT_ID)->withClientSecret(self::CLIENT_SECRET)->withRefreshToken($refresh_token)->build();
        $this->session = (new AdWordsSessionBuilder())->withOAuth2Credential($oAuth2Credential)->withDeveloperToken(self::DEVELOPER_TOKEN)->build();
    }

    public static function login()
    {
        $oauth2 = new OAuth2(
            [
                'authorizationUri' => self::AUTHORIZATION_URI,
                'redirectUri' => self::REDIRECT_URI,
                'tokenCredentialUri' => CredentialsLoader::TOKEN_CREDENTIAL_URI,
                'clientId' => self::CLIENT_ID,
                'clientSecret' => self::CLIENT_SECRET,
                'scope' => self::ADWORDS_API_SCOPE
            ]
        );

        header("Location: " . $oauth2->buildFullAuthorizationUri());
        die();
    }

    public static function getRefreshTocken($code)
    {
        $oauth2 = new OAuth2(
            [
                'authorizationUri' => self::AUTHORIZATION_URI,
                'redirectUri' => self::REDIRECT_URI,
                'tokenCredentialUri' => CredentialsLoader::TOKEN_CREDENTIAL_URI,
                'clientId' => self::CLIENT_ID,
                'clientSecret' => self::CLIENT_SECRET,
                'scope' => self::ADWORDS_API_SCOPE
            ]
        );

        $oauth2->setCode($code);
        $authToken = $oauth2->fetchAuthToken();
        return $authToken;
    }

    public function getAccountHierachi()
    {
        $adWordsServices = new AdWordsServices();
        $managedCustomerService = $adWordsServices->get(
            $this->session,
            ManagedCustomerService::class
        );

        // Create selector.
        $selector = new Selector();
        $selector->setFields(['CustomerId', 'Name']);
        $selector->setOrdering([new OrderBy('CustomerId', SortOrder::ASCENDING)]);
        $selector->setPaging(new Paging(0, self::PAGE_LIMIT));

        // Maps from customer IDs to accounts and links.
        $customerIdsToAccounts = [];
        $customerIdsToChildLinks = [];
        $customerIdsToParentLinks = [];

        $totalNumEntries = 0;
        do {
            // Make the get request.
            $page = $managedCustomerService->get($selector);

            // Create links between manager and clients.
            if ($page->getEntries() !== null) {
                $totalNumEntries = $page->getTotalNumEntries();
                if ($page->getLinks() !== null) {
                    foreach ($page->getLinks() as $link) {
                        // Cast the indexes to string to avoid the issue when 32-bit PHP
                        // automatically changes the IDs that are larger than the 32-bit max
                        // integer value to negative numbers.
                        $managerCustomerId = strval($link->getManagerCustomerId());
                        $customerIdsToChildLinks[$managerCustomerId][] = $link;
                        $clientCustomerId = strval($link->getClientCustomerId());
                        $customerIdsToParentLinks[$clientCustomerId] = $link;
                    }
                }
                foreach ($page->getEntries() as $account) {
                    $customerIdsToAccounts[strval($account->getCustomerId())] = $account;
                }
            }

            // Advance the paging index.
            $selector->getPaging()->setStartIndex(
                $selector->getPaging()->getStartIndex() + self::PAGE_LIMIT
            );
        } while ($selector->getPaging()->getStartIndex() < $totalNumEntries);

        // Find the root account.
        $rootAccount = null;
        foreach ($customerIdsToAccounts as $account) {
            if (!array_key_exists(
                $account->getCustomerId(),
                $customerIdsToParentLinks
            )) {
                $rootAccount = $account;
                break;
            }
        }
        if ($rootAccount !== null) {
            // Display results.
           $accountsHierachi = [];
           $this->printAccountHierarchy(
                $rootAccount,
                $customerIdsToAccounts,
                $customerIdsToChildLinks,
                null,
                $accountsHierachi
            );
            return $accountsHierachi;
            /*$result_array = [];
            $ids = [];
            $new_id = 0;
            $depth = 0;
            foreach($accountsHierachi as $key => $cur_account){
                if($new_id==0){
                    $new_id = $cur_account['CustomerID'];
                    $result_array[$new_id] = ["AccountName"=>$cur_account["AccountName"]];
                }
                else if($depth < $cur_account['depth']){
                    $depth = $cur_account['depth'];
                    array_push($ids, $new_id);
                    $new_id = $cur_account['CustomerID'];
                }
                else if($depth > $cur_account['depth']){
                    $depth = $cur_account['depth'];
                    $new_id = array_pop($ids);
                }
                else{

                }
                
            }/**/
        } else {
            return [];
        }
    }

    public function printAccountHierarchy(
        $account,
        $customerIdsToAccounts,
        $customerIdsToChildLinks,
        $depth = null,
        &$accountsHierachi
    ) {
        if ($depth === null) {
            //echo "(Customer ID, Account Name)<br>";
            $this->printAccountHierarchy(
                $account,
                $customerIdsToAccounts,
                $customerIdsToChildLinks,
                0,
                $accountsHierachi
            );

            return $accountsHierachi;
        }

        $customerId = $account->getCustomerId();
        $_account = ["CustomerId"=>$customerId, "AccountName"=>$account->getName(), "Accounts"=>[]];
        

        if (array_key_exists($customerId, $customerIdsToChildLinks)) {
            foreach ($customerIdsToChildLinks[strval($customerId)] as $childLink) {
                $childAccount = $customerIdsToAccounts[strval($childLink->getClientCustomerId())];
                $this->printAccountHierarchy(
                    $childAccount,
                    $customerIdsToAccounts,
                    $customerIdsToChildLinks,
                    $depth + 1,
                    $_account["Accounts"]
                );
            }
        }
        $accountsHierachi[] = $_account;
    }

}