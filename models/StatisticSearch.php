<?php

namespace mergit\shorty\models;

use app\components\Shorty;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mergit\shorty\models\Statistic;

/**
 * StatisticSearch represents the model behind the search form of `mergit\shorty\models\statistic`.
 */
class StatisticSearch extends Statistic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortlink_id'], 'required'],
            [['id', 'shortlink_id'], 'integer'],
            [['country', 'useragent', 'ip'], 'safe'],
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
        $query = Statistic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $id = Yii::$app->getModule('shorty')->shorty->getId(Yii::$app->request->get('q'));
        $params['StatisticSearch']['shortlink_id']=$id;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shortlink_id' => $this->shortlink_id,
        ]);

        $query->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'useragent', $this->useragent])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
