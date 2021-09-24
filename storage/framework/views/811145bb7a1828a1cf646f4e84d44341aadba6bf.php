
<?php $__env->startSection('title',__('adminstaticwords.AllAudioLanguages')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('audio_language.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i><?php echo e(__('adminstaticwords.CreateAudioLanguage')); ?></a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> <?php echo e(__('adminstaticwords.DeleteSelected')); ?></a>   
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading"><?php echo e(__('adminstaticwords.AreYouSure')); ?></h4>
              <p><?php echo e(__('adminstaticwords.DeleteWarrning')); ?></p>
            </div>
            <div class="modal-footer">
              <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body genre-card">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="<?php echo e(app('request')->input('name') ?? ''); ?>" type="text" name="search" cllass="form-control float-left text-center" placeholder="<?php echo e(__('Search Genre')); ?>">
          </form>
       
        </div>
      </form>
      <div class="row">
        <?php if($audio_languages != NULL && count($audio_languages) > 0): ?>
          <?php $__currentLoopData = $audio_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2">
              <div class="card">
                <?php if($item->image != NULL): ?>
                <img src="<?php echo e(url("images/audiolanguage/" . $item->image)); ?>" class="card-img-top" alt="...">
                <?php else: ?>
                  <img src="<?php echo e(Avatar::create($item->language)->toBase64()); ?>" class="card-img-top" alt="...">
                <?php endif; ?>
                 <div class="overlay-bg"></div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo e($item->language); ?></h5>
                  <div class="card-icons">
                    <ul>
                      <li>
                        <a href="<?php echo e(route('audio_language.edit', $item->id)); ?>" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      </li>
                      <li>
                       <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal<?php echo e($item->id); ?>"><i class="material-icons">delete</i> </button>
                       <div id="deleteModal<?php echo e($item->id); ?>" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading"><?php echo e(__('adminstaticwords.AreYouSure')); ?></h4>
                              <p><?php echo e(__('adminstaticwords.DeleteWarrning')); ?></p>
                            </div>
                            <div class="modal-footer">
                              <form method="POST" action="<?php echo e(route("audio_language.destroy", $item->id)); ?>">
                                <?php echo method_field("DELETE"); ?>
                                <?php echo csrf_field(); ?>
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                                  <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-12 pagination-block">
           <?php echo $audio_languages->appends(request()->query())->links(); ?>

          </div>
        <?php else: ?>
          <div class="col-md-12 text-center">
            <h5><?php echo e(__("Let's start :)")); ?></h5>
            <small><?php echo e(__('Get Started by creating a genre! All of your genres will be displayed on this page.')); ?></small>
          </div>
        <?php endif; ?>
     
      </div>
    </div>
  
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/audio_language/index.blade.php ENDPATH**/ ?>