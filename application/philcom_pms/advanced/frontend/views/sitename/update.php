<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sitename */

$this->title = 'Update Sitename: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sitenames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sitename-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
