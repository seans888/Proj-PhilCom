<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use frontend\models\Project;

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
            'milestone_date',
     

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
