
<?php $__env->startSection('title',__('adminstaticwords.CreateLiveTv')); ?>
<style type="text/css">
  body{
    background-color: #efefef;
  }
  .container-4 input#hyv-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
  .container-4 input#vimeo-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
  .container-4 button.icon {
    height: 30px;
    background: #f0f0f0 url('images/searchicon.png') 10px 1px no-repeat;
    background-size: 24px;
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid #c6c6c6;
    width: 50px;
    margin-left: -44px;
    color: #4f5b66;
    font-size: 10pt;
  }

</style>
<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block">
  <h4 class="admin-form-text"><a href="<?php echo e(url('admin/livetv')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreateLiveTv')); ?></h4>
  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">


        <?php echo Form::open(['method' => 'POST', 'action' => 'LiveTvController@store', 'files' => true]); ?>

        

        <div id="movie_title" class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
          <?php echo Form::label('title',__('adminstaticwords.LiveTvTitle')); ?>

          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterLivetvTitle')); ?> Eg:Avatar"></i>
          <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => __('adminstaticwords.EnterLivetvTitle')]); ?>

          <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
        </div>
        <div id="movie_slug" class="form-group<?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
          <?php echo Form::label('slug', __('adminstaticwords.LiveTvSlug')); ?>

          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterLivetvSlug')); ?> Eg:avatar-example"></i>
          <?php echo Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'Please enter livetv slug']); ?>

          <small class="text-danger"><?php echo e($errors->first('slug')); ?></small>
        </div>
        <input type="text" name="live" value="1" hidden="true">
       
        
        <div class="form-group<?php echo e($errors->has('selecturl') ? ' has-error' : ''); ?>">
          <?php echo Form::label('selecturls',__('adminstaticwords.AddVideo')); ?>

          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddVideo')); ?>"></i>
          <?php echo Form::select('selecturl', array('iframeurl' => __('adminstaticwords.IFrameURL'),
       
           
           'customurl' => __('adminstaticwords.CustomURLYoutubeURLVimeoURL')), null, ['class' => 'form-control select2','id'=>'selecturl']); ?>

           <small class="text-danger"><?php echo e($errors->first('selecturl')); ?></small>
         </div>


         <div id="ifbox" style="display: none;" class="form-group">
          <label for="iframeurl"><?php echo e(__('adminstaticwords.IFrameURL')); ?>: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="iframeurl" placeholder="">
        </div>


        <div class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel"><?php echo e(__('adminstaticwords.EmbdedURLExamples')); ?>: </h6>
              </div>
              <div class="modal-body">
                <p style="font-size: 15px;"><b><?php echo e(__('adminstaticwords.Youtube')); ?>:</b> <?php echo e(__('adminstaticwords.YoutubeUrlLink')); ?> </p>

                <p style="font-size: 15px;"><b><?php echo e(__('adminstaticwords.GoogleDrive')); ?>:</b> <?php echo e(__('adminstaticwords.GoogleDriveLink')); ?> </p>

                <p style="font-size: 15px;"><b><?php echo e(__('adminstaticwords.Openload')); ?>:</b> <?php echo e(__('adminstaticwords.OpenloadLink')); ?> </p>

                <p style="font-size: 15px;"><b><?php echo e(__('adminstaticwords.Note')); ?>:</b> <?php echo e(__('adminstaticwords.DoNotInclude')); ?> &lt;iframe&gt; <?php echo e(__('adminstaticwords.TagBeforeURL')); ?></p>
              </div>

            </div>
          </div>
        </div>

     

        
        <div id="ready_url" style="display: none;" class="form-group<?php echo e($errors->has('ready_url') ? ' has-error' : ''); ?>">
         <label id="ready_url_text"></label>
         <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterYourVideoUrl')); ?></p>
         <?php echo Form::text('ready_url', null, ['class' => 'form-control','id'=>'apiUrl']); ?>

         <small class="text-danger"><?php echo e($errors->first('ready_url')); ?></small>
       </div>


     <div class="form-group<?php echo e($errors->has('a_language') ? ' has-error' : ''); ?>">
      <?php echo Form::label('a_language', __('adminstaticwords.AudioLanguages')); ?>

      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectAudioLanguage')); ?>"></i>
      <div class="input-group">
        <?php echo Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']); ?>

        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
      </div>
      <small class="text-danger"><?php echo e($errors->first('a_language')); ?></small>
    </div>
    <div class="form-group<?php echo e($errors->has('maturity_rating') ? ' has-error' : ''); ?>">
      <?php echo Form::label('maturity_rating',__('adminstaticwords.MaturityRating')); ?>

      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectMaturityRating')); ?>"></i>
      <?php echo Form::select('maturity_rating', array('all age' => __('adminstaticwords.AllAge'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']); ?>

      <small class="text-danger"><?php echo e($errors->first('maturity_rating')); ?></small>
    </div>
    <div class="form-group" style="display: none">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')); ?>

        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch for-custom-image">
            <?php echo Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']); ?>

            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>
    <div class="upload-image-main-block">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group<?php echo e($errors->has('thumbnail') ? ' has-error' : ''); ?> input-file-block">
            <?php echo Form::label('thumbnail', __('adminstaticwords.Thumbnail')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
            <?php echo Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']); ?>

            <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Thumbnail')); ?>">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
            </label>
            <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomThumbnail')); ?></p>
            <small class="text-danger"><?php echo e($errors->first('thumbnail')); ?></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group<?php echo e($errors->has('poster') ? ' has-error' : ''); ?> input-file-block">
            <?php echo Form::label('poster',__('adminstaticwords.Poster')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
            <?php echo Form::file('poster', ['class' => 'input-file', 'id'=>'poster']); ?>

            <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Poster')); ?>">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
            </label>
            <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomPoster')); ?></p>
            <small class="text-danger"><?php echo e($errors->first('poster')); ?></small>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group<?php echo e($errors->has('featured') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('featured', __('adminstaticwords.Featured')); ?>

        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <?php echo Form::checkbox('featured', 1, 0, ['class' => 'checkbox-switch']); ?>

            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger"><?php echo e($errors->first('featured')); ?></small>
      </div>
    </div>

    <div class="form-group<?php echo e($errors->has('is_protect') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')); ?>

        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger"><?php echo e($errors->first('is_protect')); ?></small>
      </div>
    </div>
    <div class="search form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> is_protect" style="display: none;">
      <?php echo Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')); ?>

      <?php echo Form::password('password', old('password'), ['class' => 'form-control','id'=>'password']); ?>

      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
      <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
    </div>

<div class="form-group">
  <label for=""><?php echo e(__('adminstaticwords.MetaKeyword')); ?>: </label>
  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterMetaKeyword')); ?>"></i>
  <input name="keyword" value="<?php echo e(old('keyword')); ?>" type="text" class="form-control" data-role="tagsinput"/>
</div>

<div class="form-group">
  <label for=""><?php echo e(__('adminstaticwords.MetaDescription')); ?>: </label>
  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterMetaDescription')); ?>"></i>
  <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo e(old('description')); ?></textarea>
</div>

<div class="menu-block">
  <h6 class="menu-block-heading"><?php echo e(__('adminstaticwords.PleaseSelectMenu')); ?></h6>
  <?php if(isset($menus) && count($menus) > 0): ?>
  <ul>
    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
      <div class="inline">
        <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
        <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
      </div>
      <?php echo e($menu->name); ?>

    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
  <?php endif; ?>
</div>


  <input type="text" name="director_id" value="0" hidden="true">
  <input type="text" name="actor_id" value="0" hidden="true">
  <input type="text" name="duration" value="0" hidden="true">
<div class="form-group<?php echo e($errors->has('rating') ? ' has-error' : ''); ?>">
    <?php echo Form::label('rating', __('adminstaticwords.Ratings')); ?>

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterRatings')); ?> eg:8"></i>
    <?php echo Form::text('rating',  old('rating'), ['class' => 'form-control', ]); ?>

    <small class="text-danger"><?php echo e($errors->first('rating')); ?></small>
  </div>
  <div class="form-group<?php echo e($errors->has('genre_id') ? ' has-error' : ''); ?>">
    <?php echo Form::label('genre_id', __('adminstaticwords.Genre')); ?>

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectGenres')); ?>"></i>
    <div class="input-group">
      <?php echo Form::select('genre_id[]', $genre_ls, null, ['class' => 'form-control select2', 'multiple']); ?>

      <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>
    </div>
    <small class="text-danger"><?php echo e($errors->first('genre_id')); ?></small>
  </div>

  <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
    <?php echo Form::label('detail', __('adminstaticwords.Description')); ?>

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterLiveTvDescription')); ?>"></i>
    <?php echo Form::textarea('detail', old('detail'), ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

    <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
  </div>
  
  <div class="form-group<?php echo e($errors->has('livetvicon') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-xs-6">
        <?php echo Form::label('livetvicon', __('adminstaticwords.LiveTvIconShow')); ?>

      </div>
      <div class="col-xs-5 pad-0">
        <label class="switch">
          <?php echo Form::checkbox('livetvicon', 1, 0, ['class' => 'checkbox-switch']); ?>

          <span class="slider round"></span>
        </label>
      </div>
    </div>
    <div class="col-xs-12">
      <small class="text-danger"><?php echo e($errors->first('livetvicon')); ?></small>
    </div>
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
</div>
<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><?php echo e(__('adminstaticwords.AddLanguage')); ?></h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']); ?>

      <div class="modal-body">
        <div class="form-group<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
          <?php echo Form::label('language',__('adminstaticwords.Language')); ?>

          <?php echo Form::text('language', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><?php echo e(__('adminstaticwords.Reset')); ?></button>
          <button type="submit" class="btn btn-success"><?php echo e(__('adminstaticwords.Create')); ?></button>
        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>


<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><?php echo e(__('adminstaticwords.AddGenre')); ?></h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'GenreController@store']); ?>

      <div class="modal-body admin-form-block">
        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Create')); ?></button>
        </div>
      </div>
      <div class="clear-both"></div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

<script>
 $(document).ready(function() {
  var SITEURL = '<?php echo e(URL::to('')); ?>';


  $.ajax({
    type: "GET",
    url: SITEURL + "/admin/movie/upload_video/converting",
    success: function (data) {
     console.log('Success:',data);
   },
   error: function (data) {
    console.log('Error:', data);
  }
});


});
</script>
<script>
  $(document).ready(function(){
   $('#ifbox').show();
   $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
      if (selecturl == 'iframeurl') {
    $('#ifbox').show();
    $('#uploadvideo').hide();
    $('#audio_url').hide();
    $('#ready_url').hide();
    $('#subtitle_section').hide();

  }else if (selecturl == 'uploadvideo') {
   $('#uploadvideo').show();
   $('#ready_url').hide();
  
   $('#ifbox').hide();
   $('#subtitle_section').show();

 }else if(selecturl=='customurl'){
   $('#ifbox').hide();
   $('#uploadvideo').hide();
   $('#ready_url').show();
  
   $('#subtitle_section').show();
   $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');
 }
 else if (selecturl == 'youtubeapi') {
   $('#uploadvideo').hide();
   $('#ready_url').show();

   $('#ifbox').hide();
   $('#subtitle_section').hide();
  
   $('#ready_url_text').text('Import From Youtube API');

 }else if(selecturl=='vimeoapi'){
   $('#ifbox').hide();
   $('#uploadvideo').hide();
   $('#ready_url').show();

   $('#subtitle_section').hide();
   $('#ready_url_text').text('Import From Vimeo API');
  
 }



});
   var i= 1;
   $('#add').click(function(){  
     i++;  
     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
   });

   $(document).on('click', '.btn_remove', function(){  
     var button_id = $(this).attr("id");   
     $('#row'+button_id+'').remove();  
   });  


   $('form').on('submit', function(event){
    $('.loading-block').addClass('active');
  });
   $('#custom_url').hide();

   $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

    if (state == true) {

     $('#ready_url').show();
     $('#custom_url').hide();

   } else if (state == false) {

    $('#ready_url').hide();
    $('#custom_url').show();

  };

});



 

  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
});
</script>


<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/livetv/create.blade.php ENDPATH**/ ?>