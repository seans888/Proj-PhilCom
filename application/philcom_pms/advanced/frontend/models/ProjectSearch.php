<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'percentage_of_completion', 'user_id'], 'integer'],
            [['projectcode', 'projectname', 'status', 'contractor', 'date_of_flob', 'date_of_completion', 'remarks', 'sitename_id', 'pic_id','account_id'], 'safe'],
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
        $query = Project::find();

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
            'date_of_flob' => $this->date_of_flob,
            'date_of_completion' => $this->date_of_completion,
            'percentage_of_completion' => $this->percentage_of_completion,
           
        ]);
		
		
	$query->joinWith('sitename');
        $query->joinWith('pic');
        $query->joinWith('account');

        $query->andFilterWhere(['like', 'projectcode', $this->projectcode])
            ->andFilterWhere(['like', 'projectname', $this->projectname])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'contractor', $this->contractor])
            ->andFilterWhere(['like','sitename.sitename', $this->sitename_id])
        //    ->andFilterWhere(['like','pic.pic_fullName', $this->pic_id])
            ->andFilterWhere(['like','account.acct_name', $this->account_id])
			->andFilterWhere(['like','pic.pic_fullName', $this->pic_id])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);
			
	

        return $dataProvider;
    }
}
