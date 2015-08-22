<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pic;

/**
 * PicSearch represents the model behind the search form about `app\models\Pic`.
 */
class PicSearch extends Pic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['pic_fullName', 'pic_email', 'pic_contact'], 'safe'],
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
        $query = Pic::find();

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
            'id' => $this->id,
        ]);

       $query->andFilterWhere(['like', 'pic_fullName', $this->pic_fullName])
		           ->andFilterWhere(['like', 'pic_email', $this->pic_email])
		           ->andFilterWhere(['like', 'pic_contact', $this->pic_contact]);

        return $dataProvider;
    }
}
