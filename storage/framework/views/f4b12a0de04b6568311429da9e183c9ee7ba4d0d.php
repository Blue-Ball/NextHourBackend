
<?php $__env->startSection('title', __('Color Option')); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
<?php echo Form::open(['method' => 'POST', 'action' => 'ColorSchemeController@store']); ?>

 
 <div class="row admin-form-block z-depth-1">
    <div class="row">
       <h6 class="form-block-heading apipadding"><?php echo e(__('Color Layouts')); ?></h6>
      <br>
        
      <div class="form-group<?php echo e($errors->has('color_scheme') ? ' has-error' : ''); ?>">
        <div class="col-md-5">
          <h5 class="bootstrap-switch-label"><?php echo e(__('adminstaticwords.ColorSchemes')); ?></h5>
        </div>
        <div class="col-md-7 pad-0">
          <select class="form-control select2" name="color_scheme">
            <option value="dark" <?php echo e($color_scheme->color_scheme == 'dark'? 'selected' : ''); ?> ><?php echo e(__('adminstaticwords.Dark')); ?></option>
            <option value="light" <?php echo e($color_scheme->color_scheme == 'light'? 'selected' : ''); ?>><?php echo e(__('Light')); ?></option>
          
         </select>
        </div>
        <small class="text-danger"><?php echo e($errors->first('color_scheme')); ?></small>
      </div>
    </div>
    <br/>
    <div class="row">
      <h6 class="form-block-heading apipadding"><?php echo e(__('Navigation Section')); ?></h6>
      <br>
      <div class="form-group<?php echo e($errors->has('navigation_color') ? ' has-error' : ''); ?>">
        <div class="col-md-12 table-responsive">
         <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                   <div class="input-group my-colorpicker2">
                      <input type="text" class="form-control" value="<?php echo e($color_scheme->custom_navigation_color); ?>" name="default_navigation_color" disabled>

                      <div class="input-group-addon">
                        <i></i>
                      </div>
                    </div>
              
                </td>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" value="<?php echo e($color_scheme->custom_navigation_color); ?>" name="custom_navigation_color">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>

                </td>

              </tr>
            </tbody>
          </table>  
        </div>
        
      </div>
    </div>
    <br/>
  
    <div class="row">
      <h6 class="form-block-heading apipadding"><?php echo e(__('Text Color')); ?></h6>
      <br>
      <div class="form-group<?php echo e($errors->has('button_color') ? ' has-error' : ''); ?>">
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Text Color')); ?></label>
         <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_text_color" value="<?php echo e($color_scheme->default_text_color); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_text_color" value="<?php echo e($color_scheme->custom_text_color); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                
              </tr>
            </tbody>
          </table>  
        </div>
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Text on Hover Color')); ?></label>
         <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_text_on_color" value="<?php echo e($color_scheme->default_text_on_color); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_text_on_color" value="<?php echo e($color_scheme->custom_text_on_color); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
              </tr>
            </tbody>
          </table>  
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <h6 class="form-block-heading apipadding"><?php echo e(__('BackTo Top Section')); ?></h6>
      <br>
      <div class="form-group<?php echo e($errors->has('button_color') ? ' has-error' : ''); ?>">
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Back2Top Background color')); ?></label>
          <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_back_to_top_bgcolor" value="<?php echo e($color_scheme->default_back_to_top_color); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_back_to_top_bgcolor" value="<?php echo e($color_scheme->custom_back_to_top_color); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                  
              </tr>
            </tbody>
          </table>  
        </div>
         <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Back2Top Background color on hover')); ?></label>
          <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_back_to_top_bgcolor_on_hover" value="<?php echo e($color_scheme->default_back_to_top_bgcolor_on_hover); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_back_to_top_bgcolor_on_hover" value="<?php echo e($color_scheme->custom_back_to_top_bgcolor_on_hover); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                  
              </tr>
            </tbody>
          </table>  
        </div>
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Back2Top color')); ?></label>
          <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_back_to_top_color" value="<?php echo e($color_scheme->default_back_to_top_color); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_back_to_top_color" value="<?php echo e($color_scheme->custom_back_to_top_color); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
              </tr>
            </tbody>
          </table>  
        </div>
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Back2Top color on hover')); ?></label>
          <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_back_to_top_color_on_hover" value="<?php echo e($color_scheme->default_back_to_top_color_on_hover); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_back_to_top_color_on_hover" value="<?php echo e($color_scheme->custom_back_to_top_color_on_hover); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                  
              </tr>
            </tbody>
          </table>  
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <h6 class="form-block-heading apipadding"><?php echo e(__('Footer Section')); ?></h6>
      <br>
      <div class="form-group<?php echo e($errors->has('button_color') ? ' has-error' : ''); ?>">
        <div class="col-md-12 table-responsive">
          <label for=""><?php echo e(__('Footer Background color')); ?></label>
         <table class="table table-hover">
            <thead>
              <tr class="table-heading-row">
                <th><?php echo e(__('Default Color')); ?></th>
                <th><?php echo e(__('Custom Color')); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="default_footer_background_color" value="<?php echo e($color_scheme->default_footer_background_color); ?>" disabled>

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
                <td>
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="custom_footer_background_color" value="<?php echo e($color_scheme->custom_footer_background_color); ?>">

                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                 
              </tr>
            </tbody>
          </table>  
        </div>
      </div>
    </div>
    <div class="btn-group col-xs-4">
      <button type="reset" class="btn btn-block btn-primary"><?php echo e(__('Reset')); ?></button>
    </div>
    <div class="btn-group col-xs-4">
      <input type="submit" name="reset" class="btn btn-block btn-info" value="<?php echo e(__('Reset to Default')); ?>">
    </div>
    <div class="btn-group col-xs-4">
      <input type="submit" name="save" class="btn btn-block btn-success" value="<?php echo e(__('adminstaticwords.SaveSettings')); ?>">
    </div>
    
    <div class="clear-both"></div>
     
  </div>
  
  <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  $(function() {
    $('.colorpicker').colorpicker();
  })
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/color_scheme/index.blade.php ENDPATH**/ ?>