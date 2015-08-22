<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use frontend\models\Pic;
use yii\helpers\ArrayHelper;
use frontend\models\Sitename;
use kartik\export\ExportMenu;
use frontend\models\Logs;
use frontend\models\Account;
use kartik\popover\PopoverX;
use frontend\models\LogsSearch;
use dosamigos\datepicker\DatePicker;




/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php    
	$roles = Yii::$app->user->identity->roles;
		if($roles == 10){
?>
    <p style = "float:left;">
       <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?> 
		<!--<?= Html::button('Create Project', ['value'=>Url::to('index.php?r=project%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton1']) ?> -->
    </p>
	
	
	<p style = "float:right; padding-left:20px; padding-right:20px">
       <!-- <?= Html::a('Create Sitename', ['create'], ['class' => 'btn btn-success']) ?> -->
		<?= Html::button('Add Sitename', ['value'=>Url::to('index.php?r=sitename%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton2']) ?>
    </p>
	
	<p style = "float:right;">
       <!-- <?= Html::a('Create PIC', ['create'], ['class' => 'btn btn-success']) ?> -->
		<?= Html::button('Add PIC', ['value'=>Url::to('index.php?r=pic%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton3']) ?>
    </p>
    <p style = "float:right; padding-left:20px; padding-right:20px">
       <!-- <?= Html::a('Create Sitename', ['create'], ['class' => 'btn btn-success']) ?> -->
		<?= Html::button('Add Account', ['value'=>Url::to('index.php?r=account%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton1']) ?>
    </p>
	
<?php }?>
	
	<?php
        Modal::begin([
                'header'=>'<h3>Add Account</h3>',
                'id'=>'modal1',
                'size'=>'modal-sm',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
	
	<?php
        Modal::begin([
                'header'=>'<h3>Add Sitename</h3>',
                'id'=>'modal2',
                'size'=>'modal-sm',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
	<?php
        Modal::begin([
                'header'=>'<h3>Add Person in Charge</h3>',
                'id'=>'modal3',
                'size'=>'modal-sm',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
	
	<?php 
	
			
	$gridColums =  [
           ['class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new LogsSearch();
                    $searchModel->project_id = $model->projectcode;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_logsView',[
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                },
            ], 
			
           // ['contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			//'class' => 'kartik\grid\SerialColumn'
			
			//],

            //'id',
            
            [
		   'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'projectcode',
                'value' => 'projectcode',
				//'filterType'=>GridView::INPUT_TEXT,
				'filterInputOptions'=>['style'=>'width:140px;'],
            ],	
            //'projectcode',

			[
				'class' => 'kartik\grid\EditableColumn',
				'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
				'attribute' => 'account_id',
				'value' => 'account.acct_name',	
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Account::find()->asArray()->all(), 'acct_name', 'acct_name'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Account','style'=>'width:140px;'],
				'editableOptions' => [
					'inputType' => '\kartik\select2\Select2',
					'options'=>
					[
						'data' => ArrayHelper::map(Account::find()->all(),'id', 'acct_name'),
					],
				],
			],
            // 'account',

			[
				'class' => 'kartik\grid\EditableColumn',
				'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
				'attribute' => 'sitename_id',
				'value' => 'sitename.fullSiteName',	
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Sitename::find()->asArray()->all(), 'sitename', 'sitename'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Sitename','style'=>'width:140px;'],
				'editableOptions' => [
					'inputType' => '\kartik\select2\Select2',
					'options'=>
					[
						'data' => ArrayHelper::map(Sitename::find()->all(),'id', 'fullSiteName'),
					],
				],
			],
              //'sitename_id',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'projectname',
                'value' => 'projectname',
				'filterInputOptions'=>['style'=>'width:140px;'],
				
            ],	
            //'projectname',
           /* [
			
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'pic_id',
                'value' => 'pic.pic_fullName',		
				
				//'filter' => Html::activeDropDownList($searchModel, 'pic_id', ArrayHelper::map(Pic::find()->asArray()->all(), 'pic_fullName', 'pic_fullName'),['class'=>'form-control','prompt' => 'Select Project in Charge...']),
                //'size'=>'sm',
				//'editableOptions' => [
               //  'inputType' => \kartik\editable\Editable::INPUT_SELECT2 ,		
                
				'editableOptions' => function ($model, $key, $index) {
                         return [
                'beforeInput' => function ($form, $widget) use ($model, $index) {
                        echo $form->field($model, "pic_id")->widget(\kartik\select2\Select2::classname(), [
                'data' => ArrayHelper::map(Pic::find()->all(),'id', 'pic_fullName'),
                'options' => ['id' => "pic-{$index}"]
                 ]);
                    }];
            }],
*/

			[
				'class' => 'kartik\grid\EditableColumn',
				'contentOptions'=>['style'=>'font-size:13px; text-align:center; '],
				'attribute' => 'pic_id',
				'value' => 'pic.pic_fullName',	
				
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Pic::find()->asArray()->all(), 'pic_fullName', 'pic_fullName'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Person','style'=>'width:150px;'],
				'editableOptions' => [
					'inputType' => '\kartik\select2\Select2',
					'options'=>
					[
						'data' => ArrayHelper::map(Pic::find()->all(),'id', 'pic_fullName'),
					],
				],
			],
			
						
			
            //'pic_id',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
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
				
				
                'editableOptions' => [
                 'size'=>'sm',
                 'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST  ,
                 'data' => ['FOR SITE SURVEY' => 'FOR SITE SURVEY' ,
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
            ]]],
            // 'status',	
            [	
                'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'logs0.milestone',
		'value' => 'logs0.milestoneFull',
		
		
            ],		
            //logs
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'contractor',
                'value' => 'contractor',
				'filterInputOptions'=>['style'=>'width:120px;'],
            ],	
            //'contractor',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'date_of_flob',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_flob', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                //'value' => '2015-08-07',
                'editableOptions' => [
                 'size'=>'sm',
                 'inputType' => \kartik\editable\Editable::INPUT_DATE,
                 'options' => [
                'pluginOptions' => [  
                'format' => 'yyyy-mm-dd',
            ]]]],
            //'date_of_flob',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'date_of_completion',
                'value' => 'date_of_completion',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_completion', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                'editableOptions' => [
                 'size'=>'sm',
                 'inputType' => \kartik\editable\Editable::INPUT_DATE,
                 'options' => [
                'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ]]]],
            //'date_of_completion',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'label' => '% of Completion' ,
                'attribute' => 'percentage_of_completion',
               // 'value' => 'percentage_of_completion',
                'editableOptions' => [
                'size'=>'sm',
                'inputType' => \kartik\editable\Editable::INPUT_RANGE,
                'options' => [
                'pluginOptions' => ['min'=>0, 'max'=>100]
                ]]	
            ],	
            // 'percentage_of_completion',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'remarks',		
				'filterInputOptions'=>['style'=>'width:140px;'],
                'editableOptions' => [
                 'size'=>'md',
                 'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                 'placement' => PopoverX::ALIGN_LEFT,		  
			]	
            ],
            //'remarks',
            //'user_id',
		
            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],			
        ];
    
	$gridColums2 =[
	
	['class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new LogsSearch();
                    $searchModel->project_id = $model->projectcode;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_logsView',[
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                },
            ], 
			//['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
            ['contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
			'class' => 'kartik\grid\SerialColumn'
			
			],

            //'id',
            [
		'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'projectcode',
                'value' => 'projectcode',
					'filterInputOptions'=>['style'=>'width:140px;'],
            ],	
            //'projectcode',
            [
				
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'account_id',
                'value' => 'account.acct_name',
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Account::find()->asArray()->all(), 'acct_name', 'acct_name'), 
					'filterInputOptions'=>['placeholder'=>'Choose Account','style'=>'width:140px;'],
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
						
					],
            ],	
            // 'account',
            [		
                'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'sitename_id',
                'value' => 'sitename.fullSiteName',
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Sitename::find()->asArray()->all(), 'sitename', 'sitename'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Sitename','style'=>'width:140px;'],
            ],	
            //'sitename_id',
            [	
		'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'projectname',
                'value' => 'projectname',		
				'filterInputOptions'=>['style'=>'width:140px;'],
            ],	
            //'projectname',
            [
		'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'pic_id',
                'value' => 'pic.pic_fullName',
				'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Pic::find()->asArray()->all(), 'pic_fullName', 'pic_fullName'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
						
					],
					'filterInputOptions'=>['placeholder'=>'Choose Person','style'=>'width:140px;'],
            ],		
            //'pic_id',
            [
				
		'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
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
            // 'status',	
            [	
		'contentOptions'=>['style'=>'font-size:12px; text-align:center;'],
                'attribute' => 'logs0.milestone',
				'value' => 'logs0.milestoneFull',
            ],		
            //logs
            [
		'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'contractor',
		'value' => 'contractor',
		'filterInputOptions'=>['style'=>'width:120px;'],
            ],	
            //'contractor',
            [
		'class' => 'kartik\grid\EditableColumn',
		'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'date_of_flob',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_flob', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
		//'value' => '2015-08-07',
		'editableOptions' => [
                'size'=>'sm',
                'inputType' => \kartik\editable\Editable::INPUT_DATE,
		'options' => [
		'pluginOptions' => [
		'format' => 'yyyy-mm-dd',
		]]]],
           //'date_of_flob',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'date_of_completion',
                'value' => 'date_of_completion',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_completion', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                'editableOptions' => [
                 'size'=>'sm',
                 'inputType' => \kartik\editable\Editable::INPUT_DATE,
                 'options' => [
                'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                ]]]],
            //'date_of_completion',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'label' => '% of Completion' ,
                'attribute' => 'percentage_of_completion',
               // 'value' => 'percentage_of_completion',
                'readonly'=>function($model, $key, $index, $widget) {
				return ($model->percentage_of_completion  > 89 ); // do not allow editing
					},
                'editableOptions' => [
                'size'=>'sm', 
                'inputType' => \kartik\editable\Editable::INPUT_RANGE,       
                'options' => [
                'pluginOptions' => ['min'=>0, 'max'=>100]
            ]]],	
            // 'percentage_of_completion',
            [
                'class' => 'kartik\grid\EditableColumn',
                'contentOptions'=>['style'=>'font-size:13px; text-align:center;'],
                'attribute' => 'remarks',		
				'filterInputOptions'=>['style'=>'width:140px;'],
                'editableOptions' => [
                 'size'=>'md',
                 'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                 'placement' => PopoverX::ALIGN_LEFT,
				  
            ]],
            //'remarks',
            //'user_id',
			
         	
        ];
	
	
	?>
	
	
	
    
     
	<br>
	<br>
	<br>
	
	<?php 	if($roles == 10){  ?>
	
	 <div class="export-menu" style = "float:right; padding-left:20px; padding-right:20px">
    <?php
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColums
    ]);
    ?>
    </div>
	<br>
	
   <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'columns' => $gridColums,
		'responsive'=>true,
        'hover'=>true,
		//'containerOptions' => ['style'=>'font-size:18px; '],
		'pjax' => true,
		
		  ]);
        ?> 
	
	<?php  //----------------------------------For Employee ----------------------------------------?>
	
	
	<?php  } else if($roles == 20) { ?>
	
	
   <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'columns' => $gridColums2,
		'responsive'=>true,
        'hover'=>true,
		//'containerOptions' => ['style'=>'font-size:25px; '],
		'pjax' => true,
		
    ]); ?> 
        <?php } ?>
	
</div>
