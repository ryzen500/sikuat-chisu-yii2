<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbPermohonanLab $model */

$this->title = 'Update Tb Permohonan Lab: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Permohonan Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-permohonan-lab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menu'=>$menu
    ]) ?>

</div>
