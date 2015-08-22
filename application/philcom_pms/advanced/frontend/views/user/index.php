<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       
		<?= Html::button('Add Employee', ['value'=>Url::to('index.php?r=site%2Fsignup'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>

	<?php
        Modal::begin([
                'header'=>'<h3>Add Employee</h3>',
                'id'=>'modal',
                'size'=>'modal-sm',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
		['class' => 'yii\grid\ActionColumn','template'=>'{update}'],
            ['class' => 'yii\grid\SerialColumn'],
  
           // 'id',          
            'lastname',
            'firstname',
			'username',
            'roles',
            // 'password_hash',
            // 'password_reset_token',
            // 'auth_key',
            // 'status',
            // 'created_at',
            // 'updated_at',

  ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?> 
	
	

	
	

</div>
