<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "working".
 *
 * @property integer $workingId
 * @property string $workingName
 *
 * @property Peoples[] $peoples
 */
class Working extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'working';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workingName'], 'required'],
            [['workingName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workingId' => 'ID',
            'workingName' => 'Назва',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(Peoples::className(), ['peopleWorking' => 'workingId']);
    }
}
