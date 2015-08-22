<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use frontend\models\Pic;
use frontend\models\Sitename;
use frontend\models\Logs;
use yii\helpers\ArrayHelper;
use kartik\popover\PopoverX;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 
	
   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		
		
        'columns' => [
			//['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
            ['contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			'class' => 'kartik\grid\SerialColumn'
			
			],

            'projectcode',
			'account',
            'sitename_id',
		    'projectname',
            'pic_id',
			'status',		
            'contractor',
            'date_of_flob',
            'date_of_completion',
			'percentage_of_completion',
            'remarks',
            

          
        ],
    ]); ?> 
	
		
	
	
	

</div>
