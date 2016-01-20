<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grafts;

/**
 * GraftsSearch represents the model behind the search form about `app\models\Grafts`.
 */
class GraftsSearch extends Grafts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['graftId'], 'integer'],
            [['graftName'], 'safe'],
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
        $query = Grafts::find();

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
            'graftId' => $this->graftId,
        ]);

        $query->andFilterWhere(['like', 'graftName', $this->graftName]);

        return $dataProvider;
    }
}
