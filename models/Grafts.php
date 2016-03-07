<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grafts".
 *
 * @property integer $graftId
 * @property string $graftName
 *
 * @property GraftsPeoples[] $graftsPeoples
 */
class Grafts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grafts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['graftName'], 'required'],
            [['graftName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'graftId' => 'ID',
            'graftName' => 'Назва',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraftsPeoples()
    {
        return $this->hasMany(GraftsPeoples::className(), ['graftId' => 'graftId']);
    }
}
