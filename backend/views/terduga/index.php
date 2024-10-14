<?php

use app\models\TbTerduga;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Admin Terduga TB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-permohonan-lab-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Buat Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,  // Set this to an instance of the search model if you have filtering
    'columns' => [
        [
        'header'=>'Nomer',
        'class' => 'yii\grid\SerialColumn'
        ],  // Serial column for row numbers


        // Another column with different header than actual attribute
        [
            'attribute' => 'no_sediaan',
            'header' => 'Nomor Sediaan',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->no_sediaan);  // Customize value if needed
            },
        ],


        [
            'attribute' => 'jenis_terduga',
            'header' => 'Terduga TB',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->jenis_terduga);  // Customize value if needed
            },
        ],


        [
            'attribute' => 'jenis_pasien',
            'header' => 'Tipe Pasien',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->jenis_pasien);  // Customize value if needed
            },
        ],


        [
            'attribute' => 'nama_pasien',
            'header' => 'Tipe Pasien',
            'format' => 'raw',
            'value' => function ($model) {
                $name = !empty($model->nama_pasien) ? $model->nama_pasien : '-';

                return Html::encode($name);  // Customize value if needed
            },
        ],


        // Action Column
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',  // Custom header for actions
            'template' => '{update}',  // Specify which buttons to show
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Edit', $url, ['class' => 'btn btn-primary']);
                },
            ],
            'urlCreator' => function ($action, TbTerduga $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
        ],
    ],
]); ?>

</div>
