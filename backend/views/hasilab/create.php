<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbPermohonanLab $model */

$this->title = 'Form Hasil Lab';
$this->params['breadcrumbs'][] = ['label' => 'Tb Permohonan Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-permohonan-lab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
