<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Person in Charge';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!--  <p>
        <?= Html::a('Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
	
	
	<?php 
	$gridColumn = [
	
			['class' => 'kartik\grid\SerialColumn'],
			[
				'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'pic_fullName',
                'value' => 'pic_fullName',
            ],	
			[
				'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'pic_email',
                'value' => 'pic_email',
            ],	
			[
				'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'pic_contact',
                'value' => 'pic_contact',
            ],	
			 ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
			
			];
	
	?>

	 <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'columns' => $gridColumn,
		'responsive'=>true,
        'hover'=>true,
		'pjax' => true,
		
		  ]);
        ?> 
	
	
	
   <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'pic_fullName',
			'pic_email:email', 
			'pic_contact', 

          
        ],
    ]); ?> -->

</div>
