<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;

use kartik\grid\GridView;
use frontend\models\Pic;
use frontend\models\Sitename;
use frontend\models\Logs;
use yii\helpers\ArrayHelper;
use kartik\popover\PopoverX;
use yii\helpers\Json;	
use frontend\models\Project;
use frontend\models\PicSearch;
use dosamigos\datepicker\DatePicker;
use frontend\models\LogsSearch;
/* @var $this yii\web\View */

?>

<?php        

		
				


$roles = Yii::$app->user->identity->roles;

if($roles == 10 || $roles == 20){
	$this->title = 'Home';
?>

<div class="site-index">
<br><br>
<center>

<h1> Status Overview</h1>
<!-- <h4> 2015 </h4> -->
<?php 

$connection = \Yii::$app->db;
		$a = $connection->createCommand('SELECT  status, count(status) as quantity   FROM project GROUP BY status')->queryAll();
		$total = $connection->createCommand('SELECT  count(id) as total   FROM project')->queryAll();
		
		
		//----------------------------------------------------------- this is for the graph
		 $b = json_encode($a);
			$c = json_decode($b);
			$status = array();
			$quantity = array();
			foreach ($c as $key => $value) {
				array_push($status,$c[$key]->status) ;	
				array_push($quantity,$c[$key]->quantity) ;				
			}
			
		// -----------------------------------------------------------this is for total	
		
		$total_encode = json_encode($total);
			$total_decode = json_decode($total_encode);
			
		foreach($total_decode as $key2 => $value2){
			
		}
			
			//print_r($c);
			
?>

<?= ChartJs::widget([
    'type' => 'Bar',
    'options' => [
        'height' => 400,
        'width' => 600
    ],
    'data' => [
	
        //'labels' => ["FOR SITE SURVEY", "FOR DESIGNING", "FOR REVISION", "FOR REVIEW", "FOR COSTING", "FOR NEGOTATION", "CANCELED", "FOR PHILCOM PROPOSAL", "PROPOSAL SENT/WAITING P.O", "FOR MOBILAZATION", "ON-GOING", "PHYSICALLY COMPLETED", "ACCEPTED"],
        'labels'=> $status,
		'datasets' => [
          
            [
                'fillColor' => "rgba(151,187,205,0.5)",
                'strokeColor' => "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => $quantity
            ]
        ]
    ]
]);
			
?>
<h3> Total Projects: <?php echo $total_decode[0]->total ?></h3>

</center>
</div>
<?php } else {
	$this->title = 'Projects';
	?>


<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $gridColums =  [
	
	
	
			//['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
            ['contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			'class' => 'kartik\grid\SerialColumn'
			
			],

            //'projectcode',
			//'account',
            //'sitename_id',
		    //'projectname',
			 [
		   'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'projectname',
                'value' => 'projectname',
				//'filterType'=>GridView::INPUT_TEXT,
				'filterInputOptions'=>['style'=>'width:140px;'],
            ],	
			
			
			['class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new PicSearch();
                    $searchModel->id = $model->pic_id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_picView',[
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                },
            ], 
            //'pic_id',
			[
			 'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'pic_id',
                'value' => 'pic.pic_fullName',	
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Pic::find()->asArray()->all(), 'pic_fullName', 'pic_fullName'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Person','style'=>'width:140px;'],
				],	
			//'status',
			[
			 'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
				'attribute' => 'status',
                'value' => 'status',
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>['FOR SITE SURVEY' => 'FOR SITE SURVEY' ,
                                'FOR DESIGNING' => 'FOR DESIGNING' , 
                                'FOR REVISION' => 'FOR REVISION',
                                'FOR REVIEW' => 'FOR REVIEW',
                                'FOR COSTING' => 'FOR COSTING',
                                'FOR NEGOTATION' => 'FOR NEGOTATION',
                                'CANCELED' => 'CANCELED',	
                                'FOR PHILCOM PROPOSAL' => 'FOR PHILCOM PROPOSAL',
                                'PROPOSAL SENT/WAITING P.O' => 'PROPOSAL SENT/WAITING P.O',
                                'FOR MOBILAZATION' => 'FOR MOBILAZATION',
                                'ON-GOING' => 'ON-GOING',
                                'PHYSICALLY COMPLETED' => 'PHYSICALLY COMPLETED',
                                'ACCEPTED' => 'ACCEPTED'								
            ],
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Status','style'=>'width:180px;'],
			
			],			
            //'contractor',
			 [
		   'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'contractor',
                'value' => 'contractor',
				//'filterType'=>GridView::INPUT_TEXT,
				'filterInputOptions'=>['style'=>'width:140px;'],
            ],	
			
			[
			 'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			'attribute'=> 'date_of_flob',
			'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_flob', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
			],
          //  'date_of_flob',
		  [
			'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
		  'attribute'=>'date_of_completion',
		  'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_completion', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
			],
		  
			//'percentage_of_completion',
			[
		   'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
				'label' => '% of Completion' ,
                'attribute' => 'percentage_of_completion',
                'value' => 'percentage_of_completion',
				//'filterType'=>GridView::INPUT_TEXT,
				'filterInputOptions'=>['style'=>'width:100px;'],
            ],	
			
			
            //'remarks',
			[
		   'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'remarks',
                'value' => 'remarks',
				//'filterType'=>GridView::INPUT_TEXT,
				'filterInputOptions'=>['style'=>'width:150px;'],
            ],	
			
			
			 [	
                'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'logs0.milestone',
		'value' => 'logs0.milestoneFull',
		
		
            ],	
			['class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new LogsSearch();
                    $searchModel->project_id = $model->projectcode;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_logsView2',[
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                },
            ], 
            

          
        ];	?>

 
	
   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,	
        'columns' => $gridColums,
		'responsive'=>true,
        'hover'=>true,
    ]); ?> 
	
		
	
	
	

</div>


<?php }?>
