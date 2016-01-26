<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peoples".
 *
 * @property integer $peopleId
 * @property string $peopleFIO
 * @property string $peopleBirthday
 * @property integer $peopleWorking
 * @property string $peopleFluNumber
 * @property string $peopleFluDate
 * @property integer $peopleFluResult
 * @property integer $peopleFluTerm
 * @property integer $peopleStreet
 *
 * @property ChronicDiseasesPeoples[] $chronicDiseasesPeoples
 * @property GraftsPeoples[] $graftsPeoples
 * @property Streets $peopleStreet0
 * @property Working $peopleWorking0
 */
class Peoples extends \yii\db\ActiveRecord
{
    public $streetId;
    public $yearVal;
    public $graft;
    public $chronic;
    public $fluInfo;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peoples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peopleFIO', 'peopleBirthday', 'peopleWorking', 'peopleFluNumber', 'peopleFluDate', 'peopleFluResult', 'peopleStreet', 'peopleAdress'], 'required'],
            [['peopleBirthday', 'peopleFluDate','streetId','yearVal', 'peopleFluTerm', 'graft', 'chronic', 'fluInfo'], 'safe'],
            [['peopleWorking', 'peopleFluResult', 'peopleFluTerm', 'peopleStreet'], 'integer'],
            [['peopleFIO', 'peopleFluNumber', 'peopleAdress'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peopleId' => 'People ID',
            'peopleFIO' => 'Ф.И.О',
            'peopleBirthday' => 'Дата рождения',
            'peopleWorking' => 'Место работы',
            'peopleFluNumber' => 'Номер флюорографии',
            'peopleFluDate' => 'Дата проведения фл.',
            'peopleFluResult' => 'Результат фл.',
            'peopleFluTerm' => 'People Flu Term',
            'peopleStreet' => 'Улица',
            'graft' => 'Прививки',
            'chronic' => 'Заболевания',
            'peopleAdress' => 'Дом №',
            'fluInfo' => 'Флюорография'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChronicDiseasesPeoples()
    {
        return $this->hasMany(ChronicDiseasesPeoples::className(), ['peopleId' => 'peopleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraftsPeoples()
    {
        return $this->hasMany(GraftsPeoples::className(), ['peopleId' => 'peopleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeopleStreet0()
    {
        return $this->hasOne(Streets::className(), ['streetId' => 'peopleStreet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeopleWorking0()
    {
        return $this->hasOne(Working::className(), ['workingId' => 'peopleWorking']);
    }
}
