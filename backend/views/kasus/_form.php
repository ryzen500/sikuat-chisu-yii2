<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\LokasiPenyakitAnatomi;
// use app\models\DokterPengirim;
use app\models\HasilPengirim;
use app\models\AlasanPemeriksaan;
use app\models\JenisPemeriksaan;
use app\models\HasilDiagnosis;
use app\models\JenisContohUji;
use app\models\TipePengirim;
use app\models\TindakLanjut;
use app\models\TempatPengobatan;

$lokasiAnatomiOptions = LokasiPenyakitAnatomi::getValues();
// $dokterPengirimOptions = DokterPengirim::getValues();
$HasilPengirimOptions = HasilPengirim::getValues();
$HasilDiagnosisOptions = HasilDiagnosis::getValues();

$alasanPemeriksaanOptions = AlasanPemeriksaan::getValues();
$jenisPemeriksaanOptions = JenisPemeriksaan::getValues();
$jenisContohUjiOptions = JenisContohUji::getValues();
$TindakLanjutOptions = TindakLanjut::getValues();
$TempatPengobatanOptions = TempatPengobatan::getValues();
$TipePengirimOptions = TipePengirim::getValues();

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

                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                    <?php if (isset($model)): ?>
                        <?= Html::hiddenInput('id', $model->id, ['class' => 'form-control']) ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-6">

                            <?= $form->field($model, 'tanggal_hasil')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tanggal_hasil', 'autocomplete' => 'off'],
                            ])->label('Tanggal Hasil <small style="color: red;">*</small>') ?>

                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'lokasi_anatomi')->dropDownList($lokasiAnatomiOptions, ['id' => 'lokasi_anatomi'])->label('Lokasi Anatomi Penyakit') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'thorax_tanggal')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tgl_permohonan', 'autocomplete' => 'off'],
                            ])->label('Thorax Tanggal <small style="color: red;">*</small>') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'thorax_kesan')->dropDownList($HasilPengirimOptions, ['id' => 'thorax_kesan'])->label('Dokter Pengirim') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                               <?= $form->field($model, 'hasil_diagnosis')->dropDownList($HasilDiagnosisOptions, ['id' => 'hasil_diagnosis'])->label('Hasil Diagnosis') ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'tipe_diagnosis')->dropDownList($TipePengirimOptions, ['id' => 'tipe_diagnosis'])->label('Tipe Diagnosis') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'tindak_lanjut')->dropDownList($TindakLanjutOptions, ['id' => 'tindak_lanjut'])->label('Tindak Lanjut Hasil Diagnosis') ?>
                        </div>
          
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                                  <?= $form->field($model, 'tempat_pengobatan')->dropDownList($TempatPengobatanOptions, ['id' => 'tempat_pengobatan'])->label('Tempat Pengobatan') ?>
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

    <style>
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-item {
            display: flex;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-item label {
            margin-right: 10px;
        }

        .form-item input[type="text"],
        .form-item input[type="date"],
        .form-item select,
        .form-item div {
            flex: 1;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
