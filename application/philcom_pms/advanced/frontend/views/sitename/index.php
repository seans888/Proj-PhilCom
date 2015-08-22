<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SitenameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Malls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitename-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!-- <p>
        <?= Html::a('Create Sitename', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'sitecode',
            'sitename',

            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?>

</div>
