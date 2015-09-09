<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pic".
 *
 * @property integer $id
 * @property string $pic_fullName
 *
 * @property Project[] $projects
 */
class Pic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			//['pic_fullName', 'unique', 'targetClass' => '\frontend\models\Pic', 'message' => 'This Project in Charge has already existing.'],
             [['pic_fullName', 'pic_email', 'pic_contact'], 'safe'],
		     [['pic_fullName', 'pic_email', 'pic_contact'], 'string', 'max' => 45],
			 //['pic_email','email']
			 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pic_fullName' => 'Full Name',
		   'pic_email' => 'Email',
		   'pic_contact' => 'Contact Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['pic_id' => 'id']);
    }
}
