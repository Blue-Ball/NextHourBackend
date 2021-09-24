@extends('layouts.admin')
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> My Profile</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Email</h5>
          <p class="info">Currnet email: {{Auth::user()->email}}</p>
          {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
            <div class="form-group{{ $errors->has('new_email') ? ' has-error' : '' }}">
              {!! Form::label('new_email', 'New Email') !!}
              {!! Form::text('new_email', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('new_email') }}</small>
            </div>
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
              {!! Form::label('current_password', 'Current Password') !!}
              {!! Form::password('current_password', ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('current_password') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Password</h5>
          <p class="info">Do you want to change password ?</p>
          {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
              {!! Form::label('current_password', 'Current Password') !!}
              {!! Form::password('current_password', ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('current_password') }}</small>
            </div>
            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
              {!! Form::label('new_password', 'New Password') !!}
              {!! Form::password('new_password', ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('new_password') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Name</h5>
           <p class="info">Currnet Name: {{ucfirst(Auth::user()->name)}}</p>
          {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
            <div class="form-group{{ $errors->has('current_name') ? ' has-error' : '' }}">
              {!! Form::label('current_name', 'Current Name') !!}
              {!! Form::text('current_name',Auth::user()->name, ['class' => 'form-control','readonly']) !!}
              <small class="text-danger">{{ $errors->first('current_name') }}</small>
            </div>
            <div class="form-group{{ $errors->has('new_name') ? ' has-error' : '' }}">
              {!! Form::label('new_name', 'New Name') !!}
              {!! Form::text('new_name',null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('new_name') }}</small>
            </div>
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
              {!! Form::label('current_password', 'Current Password') !!}
              {!! Form::password('current_password', ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('current_password') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Profile Image</h5>
           {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile','files' => true]) !!}
          <div class="row">
           
            <div class="col-xs-6">
              <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                {!! Form::label('image', __('adminstaticwords.ProfileImage')) !!}
                {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.ProfileImage')}}">
                  <i class="icon fa fa-check"></i>
                  <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
                </label>
                <p class="info">{{__('adminstaticwords.ChooseAImage')}}</p>
                <small class="text-danger">{{ $errors->first('image') }}</small>
              </div>
            </div>
            @if(Auth::user()->image != NULL)
              <div class="col-xs-6">
                <img src="{{asset('images/users/' . Auth::user()->image)}}" class="img-responsive img-thumbnail" width="130" height="100" alt="">
              </div>
            @endif
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
           
          </div>
           {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
