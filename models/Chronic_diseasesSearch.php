<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChronicDiseases;

/**
 * Chronic_diseasesSearch represents the model behind the search form about `app\models\ChronicDiseases`.
 */
class Chronic_diseasesSearch extends ChronicDiseases
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chronicDiseasesId'], 'integer'],
            [['chronicDiseasesName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ChronicDiseases::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'chronicDiseasesId' => $this->chronicDiseasesId,
        ]);

        $query->andFilterWhere(['like', 'chronicDiseasesName', $this->chronicDiseasesName]);

        return $dataProvider;
    }
}
