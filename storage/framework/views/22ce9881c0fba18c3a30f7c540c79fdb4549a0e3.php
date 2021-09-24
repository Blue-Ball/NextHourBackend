
<?php $__env->startSection('title','Progressive Web App Setting | '); ?>
<?php $__env->startSection('content'); ?>
	<div class="admin-form-main-block mrg-t-40">
		<div class="box-header with-border">
			<div class="box-title">
				<?php echo e(__('adminstaticwords.ProgressiveWebAppSetting')); ?>

			</div>		
		</div>
		<div class="box-body admin-form-block z-depth-1">
			<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
		  
		  <li role="presentation" class="nav-item">
			<a class="nav-link active" data-toggle="pill" href="#home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><?php echo e(__('adminstaticwords.AppSetting')); ?></a>
		  </li>
		  <li role="presentation" class="nav-item">
			<a class="nav-link" data-toggle="pill" href="#profile" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><?php echo e(__('adminstaticwords.UpdateIcons')); ?></a>
		  </li>
		  
		</ul>

		<!-- Tab panes -->
		<div class="tab-content" id="custom-tabs-four-tabContent">
		  <div role="tabpanel" class="tab-pane active" id="home">
				<br>
			  <div class="callout callout-success">
				  <i class="fa fa-info-circle"></i>
				   <?php echo e(__('adminstaticwords.ProgessiveWebAppRequirements')); ?>

				   <ul>
					   <li><b><?php echo e(__('adminstaticwords.Https')); ?></b> <?php echo e(__('adminstaticwords.HttpsNote')); ?></li>
				    	<li><b><?php echo e(__('adminstaticwords.StartURL')); ?></b> <?php echo e(__('adminstaticwords.StartURLNote')); ?></li>
				   </ul>
			  </div>

			  <div class="row">
				  <div class="col-md-12">
					  <form action="<?php echo e(route('pwa.setting.update')); ?>" method="POST" enctype="multipart/form-data">
						  <?php echo csrf_field(); ?>

						  <div class="form-group">
							 
							  <div class="form-group make-switch">
							  	<div class="col-md-5">
							  		<h5 class="bootstrap-switch-label"><?php echo e(__('adminstaticwords.EnablePWA')); ?></h5>
							  	</div>
								<input class="bootswitch col-md-5" <?php echo e(env("PWA_ENABLE") =='1' ? "checked" : ""); ?> type="checkbox" data-on-text="<?php echo e(__('adminstaticwords.On')); ?>" data-off-text="<?php echo e(__('adminstaticwords.OFF')); ?>" name="PWA_ENABLE" >
								
							  </div>
						  </div>
						  
						  <div class="form-group">
							  <label><?php echo e(__('adminstaticwords.AppName')); ?>: </label>
							  <input  class="form-control" type="text" name="app_name" value="<?php echo e(env("PWA_NAME")); ?>"/>
						  </div>

						  <div class="row">
							  <div class="col-md-6">
								  <div class="form-group">
									  <label><?php echo e(__('adminstaticwords.ThemeColorForHeader')); ?>: </label>
									  <input name="PWA_THEME_COLOR" class="form-control" type="color" value="<?php echo e(env('PWA_THEME_COLOR') ?? ''); ?>"/>
								  </div>
							  </div>
							  <div class="col-md-6">
								  <div class="form-group">
									  <label for=""><?php echo e(__('adminstaticwords.BackgroundColor')); ?>:</label>
									  <input name="PWA_BG_COLOR" class="form-control" type="color" value="<?php echo e(env('PWA_BG_COLOR') ?? ''); ?>"/>
								  </div>
							  </div>
						  </div>

						  <div class="row">
							  <div class="col-md-5">

								  <div class="form-group">
						
							
									<label for=""><?php echo e(__('adminstaticwords.ShortcutIconForHome')); ?>: <span class="text-danger">*</span> </label>
									
									<div class="custom-file">
									  <input name="shorticon_1" type="file" class="custom-file-input <?php $__errorArgs = ['shorticon_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="shorticon_1">
									  <label class="custom-file-label" for="shorticon_1"><?php echo e(__("Select icon for login (96 x 96)")); ?></label>
									</div>
					  
									<?php $__errorArgs = ['shorticon_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									  <span class="invalid-feedback" role="alert">
										  <strong><?php echo e($message); ?></strong>
									  </span>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								  </div>
							  </div>
                            <?php if(env('SHORTCUT_ICON1') != NULL): ?>
							  <div class="col-md-1 card text-center">
							  	<?php if(env('SHORTCUT_ICON1') != NULL): ?>
								<div class="card-body">
									<img class="img-responsive" src="<?php echo e(url('images/icons/'.env('SHORTCUT_ICON1'))); ?>" alt="<?php echo e('shorticon_1'); ?>">
								</div>
								<?php endif; ?>
							  </div>
                            <?php endif; ?>
							  <div class="col-md-5">
								  <div class="form-group">
									<label for=""><?php echo e(__('adminstaticwords.ShortcutIconForLogin')); ?>: <span class="text-danger">*</span> </label>
									
									<div class="custom-file">
									  <input name="shorticon_2" type="file" class="custom-file-input <?php $__errorArgs = ['shorticon_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="shorticon_2">
									  <label class="custom-file-label" for="shorticon_2"><?php echo e(__("Select icon for home (96 x 96)")); ?></label>
									</div>
					  
									<?php $__errorArgs = ['shorticon_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									  <span class="invalid-feedback" role="alert">
										  <strong><?php echo e($message); ?></strong>
									  </span>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								  </div>
							  </div>
                             <?php if(env('SHORTCUT_ICON2') != NULL): ?>
							  <div class="col-md-1 card text-center">
							  
								  <div class="card-body">
									<img class="img-responsive" src="<?php echo e(url('images/icons/'.env('SHORTCUT_ICON2'))); ?>" alt="<?php echo e('shorticon_2'); ?>">
								  </div>
								
							  </div>
                            <?php endif; ?>
							  

						  </div>
  

						  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving..." type="submit" class="btn btn-default btn-add">
							 <?php echo e(__('adminstaticwords.SaveChanges')); ?>

						</button>
					  </form>
				  </div>

			  </div>
			  
		  </div>
		  <div role="tabpanel" class="tab-pane" id="profile">
				<br>
			  <h4><?php echo e(__('adminstaticwords.PWAIcons')); ?>:</h4>

			  <hr>

			  <form action="<?php echo e(route('pwa.icons.update')); ?>" method="POST" enctype="multipart/form-data">
				  <?php echo csrf_field(); ?>
				  <div class="row">
					
					  <div class="col-md-6">
						  <div class="form-group">
						
							
							<label><?php echo e(__('adminstaticwords.PWAIcon')); ?> (512x512): <span class="text-danger">*</span> </label>
							
							<div class="custom-file">
							  <input name="icon_512" type="file" class="custom-file-input <?php $__errorArgs = ['icon_512'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 'is-invalid' <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="icon_512">
							  <label class="custom-file-label" for="icon_512"><?php echo e(__("Select icon (512 x 512)")); ?></label>
							</div>
			  
							<?php $__errorArgs = ['icon_512'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							  <span class="invalid-feedback" role="alert">
								  <strong><?php echo e($message); ?></strong>
							  </span>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						  </div>
					  </div>

					  <div class="offset-md-1 col-md-2 card">
						  <div class="card-body">
							<img class="img-responsive" src="<?php echo e(url('images/icons/icon-512x512.png')); ?>" alt="icon_512x512.png">
						  </div>
					  </div>

					  <div class="col-md-12">
						  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-default btn-add">
							<?php echo e(__('adminstaticwords.UpdateIcon')); ?>

						  </button>
					  </div>

				  </div>

				  <br>

				  <h4><?php echo e(__('adminstaticwords.SplashScreens')); ?>:</h4>
				  <hr>

				  <div class="row">

					  <div class="col-md-6">
						  
						  <div class="form-group">
						
							
							<label><?php echo e(__('adminstaticwords.PWASplashScreen')); ?> (2048x2732): <span class="text-danger">*</span> </label>
							
							<div class="custom-file">
							  <input name="splash_2048" type="file" class="custom-file-input <?php $__errorArgs = ['splash_2048'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 'is-invalid' <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="splash_2048">
							  <label class="custom-file-label" for="splash_2048"><?php echo e(__("Select splash screen (2048x2732)")); ?></label>
							</div>
			  
							<?php $__errorArgs = ['splash_2048'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							  <span class="invalid-feedback" role="alert">
								  <strong><?php echo e($message); ?></strong>
							  </span>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						  </div>
					  </div>

					  <div class="offset-md-1 col-md-2 card">
						 <div class="card-body">
							<img class="img-responsive" src="<?php echo e(url('images/icons/splash-2048x2732.png')); ?>" alt="splash-2048x2732.png">
						 </div>
					  </div>

					  <div class="col-md-12">
						<button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-default btn-add">
							<?php echo e(__('adminstaticwords.UpdateScreen')); ?>

						</button>
					  </div>
					  

				  </div>



			  </form>
		  </div>
		</div>
		</div>
		
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
		<script>
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch();
			});
		</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pwa/index.blade.php ENDPATH**/ ?>