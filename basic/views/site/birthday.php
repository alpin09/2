<?php

use yii\helpers\Html;

if($sex == 'M')
{
    echo 'Дорогой ';
}else{
    echo 'Дорогая ';
}

?>
<?= Html::encode($name.'! ') ?>
<?= Html::encode('поздравляем вас с Днем Рождения! Сегодня вам ') ?>
<?= Html::encode($age.' лет!') ?>
