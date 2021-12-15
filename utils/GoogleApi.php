<?php
namespace app\utils;

require __DIR__ . '/../vendor/autoload.php';

use Google\Auth\CredentialsLoader;
use Google\Auth\OAuth2;

class GoogleApi
{
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
    const REDIRECT_URI = 'https://dev.convrsus.ai/convrsusV1/web/index.php?r=google-actions/getrefreshtoken';
    

    const CLIENT_ID = "130187367003-rrae1b66bhu6ncc8aj027uub94m9s7mk.apps.googleusercontent.com";
    const CLIENT_SECRET = "JmyatyI8TXcK0x7rkCJ3Tk3P";
    const DEVELOPER_TOKEN = "1JF6V5krOpWkuddPo7DKuw";

    var $session = null;

    function __contruct($userID){

        $oAuth2Credential = (new OAuth2TokenBuilder())->withClientId($this->CLIENT_ID)->withClientSecret($this->CLIENT_SECRET)->withRefreshToken($this->refresh_token)->build();
        $this->session = (new AdWordsSessionBuilder())->defaultOptionals()->withOAuth2Credential($oAuth2Credential)->withDeveloperToken($this->DEVELOPER_TOKEN)->build();
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

    public function auth(){
        
    }

}