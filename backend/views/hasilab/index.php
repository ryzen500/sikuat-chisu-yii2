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
         [
        'header'=>'Nomer',
        'class' => 'yii\grid\SerialColumn'
        ],  
        [
            'attribute' => 'no_sediaan',
            'header' => 'Nomor Sediaan',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->no_sediaan);  // Customize value if needed
            },
        ],

        [
            'attribute' => 'lokasi_anatomi',
            'header' => 'Lokasi Anatomi',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->lokasi_anatomi);  // Customize value if needed
            },
        ],


        [
            'attribute' => 'tanggal_daftar',
            'header' => 'Tanggal Pendaftaran',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode(date('Y-m-d',strtotime($model->tanggal_daftar)));  // Customize value if needed
            },
        ],



        [
            'attribute' => 'tanggal_hasil',
            'header' => 'Tanggal Pengambilan',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode(date('Y-m-d',strtotime($model->tanggal_hasil)));  // Customize value if needed
            },
        ],


        [
            'attribute' => 'tgl_contoh_uji',
            'header' => 'Tanggal Pengiriman',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode(date('Y-m-d',strtotime($model->tgl_contoh_uji)));  // Customize value if needed
            },
        ],



        [
            'attribute' => 'contoh_uji',
            'header' => 'Alasan Pemeriksaan',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->contoh_uji);  // Customize value if needed
            },
        ],


        [
            'attribute' => 'jenis_pemeriksaan',
            'header' => 'Jenis Pemeriksaan',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->jenis_pemeriksaan);  // Customize value if needed
            },
        ],


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
