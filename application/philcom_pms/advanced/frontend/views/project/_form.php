<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Sitename;
use frontend\models\Pic;
use frontend\models\Account;
use frontend\models\Project;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 

$date = date("Y-m-d");
$username = Yii::$app->user->identity->username;
?>

<center>
<div class="project-form">

	<table width =800px;>

    <?php $form = ActiveForm::begin(); ?>
	<tr> <td>
	<!-- <?= $form->field($model, 'user_id')->textInput(['value' => Yii::$app->user->identity->username , 'readonly' => true]) ?> -->
	<?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label($username) ?>
	</td> </tr>
	   <!-- <?= $form->field($model, 'projectcode')->textInput(['maxlength' => true]) ?> -->
	<tr><td style="width:800px">
	
	<!--<?= $form->field($model, 'account')->dropDownList([ 'prompt' => 'Select Account','SM Prime' => 'SM Prime' , 'SMIC' => 'SMIC' , 'SM ICT' => 'SM ICT' ]) ?> -->
	
            <?= $form->field($model, 'account_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Account::find()->all(),'id', 'acct_name'),
			'language' => 'en',
			'options' => ['placeholder' => 'Select a Sitename ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); ?>
		
	</td></tr>
	
	<tr>
	<td> 
			
		<?= $form->field($model, 'sitename_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Sitename::find()->all(),'id', 'fullSiteName'),
			'language' => 'en',
			'options' => ['placeholder' => 'Select a Sitename ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); ?>
			
			
	
	</td></tr>
	
	
	<tr>
	<td> 
	<?= $form->field($model, 'projectname')->textInput(['maxlength' => true]) ?>
	</td>
	</tr>
	
	
	
	<td> 
	
	<?= $form->field($model, 'pic_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Pic::find()->all(),'id', 'pic_fullName'),
			'language' => 'en',
			'options' => ['placeholder' => 'Select a Project in Charge ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); ?>
	</td></tr>
	
	<!--<tr>
	<td> 
	<?= $form->field($model, 'status')->dropDownList([ 'prompt' => 'Select Status',
	'FOR SITE SURVEY' => 'FOR SITE SURVEY' ,
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
	'ACCEPTED' => 'ACCEPTED']) ?> 
	</td>
	</tr> -->

    <!--<?= $form->field($model, 'user_id')->textInput() ?> -->
	
	
	
	<tr><td>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	</td>
	<td>
	
	<!-- <?= $form->field($model, 'projectcode')->hiddenInput() ?>	 -->
	</td>
	</tr>

    <?php ActiveForm::end(); ?>
	
	</table>
	
</div>
</center>





<?php 


/*$script = <<< JS

$('#sitecode').change(function(){
	
	var siteId = $(this).val();
	
	$.get('index.php?r=sitename/get-site',{ siteId : siteId},function(data){
		var data = $.parseJSON(data);
		
		$('#project-projectcode').attr('value', '(' + data.sitecode + ')-' + '$date-' + '$projectCodeId');
	});
});


JS;
$this->registerJs($script);

*/

$script = <<< JS


$('#project-status').change(function(){
	
	var status = $(this).val();
	
	alert(status);
	
	if (status == "PHYSICALLY COMPLETED"){
		$('#project-percentage_of_completion').attr('value','90');
	}else if(status == "ACCEPTED"){
		$('#project-percentage_of_completion').attr('value','100');
	}else{
		$('#project-percentage_of_completion').attr('value','');
	}
	
});


JS;
$this->registerJs($script);
?>


