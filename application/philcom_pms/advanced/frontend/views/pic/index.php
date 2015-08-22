<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'pic_fullName',
			'pic_email:email', 
			'pic_contact', 

           ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?>

</div>
