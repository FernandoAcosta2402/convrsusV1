<?php

namespace app\controllers;

use app\models\Conector;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConectorController implements the CRUD actions for Conector model.
 */
class ConectorController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Conector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Conector::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idConector' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Conector model.
     * @param string $idConector Id Conector
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idConector)
    {
        return $this->render('view', [
            'model' => $this->findModel($idConector),
        ]);
    }

    /**
     * Creates a new Conector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conector();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idConector' => $model->idConector]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Conector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idConector Id Conector
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idConector)
    {
        $model = $this->findModel($idConector);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idConector' => $model->idConector]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Conector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idConector Id Conector
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idConector)
    {
        $this->findModel($idConector)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Conector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idConector Id Conector
     * @return Conector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idConector)
    {
        if (($model = Conector::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
