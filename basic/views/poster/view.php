<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Poster */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Афиша', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="poster-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'tickets',
        [                      // the owner name of the model
            'label' => 'Owner',
            'format' => 'raw',
            'value' => function ($model) {
                if (Yii::$app->user->isGuest) return "Для бронирования авторизуйтесь";
                return
                    Html::beginForm(['/poster/order'], 'post')
                        .Html::hiddenInput('id_poster', $model->id_poster)
                        .Html::textInput('tickets', 0)
                    . Html::submitButton(
                        'Заказать билеты'
                    )
                    . Html::endForm();
            },



        ],
        ],
    ]) ?>

</div>
