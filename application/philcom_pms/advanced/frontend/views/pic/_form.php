<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pic_fullName')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'pic_email')->textInput(['maxlength' => true]) ?> 
		 
	<?= $form->field($model, 'pic_contact')->textInput(['maxlength' => true]) ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
