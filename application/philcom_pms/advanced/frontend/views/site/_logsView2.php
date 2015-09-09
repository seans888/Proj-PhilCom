<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use frontend\models\Project;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Project-Milestones';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

	<?php 
	 $gridColumns = [
	 ['class' => 'yii\grid\SerialColumn'],

           // 'id',
       // [
       //     'attribute' => 'project_id',
       //     'value' => 'project.projectcode',
       // ],	
            'logs_employee_name',
            'milestone',
           // 'milestone_date',
			//['contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			[
                'attribute' => 'milestone_date',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'milestone_date', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
				],
     

           // ['class' => 'yii\grid\ActionColumn'],
        
	 
	 ];
	?>
	
	
	 <?php
    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'responsive'=>true,
        'hover'=>true,
    ]); ?>

</div>
