
<?php $__env->startSection('title',__('adminstaticwords.AllLiveTv')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('livetv.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreateLiveTv')); ?></a>
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

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
            <input value="<?php echo e(app('request')->input('name') ?? ''); ?>" type="text" name="search" cllass="form-control float-left text-center" placeholder="<?php echo e(__('Search LiveTv')); ?>">
          </form>
       
        </div>
      </form>
      <div class="row">
        <?php if(isset($movies) && count($movies) > 0): ?>
          <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3">
              <div class="card-two card">
                <?php if($item->thumbnail != NULL): ?>
                <img src="<?php echo e(url('/images/movies/thumbnails/' . $item->thumbnail)); ?>" class="card-img-top" alt="...">
                <?php elseif($item->poster != NULL): ?>
                <img src="<?php echo e(url('/images/movies/thumbnails/' . $item->poster)); ?>" class="card-img-top" alt="...">
                <?php else: ?>
                <img src="<?php echo e(Avatar::create($item->title)->toBase64()); ?>" class="card-img-top" alt="...">
                <?php endif; ?>
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title"><?php echo e($item->title); ?></h5>
                </div>
                <div class="card-body">
                  
                  <div class="card-block card-block-ratings">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Ratings')); ?></h6>
                    <?php
                    $rating = ($item->rating)/2;
                    ?>
                    <table>
                      <tr>
                        <td>
                          <input class="rating" id="input-<?php echo e($item->id); ?>" name="input-3" value="<?php echo e($rating); ?>" class="rating-loading" disabled>
                        </td>
                      </tr>
                    </table>
                    <p><?php echo e($item->rating); ?>/10</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Genre')); ?></h6>

                    <?php
                     $genres = collect();
                      if (isset($item->genre_id)){
                        $genre_list = explode(',', $item->genre_id);
                        for ($i = 0; $i < count($genre_list); $i++) {
                          try {
                            $genre = App\Genre::find($genre_list[$i])->name;
                            $genres->push($genre);
                          } catch (Exception $e) {

                          }
                        }
                      }
                    ?>
                    
                    <p>
                      <?php if(count($genres) > 0): ?>
                        <?php for($i = 0; $i < count($genres); $i++): ?>
                          <?php if($i == count($genres)-1): ?>
                            <?php echo e($genres[$i]); ?>

                          <?php else: ?>
                            <?php echo e($genres[$i]); ?>,
                          <?php endif; ?>
                         <?php endfor; ?>
                      <?php endif; ?>
                    </p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('Description')); ?></h6>
                    <p><?php echo e(str_limit($item->detail,150)); ?></p>
                  </div>
                  
                  <div class="card-block">
                    <h6 class="card-body-sub-heading"><?php echo e(__('LiveTv Emotions')); ?></h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="<?php echo e(url('movie/detail', $item->slug)); ?>" target="__blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                        <li>
                          <a href="<?php echo e(route('livetv.edit', $item->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Edit')); ?>" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
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
                                    <form method="POST" action="<?php echo e(route("livetv.destroy", $item->id)); ?>">
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
            <?php echo $movies->appends(request()->query())->links(); ?>

          </div>
        <?php else: ?>
          <div class="col-md-12 text-center">
            <h5><?php echo e(__("Let's start :)")); ?></h5>
            <small><?php echo e(__('Get Started by creating a livetv! All of your livetvs will be displayed on this page.')); ?></small>
          </div>
        <?php endif; ?>
    
    </div>
 
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
 <script>
    $(document).ready(function(){
        $('.rating').rating({displayOnly: false, step: 0.5});
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/livetv/index.blade.php ENDPATH**/ ?>