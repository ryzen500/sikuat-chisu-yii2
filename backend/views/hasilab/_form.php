<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\LokasiPenyakitAnatomi;
use app\models\DokterPengirim;
use app\models\AlasanPemeriksaan;
use app\models\JenisPemeriksaan;
use app\models\KondisiContohUjiId;
use app\models\JenisContohUji;

$lokasiAnatomiOptions = LokasiPenyakitAnatomi::getValues();
$dokterPengirimOptions = DokterPengirim::getValues();
$alasanPemeriksaanOptions = AlasanPemeriksaan::getValues();
$jenisPemeriksaanOptions = JenisPemeriksaan::getValues();
$jenisContohUjiOptions = JenisContohUji::getValues();
$KondisiContohUjiIdOptions = KondisiContohUjiId::getValues();

$form = ActiveForm::begin([
    'id' => 'multiStepForm',
    'method' => 'post',
    'action' => 'javascript:void(0)',
]);

// echo "<pre>";
// var_dump($model);die;
if (isset($model)) {
    echo Html::hiddenInput('id', $model->id);
}
?>

<div class="accordion">
    <!-- Step 1 -->
    <div class="accordion-item">
        <div class="accordion-header" id="header1">
            <h2>Tambah Informasi Terduga telah ada hasil lab</h2>
            <button type="button" class="toggle-button" data-target="#content1">&#10006;</button>
        </div>
        <div class="accordion-content active" id="content1">
            <div class="form-container">
                <fieldset>
                    <!-- No. Sediaan -->
                    <div class="form-item">
                        <?= $form->field($model, 'no_sediaan')->textInput([
                            'id' => 'no_sediaan',
                            'required' => true,
                            'value' => isset($model) ? $model->no_sediaan : ''
                        ])->label('No. Sediaan', ['class' => 'declabel2', 'style' => 'width: 150px;']) ?>
                        
                        
                        <a href="https://devel.sitb.id/newtraining/Download/no_sediaan_help">
                            <img id="no_sediaan_help" src="https://devel.sitb.id/newtraining/themes/default/images/help.gif" title="No. Sediaan" />
                        </a>
                    </div>

                    <!-- Lokasi Anatomi Penyakit -->
                    <div class="form-item">
                           <?= $form->field($model, 'lokasi_anatomi')->dropDownList($lokasiAnatomiOptions, ['id' => 'lokasi_anatomi'])->label('Lokasi Anatomi Penyakit') ?>
                    </div>

                    <!-- Tanggal Permohonan -->
                    <div class="form-item">

                               <?= $form->field($model, 'tanggal_daftar')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tgl_permohonan', 'autocomplete' => 'off'],
                            ])->label('Tanggal Permohonan <small style="color: red;">*</small>') ?>


                    </div>
                </fieldset>

                <!-- Penerima -->
                <div class="form-item">
                      <?= $form->field($model, 'penerima')->dropDownList($dokterPengirimOptions, ['id' => 'penerima'])->label('Dokter Pengirim') ?>
                </div>

                <!-- Pemeriksa -->
                <div class="form-item">
                   <?= $form->field($model, 'pemeriksa')->dropDownList($dokterPengirimOptions, ['id' => 'pemeriksa'])->label('pemeriksa') ?>
                </div>

                <fieldset>
                    <!-- Jenis Pemeriksaan -->
                    <div class="form-item">
                           <?= $form->field($model, 'jenis_pemeriksaan')->dropDownList($jenisPemeriksaanOptions, ['id' => 'jenis_pemeriksaan'])->label('Jenis Pemeriksaan') ?>
                    </div>

                    <!-- Tanggal Contoh Uji Diterima -->
                    <div class="form-item">

                               <?= $form->field($model, 'tgl_contoh_uji')->widget(DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control tgl_contoh_uji', 'autocomplete' => 'off'],
                            ])->label('Tanggal Contoh Uji Diterima / Konfirmasi Penerimaan <small style="color: red;">*</small>') ?>



                    </div>

                    <!-- Kondisi Contoh Uji -->
                    <div class="form-item">

                           <?= $form->field($model, 'kondisi_contoh_uji_id')->dropDownList($KondisiContohUjiIdOptions, ['id' => 'kondisi_contoh_uji_id'])->label('Kondisi Contoh Uji') ?>

                      
                    </div>

                    <!-- Jenis Contoh Uji -->
                    <div class="form-item">

                           <?= $form->field($model, 'contoh_uji')->dropDownList($KondisiContohUjiIdOptions, ['id' => 'kondisi_contoh_uji_id'])->label(' Contoh Uji') ?>


                           <?= $form->field($model, 'contoh_uji_lain')->textInput([
                            'id' => 'contoh_uji_lain',
                            'value' => isset($model) ? $model->contoh_uji_lain : ''
                        ])->label('Contoh Uji Lain', ['class' => 'declabel2', 'style' => 'width: 150px;']) ?>
                        
                        
                    </div>
                </fieldset>

                <!-- Save and Continue -->
                <div class="form-item">
                    <?= Html::button('Save and Continue', ['id' => 'goToStep2', 'class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2 -->
    <div class="accordion-item">
        <div class="accordion-header" id="header2">
            <h2>Hasil Pemeriksaan</h2>
            <button type="button" class="toggle-button" data-target="#content2">◼</button>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class="accordion-content" id="content2">
            <div class="card" id="mikroskopis-card">
                <div class="card-header"> Hasil Pemeriksaan Mikroskopis (BTA/lainnya) </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Contoh Uji</th>
                                <th>No. Reg Lab</th>
                                <th>Tanggal Hasil</th>
                                <th>Hasil Uji</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <?= $form->field($model, 'contoh_uji')->dropDownList(['A' => 'A', 'B' => 'B'], ['class' => 'form-control'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'no_reg_hasil')->textInput(['id' => 'no_reg_hasil', 'class' => 'form-control'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'tanggal_hasil')->input('date', ['id' => 'tanggal_hasil', 'class' => 'form-control'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'hasil')->dropDownList([
                                        '' => 'Pilih', 
                                        'negatif' => 'negatif', 
                                        '1' => '1', 
                                        '2' => '2', 
                                        '3' => '3', 
                                        '4' => '4', 
                                        '5' => '5', 
                                        '6' => '6', 
                                        '7' => '7', 
                                        '8' => '8', 
                                        '9' => '9', 
                                        '1+' => '1+', 
                                        '2+' => '2+', 
                                        '3+' => '3+', 
                                        'tdl' => 'tdl'
                                    ], ['class' => 'form-control'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'catatan')->textInput(['id' => 'catatan', 'class' => 'form-control'])->label(false) ?>
                                </td>
                            </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Submit Form -->

                    <div class="float-right mt-3">
                        <?= Html::a('Kembali', 'javascript:void(0)', ['class' => 'btn btn-primary btn-sm', 'onclick' => 'kembali()']) ?>
                        <?= Html::button(isset($pasien) ? 'Ubah' : 'Simpan', ['class' => 'btn btn-success bg-success btn-sm', 'id' => 'btn-save']) ?>
                    </div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">

$(document).ready(function() {
    // Hide cards initially
    $('#mikroskopis-card').hide();
    $('#tcm-card').hide();

    // Show relevant table based on selected 'jenis_pemeriksaan'
    $('#jenis_pemeriksaan').on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue === 'mikroskopis') {
            $('#mikroskopis-card').show();
            $('#tcm-card').hide();
        } else {
            $('#mikroskopis-card').hide();
            $('#tcm-card').show();
        }
    });

    // Toggle accordion content visibility
    $('.toggle-button').on('click', function() {
        var targetId = $(this).data('target');
        $(targetId).toggleClass('active');

        // Toggle icon
        if ($(targetId).hasClass('active')) {
            $(this).html('&#10006;'); // X icon
        } else {
            $(this).html('&#9724;'); // Maximize icon
        }
    });

    // Handle form step navigation
    $('#goToStep2').on('click', function() {
        var form = $('#multiStepForm')[0];
        if (form.checkValidity()) {
            $('#content1').removeClass('active');
            $('#content2').addClass('active');
        } else {
            form.reportValidity(); // Triggers native form validation
        }
    });

    // Handle form submission
    $('#btn-save').click(function(e) {
        e.preventDefault();
                // var formData = $('#commentFormPasien').serialize();


        // var data = $('#multiStepForm').serialize();
        $('#btn-save').attr('disabled', true);

    // Gather form data
        var formData = $('#multiStepForm').serialize();

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
});
    

</script>