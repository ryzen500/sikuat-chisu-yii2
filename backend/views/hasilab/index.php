<?php

use app\models\TbHasilLab;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Create Hasil Lab';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-permohonan-lab-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hasil lab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,  // Set this to an instance of the search model if you have filtering
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],  // Serial column for row numbers

        'id',  // Example column, replace with actual attribute names
        'no_sediaan',  // Replace with actual attribute names
        'lokasi_anatomi',  // Replace with actual attribute names

       [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{update}',  // Specify which buttons to show
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Edit', $url, ['class' => 'btn btn-primary']);
                },
            ],
            'urlCreator' => function ($action, TbHasilLab $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],
    ],
]); ?>


</div>
