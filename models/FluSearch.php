<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Flu;

/**
 * FluSearch represents the model behind the search form about `app\models\Flu`.
 */
class FluSearch extends Flu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fluId', 'fluResult'], 'integer'],
            [['fluNumber', 'fluDate'], 'safe'],
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
        $query = Flu::find();

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
            'fluId' => $this->fluId,
            'fluDate' => $this->fluDate,
            'fluResult' => $this->fluResult,
        ]);

        $query->andFilterWhere(['like', 'fluNumber', $this->fluNumber]);

        return $dataProvider;
    }
}
