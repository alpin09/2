<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id_order
 * @property string $username
 * @property string $id_poster
 * @property int $tickets
 *
 * @property Work $username0
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'id_poster'], 'required'],
            [['tickets'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['id_poster'], 'string', 'max' => 40],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => Work::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'username' => 'Username',
            'id_poster' => 'Id Poster',
            'tickets' => 'Tickets',
        ];
    }

    /**
     * Gets query for [[Username0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(Work::className(), ['username' => 'username']);
    }
}
