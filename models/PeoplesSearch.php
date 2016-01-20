<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peoples;

/**
 * PeoplesSearch represents the model behind the search form about `app\models\Peoples`.
 */
class PeoplesSearch extends Peoples
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peopleId', 'peopleWorking', 'peopleFlu', 'peopleStreet'], 'integer'],
            [['peopleFIO', 'peopleBirthday'], 'safe'],
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
        $query = Peoples::find();

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
            'peopleId' => $this->peopleId,
            'peopleBirthday' => $this->peopleBirthday,
            'peopleWorking' => $this->peopleWorking,
            'peopleFlu' => $this->peopleFlu,
            'peopleStreet' => $this->peopleStreet,
        ]);

        $query->andFilterWhere(['like', 'peopleFIO', $this->peopleFIO]);

        return $dataProvider;
    }
}
