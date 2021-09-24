@extends('layouts.admin')
@section('title', __('adminstaticwords.PushNotification'))

@section('content')
<div class="admin-form-main-block">
   <div class="row ">
       <div class="col-md-7 ">
       
            <div class="content-block box-body admin-form-block z-depth-1">
                <form action="{{ route('admin.push.notif') }}" method="POST">
                    @csrf
    
                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.SelectUserGroup')}}: <span class="text-danger">*</span> </label>
    
                        <select required data-placeholder="{{__('adminstaticwords.PleaseSelectUserGroup')}}" name="user_group" id="" class="select2 form-control">
                            <option value="">{{__('adminstaticwords.PleaseSelectUserGroup')}}</option>
                            <option {{ old('user_group') == 'all_customers' ? "selected" : "" }} value="all_customers">{{__('adminstaticwords.AllUsers')}}</option>
                            <option {{ old('user_group') == 'all_sellers' ? "selected" : "" }} value="all_sellers">{{__('adminstaticwords.AllProducers')}}</option>
                            <option {{ old('user_group') == 'all_admins' ? "selected" : "" }} value="all_admins">{{__('adminstaticwords.AllAdmins')}}</option>
                            <option {{ old('user_group') == 'all' ? "selected" : "" }} value="all">{{__('adminstaticwords.All')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.Subject')}}: <span class="text-red">*</span></label>
                        <input placeholder="{{__('adminstaticwords.HeyNewStockArrived')}}" type="text" class="form-control" required name="subject" value="{{ old('subject') }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.NotificationBody')}}: <span class="text-red">*</span> </label>
                        <textarea required placeholder="{{__('adminstaticwords.NotificationBodyNote')}}" class="form-control" name="message" id="" cols="3" rows="5">{{ old('message') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.TargetURL')}}: </label>
                        <input value="{{ old('target_url') }}" class="form-control" name="target_url" type="url" placeholder="{{ url('/') }}">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> {{__('adminstaticwords.TargetURLNote')}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.NotificationIcon')}}: </label>
                        <input value="{{ old('icon') }}" name="icon" class="form-control" type="url" placeholder="https://someurl/icon.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> {{__('adminstaticwords.NotificationIconNote')}}.
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('adminstaticwords.Image')}}: </label>
                        <input value="{{ old('image') }}" class="form-control" name="image" type="url" placeholder="https://someurl/image.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> <b>{{__('adminstaticwords.NotificationImageSize')}}.</b>
                        </small>
                    </div>

                    <div class="from-group">
                        <label for="">{{__('adminstaticwords.ShowButton')}}: </label>
                        <br>
                        <label class="make-switch">
                            <input  class="bootswitch show_button" type="checkbox" name="show_button" data-on-text="On" data-off-text="{{__('adminstaticwords.OFF')}}" data-size="{{__('adminstaticwords.small')}}">
                        </label>
                    </div>

                    <div style="display: {{ old('show_button') ? 'block' : 'none' }};" id="buttonBox">
                        <div class="form-group">
                            <label for="">{{__('adminstaticwords.ButtonText')}}:  <span class="text-danger">*</span></label>
                            <input value="{{ old('btn_text') }}" class="form-control" name="btn_text" type="text" placeholder="{{__('adminstaticwords.GrabNow')}}">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('adminstaticwords.ButtonTargetURL')}}: </label>
                            <input value="{{ old('btn_url') }}" class="form-control" name="btn_url" type="url" placeholder="https://someurl/image.png">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> {{__('adminstaticwords.ButtonTargetURLNote')}}.
                            </small>
                        </div>
                    </div>

                    <div class="from-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">
                            <i class="fa fa-location-arrow"></i> {{__('adminstaticwords.Send')}}
                        </button>
                    </div>
    
                </form>
            </div>
       </div>

       <div class="col-md-4">
           <div class="box">
               <div class="box-header">
                   <div class="box-title">
                        {{__('adminstaticwords.OnesignalKeys')}}
                   </div>

                   <a title="Get one signal keys" href="https://onesignal.com/" class="pull-right" target="__blank">
                       <i class="fa fa-key"></i> {{__('adminstaticwords.GetYourKeysFromHere')}}
                   </a>
               </div>

               <div class="content-block box-body  admin-form-block z-depth-1">
                   
                <form action="{{ route('admin.onesignal.keys') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_APP_ID"> {{__('adminstaticwords.ONESIGNALAPPID')}}: <span class="text-danger">*</span></label>
                            <input type="password" value="{{ env('ONESIGNAL_APP_ID') }}"
                                name="ONESIGNAL_APP_ID" placeholder="{{__('adminstaticwords.EnterONESIGNALAPPID')}} " id="ONESIGNAL_APP_ID" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_APP_ID"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_REST_API_KEY"> {{__('adminstaticwords.ONESIGNALRESTAPIKEY')}}: <span class="text-danger">*</span></label>
                            <input type="password" value="{{ env('ONESIGNAL_REST_API_KEY') }}"
                                name="ONESIGNAL_REST_API_KEY" placeholder="{{__('adminstaticwords.EnterONESIGNALRESTAPIKEY')}} " id="ONESIGNAL_REST_API_KEY" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_REST_API_KEY"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md">
                           <i class="fa fa-save"></i> {{__('adminstaticwords.SaveKeys')}}
                        </button>
                    </div>
                </form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection
@section('custom-script')
    <script>
        if($('.show_button').is(":checked")){
             $('input[name=btn_text]').attr('required','required');
                $('#buttonBox').show('fast');
        } else{
             $('input[name=btn_text]').removeAttr('required');
                $('#buttonBox').hide('fast');
        }
       
    </script>
@endsection