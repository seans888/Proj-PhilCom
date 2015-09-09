<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Logs;

/**
 * LogsSearch represents the model behind the search form about `app\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['logs_employee_name', 'milestone', 'milestone_date','project_id'], 'safe'],
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
        $query = Logs::find();

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
            //'id' => $this->id,
            'milestone_date' => $this->milestone_date,
            //'project_id' => $this->project_id,
        ]);
		
		$query->joinWith('project');

        $query->andFilterWhere(['like', 'logs_employee_name', $this->logs_employee_name])
		  ->andFilterWhere(['like','project.projectcode', $this->project_id])
            ->andFilterWhere(['like', 'milestone', $this->milestone]);

        return $dataProvider;
    }
}
