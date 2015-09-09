<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use frontend\models\Project;
use dosamigos\datepicker\DatePicker;
use kartik\export\ExportMenu;

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
          //  'milestone_date',
     

           // ['class' => 'yii\grid\ActionColumn'],
        
	 
	 ];
	?>
	<div class="export-menu">
    <?php
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>
    </div>
	
	 <?php
    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'responsive'=>true,
        'hover'=>true,
    ]); ?>

</div>
