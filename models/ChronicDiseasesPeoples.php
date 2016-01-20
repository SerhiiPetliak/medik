<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chronicDiseasesPeoples".
 *
 * @property integer $chronicDiseasesId
 * @property integer $peopleId
 *
 * @property Peoples $people
 * @property ChronicDiseases $chronicDiseases
 */
class ChronicDiseasesPeoples extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chronicDiseasesPeoples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chronicDiseasesId', 'peopleId'], 'required'],
            [['chronicDiseasesId', 'peopleId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chronicDiseasesId' => 'Chronic Diseases ID',
            'peopleId' => 'People ID',
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
    public function getChronicDiseases()
    {
        return $this->hasOne(ChronicDiseases::className(), ['chronicDiseasesId' => 'chronicDiseasesId']);
    }
}
