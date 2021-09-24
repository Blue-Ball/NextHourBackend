@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateAudioLanguage'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/audio_language')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a>{{__('adminstaticwords.CreateAudioLanguage')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store','files'=> true]) !!}
            <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
              {!! Form::label('language', __('adminstaticwords.Language')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterAudioAndSubtitleLanguage')}} eg:English"></i>
              {!! Form::text('language', old('language'), ['class' => 'form-control', 'required' => 'required', 'placeholder' =>__('adminstaticwords.PleaseEnterAudioAndSubtitleLanguage')]) !!}
              <small class="text-danger">{{ $errors->first('language') }}</small>
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image', __('adminstaticwords.AudioLanguageImage')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.UploadAudioLanguageImage')}}"></i>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Audio Language Image')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
              </label>
              <p class="info">{{__('adminstaticwords.ChooseCustomImage')}}</p>
              <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('status',__('adminstaticwords.Status')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <input type="checkbox" name="status" class="checkbox-switch" id="status" {{old('status')}}>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>

            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
