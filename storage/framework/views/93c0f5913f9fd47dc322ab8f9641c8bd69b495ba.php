<div class="sidebar-wrapper">
	<div class="logo">
		<div class="text-center">
			<img src="<?php echo e(url('/assets/img/logo.png')); ?>" width="70px">
		</div>
		<a href="<?php echo e(url('/')); ?>" class="simple-text">
			SIKUAT (SIDOARJO)
		</a>
	</div>
	<ul class="nav">
		<?php echo $__env->make('component.menu.pasien', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('component.menu.terduga_tb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('component.menu.permohonan_lab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('component.menu.hasil_lab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('component.menu.hasil_diagnosis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</ul>
</div><?php /**PATH /Users/winatabayu/PhpstormProjects/sikuat-chisu/resources/views/component/sidebar.blade.php ENDPATH**/ ?>