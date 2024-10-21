<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\LokasiPenyakitAnatomi;
use app\models\DokterPengirim;
use app\models\TbRujukan;
use app\models\AlasanPemeriksaan;
use app\models\JenisPemeriksaan;
use app\models\JenisContohUji;


$TbRujukan = TbRujukan::getDataRujukanFaskes();

$lokasiAnatomiOptions = LokasiPenyakitAnatomi::getValues();
$dokterPengirimOptions = DokterPengirim::getValues();
$alasanPemeriksaanOptions = AlasanPemeriksaan::getValues();
$jenisPemeriksaanOptions = JenisPemeriksaan::getValues();
$jenisContohUjiOptions = JenisContohUji::getValues();

?>

<style>
    .error {
        color: red !important;
    }
</style>

<div class="container-fluid" id="form-scroll">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover main-layer">
                <div class="card-header">
                    <h4>
                        <?= Html::encode($menu) ?>
                        <?= Html::button('<i class="fa fa-search"></i> Cari Data Permohonan Lab', [
                            'class' => 'btn btn-info float-right btnCaPas',
                            'data-toggle' => 'modal',
                            'data-target' => '#detail-dialog',
                        ]) ?>
                    </h4>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'commentFormPasien',
                        'action' => 'javascript:void(0)',
                        'method' => 'post',
                    ]); ?>

                    <?php if (isset($model)): ?>
                        <?= Html::hiddenInput('id', $model->id, ['class' => 'form-control']) ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'no_sediaan')->textInput(['id' => 'no_sediaan', 'autocomplete' => 'off'])->label('Nomer Persediaan') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'lokasi_anatomi')->dropDownList($lokasiAnatomiOptions, ['id' => 'lokasi_anatomi'])->label('Lokasi Anatomi Penyakit') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'tanggal_permohonan')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tgl_permohonan', 'autocomplete' => 'off'],
                            ])->label('Tanggal Permohonan <small style="color: red;">*</small>') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'pengirim')->dropDownList($dokterPengirimOptions, ['id' => 'pengirim'])->label('Dokter Pengirim') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'alasan_pemeriksaan')->dropDownList($alasanPemeriksaanOptions, ['id' => 'alasan_pemeriksaan'])->label('Alasan Pemeriksaan') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'jenis_pemeriksaan')->dropDownList($jenisPemeriksaanOptions, ['id' => 'jenis_pemeriksaan'])->label('Jenis Pemeriksaan') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'contoh_uji')->dropDownList($jenisContohUjiOptions, ['id' => 'contoh_uji'])->label('Jenis Contoh Uji') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'tanggal_pengambilan')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tanggal_pengambilan', 'autocomplete' => 'off'],
                            ])->label('Tanggal Pengambilan Contoh Uji') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'tanggal_pengiriman')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tanggal_pengiriman', 'autocomplete' => 'off'],
                            ])->label('Tanggal Pengiriman Contoh Uji') ?>
                        </div>


                        <div class="col-lg-6">
                            <?=  $form->field($model, 'faskes_tujuan')->dropDownList($TbRujukan, ['id' => 'lokasi_anatomi'])->label('Pilih faskes Tujuan') ?>
                        </div>

                    </div>

                    <div class="float-right mt-3">
                        <?= Html::a('Kembali', 'javascript:void(0)', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'kembali()']) ?>
                        <?= Html::button(isset($pasien) ? 'Ubah' : 'Simpan', ['class' => 'btn btn-success bg-success btn-sm', 'id' => 'btn-save']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
   $('#btn-save').on('click', function (e) {
        e.preventDefault();

        // Gather form data
        var formData = $('#commentFormPasien').serialize();

        $.ajax({
            url: 'save',  // Ensure the correct controller action is called
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.href = 'index'; // Redirect to index or another appropriate page
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There were errors while saving the data.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    // Optionally, you can display errors inline on the form
                    $.each(response.errors, function (key, val) {
                        $('#' + key).after('<div class="error">' + val + '</div>');
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
