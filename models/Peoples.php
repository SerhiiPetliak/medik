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
 * @property integer $peopleFlu
 * @property integer $peopleStreet
 *
 * @property ChronicDiseasesPeoples[] $chronicDiseasesPeoples
 * @property GraftsPeoples[] $graftsPeoples
 * @property Streets $peopleStreet0
 * @property Flu $peopleFlu0
 * @property Working $peopleWorking0
 */
class Peoples extends \yii\db\ActiveRecord
{
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
            [['peopleFIO', 'peopleBirthday', 'peopleWorking', 'peopleFlu', 'peopleStreet'], 'required'],
            [['peopleBirthday'], 'safe'],
            [['peopleWorking', 'peopleFlu', 'peopleStreet'], 'integer'],
            [['peopleFIO'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peopleId' => 'People ID',
            'peopleFIO' => 'People Fio',
            'peopleBirthday' => 'People Birthday',
            'peopleWorking' => 'People Working',
            'peopleFlu' => 'People Flu',
            'peopleStreet' => 'People Street',
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
    public function getPeopleFlu0()
    {
        return $this->hasOne(Flu::className(), ['fluId' => 'peopleFlu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeopleWorking0()
    {
        return $this->hasOne(Working::className(), ['workingId' => 'peopleWorking']);
    }
}
