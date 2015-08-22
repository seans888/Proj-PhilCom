<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sitename */

$this->title = 'Create Sitename';
$this->params['breadcrumbs'][] = ['label' => 'Sitenames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitename-create">

   <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
