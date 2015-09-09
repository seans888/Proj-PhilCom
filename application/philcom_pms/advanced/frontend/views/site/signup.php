<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';

?>
<div class="site-signup">
  
    <div class="row">
        <div class="col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
				 <?= $form->field($model, 'lastname') ?>
				  <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'username') ?>				
                <?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'roles')->dropDownList([ 'prompt' => 'Select Roles',
				'10' => 'Admin' ,
				'20' => 'Employee' ,
				'30' => 'SM Client' ]) ?> 
	
				
               
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
              
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
