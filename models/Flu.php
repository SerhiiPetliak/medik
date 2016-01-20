<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flu".
 *
 * @property integer $fluId
 * @property string $fluNumber
 * @property string $fluDate
 * @property integer $fluResult
 *
 * @property Peoples[] $peoples
 */
class Flu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fluNumber', 'fluDate', 'fluResult'], 'required'],
            [['fluDate'], 'safe'],
            [['fluResult'], 'integer'],
            [['fluNumber'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fluId' => 'Flu ID',
            'fluNumber' => 'Flu Number',
            'fluDate' => 'Flu Date',
            'fluResult' => 'Flu Result',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(Peoples::className(), ['peopleFlu' => 'fluId']);
    }
}
