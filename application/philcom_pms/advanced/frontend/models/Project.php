<?php

namespace frontend\models;


use Yii;
use frontend\models\Pic;


/**
* This is the model class for table "project".
*
* @property integer $id
* @property string $projectcode
* @property integer $account_id
* @property integer $sitename_id
* @property string $projectname
* @property integer $pic_id
* @property string $status
* @property integer $logs_id 
* @property string $contractor
* @property string $date_of_flob
* @property string $date_of_completion

* @property integer $user_id
*
* @property Logs[] $logs
* @property Account $account
* @property Pic $pic
* @property Sitename $sitename
* @property User $user
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'account_id', 'sitename_id', 'projectname', 'pic_id','user_id'], 'required'],
            [['account_id','sitename_id', 'pic_id', 'percentage_of_completion', 'user_id'], 'integer'],
            [['date_of_flob','date_of_completion','sitename_id'], 'safe'],
            [['projectcode', 'projectname', 'status', 'contractor'], 'string', 'max' => 45],
            [['remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectcode' => 'Project Code',
            'account_id' => 'Account',
            'sitename_id' => 'Site Name',
            'projectname' => 'Project Name',
            'pic_id' => 'Person in Charge',
            'status' => 'Status',
            'contractor' => 'Contractor',
            'date_of_flob' => 'Date of Mobilization',
            'date_of_completion' => 'Date of Completion',
            'percentage_of_completion' => 'Percentage of Completion',
            'remarks' => 'Remarks',
            'user_id' => 'User',
			
			//'logs_id' => 'Milestone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['project_id' => 'id']);
    } */

    /**
     * @return \yii\db\ActiveQuery
     */
	
     public function getAccount()
        {
          return $this->hasOne(Account::className(), ['id' => 'account_id']);
         
        }
    
    public function getLogs0()
    {
		//return $this->hasOne(Logs::className(), ['id' => 'logs_id']);
        return $this->hasOne(Logs::className(), ['project_id' => 'id'])->orderBy(['id'=>SORT_DESC])->limit(1);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPic()
    {
        return  $this->hasOne(Pic::className(), ['id' => 'pic_id']);
		
		
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitename()
    {
		
		
        return $this->hasOne(Sitename::className(), ['id' => 'sitename_id']);
    }
	
	   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
