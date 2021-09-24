@extends('layouts.admin')
@section('title',__('adminstaticwords.SystemStatus'))
@section('content')
<div class="content-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text">{{__('adminstaticwords.SystemStatus')}}</h4>
  </div>
 <div class="content-block box-body table-responsive">

    @php

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

    @endphp

   

        
        <div id="message"></div>

        <table class="table table-striped">
          

            <tbody>
                <tr>
                    <td>
                        <b>{{__('adminstaticwords.LaravelVersion')}}</b>
                    </td>
                    <td>
                        {{ App::version() }} <i class="fa fa-check-circle text-green"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table class="table table-bordered table-striped">
            <thead>
                
                <th colspan="2">
                    {{__('adminstaticwords.MYSQLVersionInfo')}}
                </th>
                <th>
                    {{__('adminstaticwords.Status')}}
                </th>
                
            </thead>
            

            <tbody>
               @foreach($db_info as $key => $info)
                    <tr>
                        <td>
                            {{ $key == 0 ? __('adminstaticwords.MYSQLVersion') : __('adminstaticwords.ServerType') }}
                        </td>
                        <td>
                            {{ $info['value'] }}
                        </td>
                        <td>
                            @if($key == 0 && $info['value'] < 5.7)
                                @php
                                    array_push($servercheck, 0);
                                @endphp
                                <i class="fa fa-times-circle text-red"></i>
                            @else
                                @php
                                    array_push($servercheck, 1);
                                @endphp
                            <i class="fa fa-check-circle text-green"></i>
                            @endif
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{{ __('adminstaticwords.PHPExtensions') }}</th>
                <th>{{ __('adminstaticwords.Status') }}</th>
              </tr>
            </thead>

            <tbody>

              <tr>
                @php
                    $v = phpversion();
                @endphp
                <td>
                  {{ __('php version') }} (<b>{{ $v }}</b>)
                  <br>
                  <small class="text-muted">{{__('adminstaticwords.PHPVersionNote')}}</small>
                </td>
                <td>

                 @if($v = 7.0 && $v < 7.5) <i class="text-green fa fa-check-circle"></i>
                        @php
                            array_push($servercheck, 1);
                        @endphp
                    @else
                        @php
                            array_push($servercheck, 1);
                        @endphp
                    <i class="text-red fa fa-times-circle"></i>
                    <br>
                    <small>
                      {{__('adminstaticwords.Yourphpversionis')}} <b>{{ $v }}</b>{{__('adminstaticwords.Whichisnotsupported')}}
                    </small>
                   
                    @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.pdo') }}</td>
                <td>

                  @if (extension_loaded('pdo'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.BCMath') }}</td>
                <td>

                  @if (extension_loaded('BCMath'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.openssl') }}</td>
                <td>

                  @if (extension_loaded('openssl'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.fileinfo') }}</td>
                <td>

                  @if (extension_loaded('fileinfo'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.json') }}</td>
                <td>

                  @if (extension_loaded('json'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.session') }}</td>
                <td>
                    

                  @if (extension_loaded('session'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.gd') }}</td>
                <td>

                  @if (extension_loaded('gd'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>



              <tr>
                <td>{{ __('adminstaticwords.allow_url_fopen') }}</td>
                <td>

                  @if (ini_get('allow_url_fopen'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>





              <tr>
                <td>{{ __('adminstaticwords.xml') }}</td>
                <td>

                  @if (extension_loaded('xml'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.tokenizer') }}</td>
                <td>

                  @if (extension_loaded('tokenizer'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>
              <tr>
                <td>{{ __('adminstaicwords.standard') }}</td>
                <td>

                  @if (extension_loaded('standard'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstticwords.mysqli') }}</td>
                <td>

                  @if (extension_loaded('mysqli'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.mbstring') }}</td>
                <td>

                  @if (extension_loaded('mbstring'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.ctype') }}</td>
                <td>

                  @if (extension_loaded('ctype'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('adminstaticwords.exif') }}</td>
                <td>

                  @if (extension_loaded('exif'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                  <i class="text-green fa fa-check-circle"></i>
                
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                  <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{storage_path()}}</b> {{ __('iswritable') }}?</td>
                <td>
                  @php
                    $path = storage_path();
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp
                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{base_path('bootstrap/cache')}}</b> {{ __('iswritable') }}?</td>
                <td>
                  @php
                    $path = base_path('bootstrap/cache');
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{storage_path('framework/sessions')}}</b> {{ __('iswritable') }}?</td>
                <td>
                  @php
                    $path = storage_path('framework/sessions');
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>


            </tbody>
          </table>

            

       
  </div>
</div>
@endsection
@section('custom-script')
    <script>
        @if(!in_array(0, $servercheck))
            $("#message").html('<div class="callout callout-success"><i class="fa fa-check-circle"></i> {{ __("adminstaticwords.SuccessMessage") }}</div>');
        @else
            $('#message').html(' <div class="callout callout-danger"><i class="fa fa-times-circle"></i> {{ __("adminstaticwords.ErrorMessage") }}</div>');
        @endif
    </script>
@endsection