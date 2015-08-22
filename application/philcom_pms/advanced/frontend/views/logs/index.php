<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!-- <p>
        <?= Html::a('Create Logs', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
        [
            'attribute' => 'project_id',
            'value' => 'project.projectcode',
        ],	
            'logs_employee_name',
            'milestone',
            'milestone_date',
     

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
