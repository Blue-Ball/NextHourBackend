
<?php $__env->startSection('title',__('adminstaticwords.RemovePublic')); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.RemovePublic')); ?></h4>
  </div>
   <div class="row">
      <div class="col-lg-10 col-xs-6">
      	<div class="admin-form-block z-depth-1">
      		<div class="callout callout-danger">
	    		<i class="fa fa-info-circle"></i>
	    		 <?php echo e(__('adminstaticwords.ImportantNotes')); ?>

	    		 <ol type="1">
	    		 	<li>- <?php echo e(__('adminstaticwords.RemovePublicNote1')); ?></li>
	    		 	<li>- <?php echo e(__('adminstaticwords.RemovePublicNote2')); ?></li>
	    		 </ol>
	    	</div>
      		<form method="POST" action="<?php echo e(route('remove.public')); ?>">
      			<?php echo csrf_field(); ?>
      			<button type="submit" class="btn btn-success"><?php echo e(__('adminstaticwords.RemovePublic')); ?></button>
      			
      		</form>
      	</div>

      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/removepublic.blade.php ENDPATH**/ ?>