<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "streets".
 *
 * @property integer $streetId
 * @property string $streetName
 *
 * @property Peoples[] $peoples
 */
class Streets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['streetName'], 'required'],
            [['streetName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'streetId' => 'Street ID',
            'streetName' => 'Название улицы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(Peoples::className(), ['peopleStreet' => 'streetId']);
    }
}
