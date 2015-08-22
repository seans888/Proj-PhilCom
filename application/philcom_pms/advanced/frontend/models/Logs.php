<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property string $logs_employee_name
 * @property string $milestone
 * @property string $milestone_date
 * @property integer $project_id
 *
 * @property Project $project
 * @property Project[] $projects
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'milestone_date', 'project_id'], 'required'],
            [['milestone_date'], 'safe'],
            [['project_id'], 'integer'],
            [['logs_employee_name', 'milestone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logs_employee_name' => 'Employee',
            'milestone' => 'Milestone',
            'milestone_date' => 'Milestone Date',
            'project_id' => 'Project Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['logs_id' => 'id']);
    }
	
	 public function getMilestoneFull()
	{
		return $this->milestone . " (". $this->milestone_date. ")" ;
                
	}
}
