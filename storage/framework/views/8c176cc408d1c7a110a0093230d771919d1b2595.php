
<?php $__env->startSection('title', __('adminstaticwords.PushNotification')); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block">
   <div class="row ">
       <div class="col-md-7 ">
       
            <div class="content-block box-body admin-form-block z-depth-1">
                <form action="<?php echo e(route('admin.push.notif')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
    
                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.SelectUserGroup')); ?>: <span class="text-danger">*</span> </label>
    
                        <select required data-placeholder="<?php echo e(__('adminstaticwords.PleaseSelectUserGroup')); ?>" name="user_group" id="" class="select2 form-control">
                            <option value=""><?php echo e(__('adminstaticwords.PleaseSelectUserGroup')); ?></option>
                            <option <?php echo e(old('user_group') == 'all_customers' ? "selected" : ""); ?> value="all_customers"><?php echo e(__('adminstaticwords.AllUsers')); ?></option>
                            <option <?php echo e(old('user_group') == 'all_sellers' ? "selected" : ""); ?> value="all_sellers"><?php echo e(__('adminstaticwords.AllProducers')); ?></option>
                            <option <?php echo e(old('user_group') == 'all_admins' ? "selected" : ""); ?> value="all_admins"><?php echo e(__('adminstaticwords.AllAdmins')); ?></option>
                            <option <?php echo e(old('user_group') == 'all' ? "selected" : ""); ?> value="all"><?php echo e(__('adminstaticwords.All')); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.Subject')); ?>: <span class="text-red">*</span></label>
                        <input placeholder="<?php echo e(__('adminstaticwords.HeyNewStockArrived')); ?>" type="text" class="form-control" required name="subject" value="<?php echo e(old('subject')); ?>">
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.NotificationBody')); ?>: <span class="text-red">*</span> </label>
                        <textarea required placeholder="<?php echo e(__('adminstaticwords.NotificationBodyNote')); ?>" class="form-control" name="message" id="" cols="3" rows="5"><?php echo e(old('message')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.TargetURL')); ?>: </label>
                        <input value="<?php echo e(old('target_url')); ?>" class="form-control" name="target_url" type="url" placeholder="<?php echo e(url('/')); ?>">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.TargetURLNote')); ?>

                        </small>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.NotificationIcon')); ?>: </label>
                        <input value="<?php echo e(old('icon')); ?>" name="icon" class="form-control" type="url" placeholder="https://someurl/icon.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.NotificationIconNote')); ?>.
                        </small>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo e(__('adminstaticwords.Image')); ?>: </label>
                        <input value="<?php echo e(old('image')); ?>" class="form-control" name="image" type="url" placeholder="https://someurl/image.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> <b><?php echo e(__('adminstaticwords.NotificationImageSize')); ?>.</b>
                        </small>
                    </div>

                    <div class="from-group">
                        <label for=""><?php echo e(__('adminstaticwords.ShowButton')); ?>: </label>
                        <br>
                        <label class="make-switch">
                            <input  class="bootswitch show_button" type="checkbox" name="show_button" data-on-text="On" data-off-text="<?php echo e(__('adminstaticwords.OFF')); ?>" data-size="<?php echo e(__('adminstaticwords.small')); ?>">
                        </label>
                    </div>

                    <div style="display: <?php echo e(old('show_button') ? 'block' : 'none'); ?>;" id="buttonBox">
                        <div class="form-group">
                            <label for=""><?php echo e(__('adminstaticwords.ButtonText')); ?>:  <span class="text-danger">*</span></label>
                            <input value="<?php echo e(old('btn_text')); ?>" class="form-control" name="btn_text" type="text" placeholder="<?php echo e(__('adminstaticwords.GrabNow')); ?>">
                        </div>

                        <div class="form-group">
                            <label for=""><?php echo e(__('adminstaticwords.ButtonTargetURL')); ?>: </label>
                            <input value="<?php echo e(old('btn_url')); ?>" class="form-control" name="btn_url" type="url" placeholder="https://someurl/image.png">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.ButtonTargetURLNote')); ?>.
                            </small>
                        </div>
                    </div>

                    <div class="from-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">
                            <i class="fa fa-location-arrow"></i> <?php echo e(__('adminstaticwords.Send')); ?>

                        </button>
                    </div>
    
                </form>
            </div>
       </div>

       <div class="col-md-4">
           <div class="box">
               <div class="box-header">
                   <div class="box-title">
                        <?php echo e(__('adminstaticwords.OnesignalKeys')); ?>

                   </div>

                   <a title="Get one signal keys" href="https://onesignal.com/" class="pull-right" target="__blank">
                       <i class="fa fa-key"></i> <?php echo e(__('adminstaticwords.GetYourKeysFromHere')); ?>

                   </a>
               </div>

               <div class="content-block box-body  admin-form-block z-depth-1">
                   
                <form action="<?php echo e(route('admin.onesignal.keys')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_APP_ID"> <?php echo e(__('adminstaticwords.ONESIGNALAPPID')); ?>: <span class="text-danger">*</span></label>
                            <input type="password" value="<?php echo e(env('ONESIGNAL_APP_ID')); ?>"
                                name="ONESIGNAL_APP_ID" placeholder="<?php echo e(__('adminstaticwords.EnterONESIGNALAPPID')); ?> " id="ONESIGNAL_APP_ID" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_APP_ID"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_REST_API_KEY"> <?php echo e(__('adminstaticwords.ONESIGNALRESTAPIKEY')); ?>: <span class="text-danger">*</span></label>
                            <input type="password" value="<?php echo e(env('ONESIGNAL_REST_API_KEY')); ?>"
                                name="ONESIGNAL_REST_API_KEY" placeholder="<?php echo e(__('adminstaticwords.EnterONESIGNALRESTAPIKEY')); ?> " id="ONESIGNAL_REST_API_KEY" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_REST_API_KEY"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md">
                           <i class="fa fa-save"></i> <?php echo e(__('adminstaticwords.SaveKeys')); ?>

                        </button>
                    </div>
                </form>

               </div>
           </div>
       </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script>
        if($('.show_button').is(":checked")){
             $('input[name=btn_text]').attr('required','required');
                $('#buttonBox').show('fast');
        } else{
             $('input[name=btn_text]').removeAttr('required');
                $('#buttonBox').hide('fast');
        }
       
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pushnotifications/index.blade.php ENDPATH**/ ?>