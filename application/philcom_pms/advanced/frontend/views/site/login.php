<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Home';
//$this->params['breadcrumbs'][] = $this->title;
?>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet' type='text/css'>
<link href="bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="bootstrap-responsive.css" rel="stylesheet" type="text/css"/>
</head>
<br>
<!-- <div style="float:left;  margin-left:50px;"> -->
<center>
<img src="image/philcom2.png"/>
</center>
<!-- </div> -->
<br>
<br>

 
    <div class="span3 medium" style="margin-left:470px;"">
                <div class="pricing-table-header-medium">
                    <h2>Login</h2>
                    
                </div><div class="pricing-table-features">
				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <p><strong><?= $form->field($model, 'username') ?> </strong></p>
                    <p><strong><?= $form->field($model, 'password')->passwordInput() ?></strong></p>
                    
                    
                </div>
                <div class="pricing-table-signup-medium">
				<p><strong><?= $form->field($model, 'rememberMe')->checkbox() ?></strong></p>
                    <p> <?= Html::submitButton('Login', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?></p>
					<?php ActiveForm::end(); ?>
                </div>
            </div>


<br><br>
