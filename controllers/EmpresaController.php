<?php

namespace app\controllers;

use app\models\Empresa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\user;
use Yii;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [

                //CONTROL DE ACCESO Backend
                'access'=>[
                    'class'=>AccessControl::className(),
                    'rules'=>[
                        [
                            'allow'=>true,
                            'roles'=>['@']
                        ]
                    ]
                ],


            //----------------------------------
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $IdUser=Yii::$app->user->identity->idUsuario;
        //$IdUser=Yii::$app->user->identity->idEmpresa;
        $dataProvider = new ActiveDataProvider([
            'query' => Empresa::find($IdUser)//->where(["idEmpresa"=>$IdUser]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idEmpresa' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,'IdUser'=>$IdUser
        ]);
    }

    /**
     * Displays a single Empresa model.
     * @param string $idEmpresa Id Empresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEmpresa)
    {
        return $this->render('view', [
            'model' => $this->findModel($idEmpresa),
        ]);
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idEmpresa' => $model->idEmpresa]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idEmpresa Id Empresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEmpresa)
    {
        $model = $this->findModel($idEmpresa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEmpresa' => $model->idEmpresa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idEmpresa Id Empresa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEmpresa)
    {
        $this->findModel($idEmpresa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idEmpresa Id Empresa
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEmpresa)
    {
        if (($model = Empresa::findOne($idEmpresa)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
