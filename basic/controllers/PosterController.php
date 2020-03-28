<?php

namespace app\controllers;

use app\models\Order;
use Yii;
use app\models\Poster;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosterController implements the CRUD actions for Poster model.
 */
class PosterController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Poster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Poster::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_poster]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionOrder()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }


        if (Yii::$app->request->post() ) {

            $poster = Poster::findOne(Yii::$app->request->post() ['id_poster']);
            if ($poster->tickets< Yii::$app->request->post() ['tickets']){
                Yii::$app->session->setFlash('danger', 'Невозможно заказать билеты');

                return $this->redirect(['view', 'id' => $poster->id_poster]);
            }



            $poster->tickets = $poster->tickets - Yii::$app->request->post() ['tickets'];
            $poster->save();

            $model = new Order();
            $model ->username=Yii::$app->user->identity->username;
            $model ->id_poster = Yii::$app->request->post() ['id_poster'];
            $model ->tickets = Yii::$app->request->post() ['tickets'];
            $model ->save();
            Yii::$app->session->setFlash('success', 'Билеты заказаны');

            return $this->redirect(['index']);
        }


       //var_dump(Yii::$app->request->post());
    }

    /**
     * Updates an existing Poster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_poster]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Poster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
