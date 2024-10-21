<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\Pasien;

$lokasiAnatomiOptions = Pasien::getLokasiAnatomiOptions();
$getTipePasienTBOptions = Pasien::getTipePasienOptions();
$getTerdugaTBOptions = Pasien::getTerdugaTbOptions();
$getYesNoOptions = Pasien::getYesNoOptions();

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
                             <?=  $form->field($model, 'person_id')->dropDownList($lokasiAnatomiOptions, ['id' => 'lokasi_anatomi'])->label('Pilih Pasien') ?>


                            <?=  $form->field($model, 'terduga_tb_id')->dropDownList($getTerdugaTBOptions, ['id' => 'lokasi_anatomi'])->label('Kriteria TB') ?>



                             <?=  $form->field($model, 'status_hiv_id')->dropDownList($getYesNoOptions, ['id' => 'lokasi_anatomi'])->label('Status hiv') ?>
                        </div>

                        <!-- Pisah -->
            	 	   <div class="col-lg-6">
                            <?=  $form->field($model, 'tipe_pasien_id')->dropDownList($getTipePasienTBOptions, ['id' => 'lokasi_anatomi'])->label('Tipe Pasien TB') ?>

                             <?=  $form->field($model, 'status_dm_id')->dropDownList($getYesNoOptions, ['id' => 'lokasi_anatomi'])->label('Status DM') ?>


                             <?=  $form->field($model, 'imunisasi_bcg_id')->dropDownList($getYesNoOptions, ['id' => 'lokasi_anatomi'])->label('Imunisasi BCG') ?>

                           
                        </div>

                    </div>
<!-- 
                    <div class="row">
                   
                    </div>

                    <div class="row">
                   
                    </div>

                    <div class="row">
                       
                    </div>

                    <div class="row">
               
                    </div> -->

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
