<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Афиша';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',
            'tickets',

            [
                'format' => 'raw',
                'label' => 'Забронировать',
                'content'=> function ($model) {
                   if (Yii::$app->user->isGuest) return "Для бронирования авторизуйтесь";
                   return Html::a('Заказать билеты', ['view', 'id' => $model->id_poster]);
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],



        ],
    ]); ?>


</div>
