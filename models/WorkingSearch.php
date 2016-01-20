<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Working;

/**
 * WorkingSearch represents the model behind the search form about `app\models\Working`.
 */
class WorkingSearch extends Working
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workingId'], 'integer'],
            [['workingName'], 'safe'],
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
        $query = Working::find();

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
            'workingId' => $this->workingId,
        ]);

        $query->andFilterWhere(['like', 'workingName', $this->workingName]);

        return $dataProvider;
    }
}
