
<?php $__env->startSection('title',__('adminstaticwords.CreateMenu')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/menu')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreateMenu')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'MenuController@store']); ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMenuName')); ?> eg:Home"></i>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterMenuName')]); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>

            <div class="form-group" class="form-group<?php echo e($errors->has('section') ? ' has-error' : ''); ?>">
              <label><?php echo e(__('adminstaticwords.ChooseSection')); ?>: <span class="text-danger">*</span></label>
              <br>
              <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.MenuWillContainFollowingSection')); ?></small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.AtleaseOneSectionIsRequired')); ?></small>

              <br><br>

              <label>
                <div class="inline">
                  <input value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.RecentlyAdded')); ?> 
              </label>
              <br>

              <div style="display: none" class="section1">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section1">
                 
                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Genre')); ?> 
              </label>
              <div style="display: none" class="section2">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="All Genre">Select Genre</label> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select these genre you want to show on home page"></i><br/>
                    <select name="genre_id[]" id="" class="form-control select2" multiple="">
                       <?php if($all_genre): ?>
                        <?php $__currentLoopData = $all_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($genre->id); ?>"><?php echo e($genre->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section2">
                 
                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
    
              <br>
              <label>
                <div class="inline">
                  <input value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Featured')); ?>

              </label>
           
                <div style="display: none" class="section3">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[3]" id="select3" class="form-control">
                     <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section3">
                 
                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              
              <br>
              <label>
                <div class="inline">
                  <input value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.BestOnIntrest')); ?>

              </label>
           
                <div style="display: none" class="section4">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section4">
                 
                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[4]" id="select4" class="form-control">
                     <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>

              <br/>

              <label>
                <div class="inline">
                  <input value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.ContinueWatch')); ?>

              </label>
           
                <div style="display: none" class="section5">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[5]" id="select5" class="form-control">
                     <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section5">
                 
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              
              <br/>


               <label>
                <div class="inline">
                  <input value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
               <?php echo e(__('adminstaticwords.Languages')); ?>

              </label>
           
                <div style="display: none" class="section6">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[6]" id="select6" class="form-control">
                     <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section6">
                 
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              
              <br/>
                <label>
                <div class="inline">
                  <input value="7" id="pramotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="pramotion" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.MovieTvseriesPramotion')); ?>

              </label>
              <br/>
              <label>
                <div class="inline">
                  <input value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Blog')); ?>

              </label>


              <br/>
               <label>
                <div class="inline">
                  <input value="9" id="upcoming" type="checkbox" class="filled-in" name="section[9]">
                  <label for="upcoming" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.UpcomingMovie')); ?>

              </label>
           
                <div style="display: none" class="section9">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit9" type="number" min="1" name="limit[9]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[9]" id="select9" class="form-control">
                     <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section9">
                 
                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[9]" id="select9" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              
              <br>

              <label>
                <div class="inline">
                  <input value="10" id="liveevent" type="checkbox" class="filled-in" name="section[10]">
                  <label for="liveevent" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.LiveEvent')); ?>

              </label>
              <br/>
              <label>
                <div class="inline">
                  <input value="11" id="audio" type="checkbox" class="filled-in" name="section[11]">
                  <label for="audio" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Audio')); ?>

              </label>
                <small class="text-danger"><?php echo e($errors->first('section')); ?></small>
              <br/>
              <?php if($topsection == 1): ?>
               <label>
                  <div class="inline">
                    <input value="12" id="topReated" type="checkbox" class="filled-in" name="section[12]">
                    <label for="toprated" class="material-checkbox"></label>
                  </div>
                  <?php echo e(__('TopRated Section')); ?>

                </label>
                <br/>
              <?php endif; ?>
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
  <script>
    
      $('#recent_added').on('change',function(){
           
          if($(this).is(':checked')){
              $('.section1').show('fast');
              $('#limit1').attr('required','required');
              $('#order1').attr('required','required');
              $('#select1').attr('required','required');
          }else{
            $('.section1').hide('fast');
            $('#limit1').removeAttr('required');
             $('#order1').removeAttr('required','required');
            $('#select1').removeAttr('required');
          }
      });

      $('#genre_added').on('change',function(){
          if($(this).is(':checked')){
            $('.section2').show('fast');
            $('#limit2').attr('required','required');
             $('#order2').attr('required','required');
            $('#select2').attr('required','required');
          }else{
            $('.section2').hide('fast');
            $('#limit2').removeAttr('required');
             $('#order2').removeAttr('required','required');
            $('#select2').removeAttr('required');
          }
      });

      $('#featured').on('change',function(){
          if($(this).is(':checked')){
            $('.section3').show('fast');
            $('#limit3').attr('required','required');
             $('#order3').attr('required','required');
            $('#select3').attr('required','required');
          }else{
            $('.section3').hide('fast');
            $('#limit3').removeAttr('required');
             $('#order3').removeAttr('required','required');
            $('#select3').removeAttr('required');
          }
      });

      $('#intrest').on('change',function(){
          if($(this).is(':checked')){
            $('.section4').show('fast');
            $('#limit4').attr('required','required');
             $('#order4').attr('required','required');
            $('#select4').attr('required','required');
          }else{
            $('.section4').hide('fast');
            $('#limit4').removeAttr('required');
             $('#order4').removeAttr('required','required');
            $('#select4').removeAttr('required');
          }
      });

      $('#history').on('change',function(){
          if($(this).is(':checked')){
            $('.section5').show('fast');
            $('#limit5').attr('required','required');
             $('#order5').attr('required','required');
            $('#select5').attr('required','required');
          }else{
            $('.section5').hide('fast');
            $('#limit5').removeAttr('required');
             $('#order5').removeAttr('required','required');
            $('#select5').removeAttr('required');
          }
      });

      $('#language').on('change',function(){
          if($(this).is(':checked')){
            $('.section6').show('fast');
            $('#limit6').attr('required','required');
             $('#order6').attr('required','required');
            $('#select6').attr('required','required');
          }else{
            $('.section6').hide('fast');
            $('#limit6').removeAttr('required');
             $('#order6').removeAttr('required','required');
            $('#select6').removeAttr('required');
          }
      });

   
   
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/menu/create.blade.php ENDPATH**/ ?>