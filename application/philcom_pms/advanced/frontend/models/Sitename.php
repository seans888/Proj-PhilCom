<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sitename".
 *
 * @property integer $id
 * @property string $sitecode
 * @property string $sitename
 *
 * @property Project[] $projects
 */
class Sitename extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitename';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			//['sitecode', 'unique', 'targetClass' => '\frontend\models\Sitename', 'message' => 'This Site Code has already existing.'],
            [['sitecode', 'sitename'], 'required'],
            [['sitecode', 'sitename'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sitecode' => 'Sitecode',
            'sitename' => 'Sitename',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['sitename_id' => 'id']);
    }
	
	 public function getFullSiteName()
	{
		return $this->sitename . " (". $this->sitecode. ")" ;
                
	}
}
