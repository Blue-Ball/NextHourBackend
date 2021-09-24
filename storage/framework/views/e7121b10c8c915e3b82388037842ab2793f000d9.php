
<?php $__env->startSection('title',__('adminstaticwords.SystemStatus')); ?>
<?php $__env->startSection('content'); ?>
<div class="content-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.SystemStatus')); ?></h4>
  </div>
 <div class="content-block box-body table-responsive">

    <?php

        $results = DB::select( DB::raw('SHOW VARIABLES LIKE "%version%"') );
    
        foreach ($results as $key => $result) {

            if($result->Variable_name == 'version' ){
                $db_info[] = array(
                    'value'   => $result->Value
                );
            }

            if($result->Variable_name == 'version_comment' ){
                $db_info[] = array(
                    'value'   => $result->Value
                );
            }
        }

        $servercheck= array();

    ?>

   

        
        <div id="message"></div>

        <table class="table table-striped">
          

            <tbody>
                <tr>
                    <td>
                        <b><?php echo e(__('adminstaticwords.LaravelVersion')); ?></b>
                    </td>
                    <td>
                        <?php echo e(App::version()); ?> <i class="fa fa-check-circle text-green"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table class="table table-bordered table-striped">
            <thead>
                
                <th colspan="2">
                    <?php echo e(__('adminstaticwords.MYSQLVersionInfo')); ?>

                </th>
                <th>
                    <?php echo e(__('adminstaticwords.Status')); ?>

                </th>
                
            </thead>
            

            <tbody>
               <?php $__currentLoopData = $db_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($key == 0 ? __('adminstaticwords.MYSQLVersion') : __('adminstaticwords.ServerType')); ?>

                        </td>
                        <td>
                            <?php echo e($info['value']); ?>

                        </td>
                        <td>
                            <?php if($key == 0 && $info['value'] < 5.7): ?>
                                <?php
                                    array_push($servercheck, 0);
                                ?>
                                <i class="fa fa-times-circle text-red"></i>
                            <?php else: ?>
                                <?php
                                    array_push($servercheck, 1);
                                ?>
                            <i class="fa fa-check-circle text-green"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><?php echo e(__('adminstaticwords.PHPExtensions')); ?></th>
                <th><?php echo e(__('adminstaticwords.Status')); ?></th>
              </tr>
            </thead>

            <tbody>

              <tr>
                <?php
                    $v = phpversion();
                ?>
                <td>
                  <?php echo e(__('php version')); ?> (<b><?php echo e($v); ?></b>)
                  <br>
                  <small class="text-muted"><?php echo e(__('adminstaticwords.PHPVersionNote')); ?></small>
                </td>
                <td>

                 <?php if($v = 7.0 && $v < 7.5): ?> <i class="text-green fa fa-check-circle"></i>
                        <?php
                            array_push($servercheck, 1);
                        ?>
                    <?php else: ?>
                        <?php
                            array_push($servercheck, 1);
                        ?>
                    <i class="text-red fa fa-times-circle"></i>
                    <br>
                    <small>
                      <?php echo e(__('adminstaticwords.Yourphpversionis')); ?> <b><?php echo e($v); ?></b><?php echo e(__('adminstaticwords.Whichisnotsupported')); ?>

                    </small>
                   
                    <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.pdo')); ?></td>
                <td>

                  <?php if(extension_loaded('pdo')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.BCMath')); ?></td>
                <td>

                  <?php if(extension_loaded('BCMath')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.openssl')); ?></td>
                <td>

                  <?php if(extension_loaded('openssl')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.fileinfo')); ?></td>
                <td>

                  <?php if(extension_loaded('fileinfo')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                  
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.json')); ?></td>
                <td>

                  <?php if(extension_loaded('json')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                  
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.session')); ?></td>
                <td>
                    

                  <?php if(extension_loaded('session')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.gd')); ?></td>
                <td>

                  <?php if(extension_loaded('gd')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>



              <tr>
                <td><?php echo e(__('adminstaticwords.allow_url_fopen')); ?></td>
                <td>

                  <?php if(ini_get('allow_url_fopen')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                  
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                    
                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>





              <tr>
                <td><?php echo e(__('adminstaticwords.xml')); ?></td>
                <td>

                  <?php if(extension_loaded('xml')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.tokenizer')); ?></td>
                <td>

                  <?php if(extension_loaded('tokenizer')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td><?php echo e(__('adminstaicwords.standard')); ?></td>
                <td>

                  <?php if(extension_loaded('standard')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                  
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstticwords.mysqli')); ?></td>
                <td>

                  <?php if(extension_loaded('mysqli')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.mbstring')); ?></td>
                <td>

                  <?php if(extension_loaded('mbstring')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                 
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.ctype')); ?></td>
                <td>

                  <?php if(extension_loaded('ctype')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-green fa fa-check-circle"></i>
                  
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                    <i class="text-red fa fa-times-circle"></i>
                  
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><?php echo e(__('adminstaticwords.exif')); ?></td>
                <td>

                  <?php if(extension_loaded('exif')): ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>

                  <i class="text-green fa fa-check-circle"></i>
                
                  <?php else: ?>

                        <?php
                            array_push($servercheck, 1);
                        ?>
                  
                  <i class="text-red fa fa-times-circle"></i>
                 
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><b><?php echo e(storage_path()); ?></b> <?php echo e(__('iswritable')); ?>?</td>
                <td>
                  <?php
                    $path = storage_path();
                  ?>
                  <?php if(is_writable($path)): ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>
                  <i class="text-green fa fa-check-circle"></i>
                  <?php else: ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>

                  <i class="text-red fa fa-times-circle"></i>
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><b><?php echo e(base_path('bootstrap/cache')); ?></b> <?php echo e(__('iswritable')); ?>?</td>
                <td>
                  <?php
                    $path = base_path('bootstrap/cache');
                  ?>
                  <?php if(is_writable($path)): ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>

                  <i class="text-green fa fa-check-circle"></i>
                  <?php else: ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>

                  <i class="text-red fa fa-times-circle"></i>
                  <?php endif; ?>
                </td>
              </tr>

              <tr>
                <td><b><?php echo e(storage_path('framework/sessions')); ?></b> <?php echo e(__('iswritable')); ?>?</td>
                <td>
                  <?php
                    $path = storage_path('framework/sessions');
                  ?>
                  <?php if(is_writable($path)): ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>

                  <i class="text-green fa fa-check-circle"></i>
                  <?php else: ?>

                    <?php
                        array_push($servercheck, 1);
                    ?>

                  <i class="text-red fa fa-times-circle"></i>
                  <?php endif; ?>
                </td>
              </tr>


            </tbody>
          </table>

            

       
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script>
        <?php if(!in_array(0, $servercheck)): ?>
            $("#message").html('<div class="callout callout-success"><i class="fa fa-check-circle"></i> <?php echo e(__("adminstaticwords.SuccessMessage")); ?></div>');
        <?php else: ?>
            $('#message').html(' <div class="callout callout-danger"><i class="fa fa-times-circle"></i> <?php echo e(__("adminstaticwords.ErrorMessage")); ?></div>');
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/systemstatus.blade.php ENDPATH**/ ?>