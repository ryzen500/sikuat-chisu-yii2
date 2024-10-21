<?php $__env->startSection('extended_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       <div class="loading" align="center" style="display: none;">
        <img src="<?php echo asset('assets/img/loading.gif'); ?>" width="20%" style="padding: 100px 0px;">
      </div>

      <div class="cardKustom strpied-tabled-with-hover main-layer">
        <div class="card-header ">
          <h4 class="card-title">
            <?php echo e(isset($data['title']) ? $data['title'] : ''); ?> 
            <span style="padding-right: 20px">              
              <!-- Button Tambah -->
              <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right" id="btn-add">Tambah Data</a>
            </span>
          </h4>
 
          <!-- Modal Import Excel -->
          <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <form method="post" id="importexcelsave" enctype="multipart/form-data">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                          </div>
                          <div class="modal-body">

                              <label>Pilih file excel</label>
                              <div class="form-group">
                                  <input type="file" name="file" required="required">
                              </div>

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" id="btn-save-excel" class="btn btn-primary">Import</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>

        <div class="p-3 table-responsive">
          <table class="table table-striped table-hover" id="datatabel" style="width: 100% !important;">
            <thead>
              <tr>
                  <th>No Sediaan</th>
                  <th>Terduga TB</th>
                  <th>Tipe Pasien</th>
    

                  <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
<div class="other-page"></div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extended_js'); ?>
<script type="text/javascript">

  var datatabel = '';
  $(document).ready(function() {
    datatabel = $('#datatabel').DataTable({
      processing: true,
      serverSide : true,
      "ajax": "<?php echo e(route('terdugaDatagrid')); ?>",
      "columns": [
      { data:"no_sediaan", orderable:false, sortable:false, searchable:true},
      { data:"jenis_terduga", orderable:false, searchable:true},
      { data:"jenis_pasien", orderable:false, searchable:false},
      { data:"aksi" , "class" : "text-center", "width" : "120px", orderable:false, searchable:false},
      ]
    });
  });

  function kembali() {
    $(".main-layer").show();
    $(".other-page").hide();
  }

  $("#btn-add").on('click', function() {
    $(".loading").show();
    $(".main-layer").hide();

    $.post("<?php echo route('formterduga'); ?>",{id:''}).done(function(data){
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  });

  function detailForm(id){
    $(".loading").show();
    $(".main-layer").hide();

    $.post("<?php echo route('detailHasilDiagnosis'); ?>",{id:id}).done(function(data){
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  }

  function editForm(id){
    $(".loading").show();
    $(".main-layer").hide();

    $.post("<?php echo route('formHasilDiagnosis'); ?>",{id:id}).done(function(data){
      console.log(data);
      if (data.status == 'success') {
        $(".loading").hide();
        $('.other-page').html(data.content).fadeIn();
      }else{
        $(".main-layer").show();
      }
    })
  }

  function deleteForm(id){
    swal({
      title:"Hapus data",
      text:"Apakah anda yakin ?",
      type:"warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Saya yakin!",
      cancelButtonText: "Batal!",
      closeOnConfirm: false
    },
    function(){
      $.post("<?php echo route('deletehasilLab'); ?>",{id:id}).done(function(data){
        if (data.status == 'success') {
          datatabel.ajax.reload();
          swal({
            title : data.head_message,
            text : data.message,
            type : data.type,
            showConfirmButton: true
          });
        }else{
          datatabel.ajax.reload();
          swal({
            title : data.head_message,
            text : data.message,
            type : data.type,
            showConfirmButton: true
          });
        }
      })
    })
  }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('component.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/winatabayu/PhpstormProjects/sikuat-chisu/resources/views/tb_terduga/main.blade.php ENDPATH**/ ?>