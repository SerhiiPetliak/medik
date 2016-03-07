<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "graftsPeoples".
 *
 * @property integer $graftId
 * @property integer $peopleId
 *
 * @property Peoples $people
 * @property Grafts $graft
 */
class GraftsPeoples extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'graftsPeoples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['graftId', 'peopleId'], 'required'],
            [['graftId', 'peopleId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'graftId' => 'ID',
            'peopleId' => 'ID людини',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasOne(Peoples::className(), ['peopleId' => 'peopleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraft()
    {
        return $this->hasOne(Grafts::className(), ['graftId' => 'graftId']);
    }
}
