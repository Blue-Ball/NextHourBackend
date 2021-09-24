
<?php $__env->startSection('title',__('adminstaticwords.CreatePackage')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">  
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/packages')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreatePackage')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'PackageController@store']); ?>

            <div class="form-group<?php echo e($errors->has('plan_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('plan_id', __('adminstaticwords.PlanID')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.UniquePackage')); ?></p>
                <?php echo Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => __('adminstaticwords.UniquePackage').' ex. basic10', 'data-placement' => 'bottom']); ?>

                <small class="text-danger"><?php echo e($errors->first('plan_id')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.PackageName')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterYourPlanName')); ?></p>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
            <?php echo Form::hidden('currency', $currency_code); ?>


            <div class="form-group<?php echo e($errors->has('free') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('free', __('adminstaticwords.Free')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('free', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'free']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
               
                <small class="text-danger"><?php echo e($errors->first('free')); ?></small>
            </div>
    
            <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>" id="planAmount">
                <?php echo Form::label('amount', __('adminstaticwords.YourPlanAmount')); ?>

                <p class="inline info"> -<?php echo e(__('adminstaticwords.PlanAmountMinMax')); ?></p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="<?php echo e($currency_symbol); ?>"></i></span>
                  <?php echo Form::number('amount', null, ['class' => 'form-control']); ?>  
                </div>
                <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo e($currency_symbol); ?>" hidden="true">
                <small class="text-danger"><?php echo e($errors->first('amount')); ?></small>
            </div>

           <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group<?php echo e($errors->has('interval_count') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('interval_count', __('adminstaticwords.YourPlanDuration')); ?>

                        <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterPlanDuration')); ?> </p>
                        <?php echo Form::number('interval_count', null, ['min' => 1, 'class' => 'form-control', 'required' => 'required']); ?>

                        <small class="text-danger"><?php echo e($errors->first('interval_count')); ?></small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group<?php echo e($errors->has('interval') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('interval', __('adminstaticwords.PlanDurationUnit')); ?>

                        <p class="inline info"> - <?php echo e(__('adminstaticwords.PlanDurationUnitDescription')); ?></p>
                        <?php echo Form::select('interval', ['day'=>'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'year' => 'yearly'], ['month' => 'Monthly'], ['class' => 'form-control select2', 'required' => 'required']); ?>

                        <small class="text-danger"><?php echo e($errors->first('interval')); ?></small>
                     </div>
                </div> 
             </div>   
          </div>
           <div class="form-group<?php echo e($errors->has('feature') ? ' has-error' : ''); ?>">
                <?php echo Form::label('feature',__('adminstaticwords.PackageFeature')); ?> <span class="text-danger">*</span>
                <p class="inline info"> - <?php echo e(__('adminstaticwords.PackageFeatureNotes')); ?></p>
                <select class="select2 form-control" name="feature[]" multiple>
                  <?php $__currentLoopData = $p_feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pf->id); ?>"><?php echo e($pf->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <small class="text-danger"><?php echo e($errors->first('feature')); ?></small>
            </div>
          <div class="menu-block">
              <h6 class="menu-block-heading"><?php echo e(__('adminstaticwords.PleaseSelectMenu')); ?></h6>
              <?php if(isset($menus) && count($menus) > 0): ?>
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox<?php echo e(100); ?>" >
                        <label for="checkbox<?php echo e(100); ?>" class="material-checkbox"></label>
                      </div>
                      <?php echo e(__('adminstaticwords.AllMenus')); ?>

                    </li>
                  <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
                        <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
                      </div>
                      <?php echo e($menu->name); ?>

                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php endif; ?>
            </div>
            <div class="form-group<?php echo e($errors->has('trial_period_days') ? ' has-error' : ''); ?>">
                <?php echo Form::label('trial_period_days', __('adminstaticwords.YourPlanTrailPeriodDays')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.YourPlanTrailPeriodDaysDescription')); ?></p>
                <?php echo Form::number('trial_period_days', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('trial_period_days')); ?></small>
            </div>
            
            <div class="form-group<?php echo e($errors->has('screen') ? ' has-error' : ''); ?>">
                <?php echo Form::label('screen', __('adminstaticwords.Screens')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.ScreensDescription')); ?></p>
                <?php echo Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4']); ?>

                <small class="text-danger"><?php echo e($errors->first('screen')); ?></small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group<?php echo e($errors->has('download') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('download', __('adminstaticwords.DoYouWantDownloadLimit')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('download', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('download')); ?></small>
              </div>
            </div>
            <small class="text-danger"><?php echo e($errors->first('downloadlimit')); ?></small>
            <div id="downloadlimit" class="form-group<?php echo e($errors->has('downloadlimit') ? ' has-error' : ''); ?>" style="display:none">
                <?php echo Form::label('downloadlimit', __('adminstaticwords.DownloadLimit')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.DoYouWantDownloadLimitDescription')); ?></p>
                <?php echo Form::number('downloadlimit', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e(__('adminstaticwords.Note')); ?> :- <br/>
                  1. <?php echo e(__('adminstaticwords.DownloadNote')); ?>.<br/>
                  2. <?php echo e(__('adminstaticwords.DownloadlimitNote')); ?>

                </small>
                
            </div>

            <!--------------- end download limit ------------------->
             <?php
                $webconfig = App\Button::first();
            ?>
            <?php if($webconfig->remove_ads == 1): ?>
              <div class="form-group<?php echo e($errors->has('ads_in_web') ? ' has-error' : ''); ?>">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('ads_in_web', __('Do you want show Ads in Web')); ?>

                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      <?php echo Form::checkbox('ads_in_web', 1, 0, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger"><?php echo e($errors->first('ads_in_web')); ?></small>
                </div>
              </div>
            <?php endif; ?>
             <?php
                $appconfig = App\AppConfig::first();
            ?>
            <?php if($appconfig->remove_ads == 1): ?>
              <div class="form-group<?php echo e($errors->has('ads_in_app') ? ' has-error' : ''); ?>">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('ads_in_app', __('Do you want show Ads in App')); ?>

                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      <?php echo Form::checkbox('ads_in_app', 1, 0, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger"><?php echo e($errors->first('ads_in_app')); ?></small>
                </div>
              </div>
            <?php endif; ?>

            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('status', __('adminstaticwords.Status')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('status', 1, 0, ['class' => 'checkbox-switch seriescheck']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
               
                <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                <?php echo Form::label('status',__('adminstaticwords.Status')); ?> <span class="text-danger">*</span>
                <p class="inline info"> - <?php echo e(__('Please select status')); ?></p>
                <select class="select2 form-control" name="status">
                  <option value="active"><?php echo e(__('Active')); ?></option>
                  <option value="upcoming"><?php echo e(__('Upcoming')); ?></option>
                  <option value="inactive"><?php echo e(__('InActive')); ?></option>
                </select>
                
                <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Create')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>  
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script type="text/javascript">
    // when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })

</script>
<script>
$('#download_enable').on('change',function(){
  if($('#download_enable').is(':checked')){
    //show
    $('#downloadlimit').show();
  }else{
    //hide
     $('#downloadlimit').hide();
  }
});


$('#free').on('change',function(){
  if($('#free').is(':checked')){
    //show
    $('#planAmount').hide();
  }else{
    //hide
     $('#planAmount').show();
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/package/create.blade.php ENDPATH**/ ?>