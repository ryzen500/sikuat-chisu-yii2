<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbPermohonanLab $model */

$this->title = 'Create Terduga TB';
$this->params['breadcrumbs'][] = ['label' => 'Terduga TB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-permohonan-lab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menu'=>$menu,
    ]) ?>

</div>
