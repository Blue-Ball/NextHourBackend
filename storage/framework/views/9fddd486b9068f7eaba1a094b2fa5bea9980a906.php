
<?php $__env->startSection('title',__('adminstaticwords.AllLiveEvents')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('liveevent.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreateLiveEvent')); ?></a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> <?php echo e(__('adminstaticwords.DeleteSelected')); ?></a>   
     
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'LiveEventController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="<?php echo e(app('request')->input('name') ?? ''); ?>" type="text" name="search" cllass="form-control float-left text-center" placeholder="<?php echo e(__('Search LiveEvent')); ?>">
          </form>
       
        </div>
      </form>
      <div class="row">
        <?php if(isset($liveevent) && count($liveevent) > 0): ?>
          <?php $__currentLoopData = $liveevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3">
              <div class=" card">
                <?php if($item->thumbnail != NULL): ?>
                <img src="<?php echo e(url('/images/events/thumbnails/' . $item->thumbnail)); ?>" class="card-img-top" alt="...">
                <?php elseif($item->poster != NULL): ?>
                <img src="<?php echo e(url('/images/events/thumbnails/' . $item->poster)); ?>" class="card-img-top" alt="...">
                <?php else: ?>
                <img src="<?php echo e(Avatar::create($item->title)->toBase64()); ?>" class="card-img-top" alt="...">
                <?php endif; ?>
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title"><?php echo e($item->title); ?></h5>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Start Time')); ?></h6>
                    <p><?php echo e(isset($item->start_time) && $item->start_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->start_time)) : '-'); ?></p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('End Time')); ?></h6>
                    <p><?php echo e(isset($item->end_time) && $item->end_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->end_time)) : '-'); ?></p>
                  </div>
                 
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Organized By')); ?></h6>
                    <p><?php echo e(isset($item->organized_by) && $item->organized_by ? $item->organized_by : '-'); ?></p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Description')); ?></h6>
                    <p><?php echo e(isset($item->description) && $item->description ? str_limit($item->description,50) : '-'); ?></p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('LiveEvent Emotions')); ?></h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="<?php echo e(url('event/detail', $item->slug)); ?>" data-toggle="tooltip" data-original-title=" Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                      
                        <li>
                          <a href="<?php echo e(route('liveevent.edit', $item->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Edit')); ?>" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                        <li>
                          <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal<?php echo e($item->id); ?>"><i class="material-icons">delete</i> </a>
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
                                    <form method="POST" action="<?php echo e(route("liveevent.destroy", $item->id)); ?>">
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
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-12 pagination-block">
            <?php echo $liveevent->appends(request()->query())->links(); ?>

          </div>
        <?php else: ?>
          <div class="col-md-12 text-center">
            <h5><?php echo e(__("Let's start :)")); ?></h5>
            <small><?php echo e(__('Get Started by creating a liveevent ! All of your liveevents will be displayed on this page.')); ?></small>
          </div>
        <?php endif; ?>
    </div>
  
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/liveevent/index.blade.php ENDPATH**/ ?>