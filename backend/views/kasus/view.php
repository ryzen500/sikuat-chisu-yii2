<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TbPermohonanLab $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Permohonan Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tb-permohonan-lab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'KD_PELAYANAN',
            'KD_PASIEN',
            'KD_PUSKESMAS',
            'no_sediaan',
            'lokasi_anatomi',
            'tanggal_permohonan',
            'pengirim',
            'alasan:ntext',
            'faskes_tujuan',
            'tanggal_pengambilan',
            'tanggal_pengiriman',
            'jenis_pemeriksaan',
            'followup_ke',
            'periksa_ulang_ke',
            'contoh_uji',
            'contoh_uji_lain',
            'nomor_permohonan',
            'satusehat_response:ntext',
            'ID_KUNJUNGAN',
            'ID_SERVICEREQUEST_SATUSEHAT',
            'ID_SPECIMEN_SATUSEHAT',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
