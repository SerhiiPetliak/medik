<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chronicDiseases".
 *
 * @property integer $chronicDiseasesId
 * @property string $chronicDiseasesName
 *
 * @property ChronicDiseasesPeoples[] $chronicDiseasesPeoples
 */
class ChronicDiseases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chronicDiseases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chronicDiseasesName'], 'required'],
            [['chronicDiseasesName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chronicDiseasesId' => 'ID',
            'chronicDiseasesName' => 'Назва',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChronicDiseasesPeoples()
    {
        return $this->hasMany(ChronicDiseasesPeoples::className(), ['chronicDiseasesId' => 'chronicDiseasesId']);
    }
}
