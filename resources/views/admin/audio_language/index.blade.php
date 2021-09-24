@extends('layouts.admin')
@section('title',__('adminstaticwords.AllAudioLanguages'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('audio_language.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i>{{__('adminstaticwords.CreateAudioLanguage')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>   
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">{{__('adminstaticwords.AreYouSure')}}</h4>
              <p>{{__('adminstaticwords.DeleteWarrning')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body genre-card">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Genre')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if($audio_languages != NULL && count($audio_languages) > 0)
          @foreach($audio_languages as $item)
            <div class="col-lg-2">
              <div class="card">
                @if($item->image != NULL)
                <img src="{{url("images/audiolanguage/" . $item->image)}}" class="card-img-top" alt="...">
                @else
                  <img src="{{ Avatar::create($item->language)->toBase64()}}" class="card-img-top" alt="...">
                @endif
                 <div class="overlay-bg"></div>
                <div class="card-body">
                  <h5 class="card-title">{{$item->language}}</h5>
                  <div class="card-icons">
                    <ul>
                      <li>
                        <a href="{{route('audio_language.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      </li>
                      <li>
                       <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id }}"><i class="material-icons">delete</i> </button>
                       <div id="deleteModal{{$item->id }}" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading">{{__('adminstaticwords.AreYouSure')}}</h4>
                              <p>{{__('adminstaticwords.DeleteWarrning')}}</p>
                            </div>
                            <div class="modal-footer">
                              <form method="POST" action="{{route("audio_language.destroy", $item->id)}}">
                                @method("DELETE")
                                @csrf
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          @endforeach
          <div class="col-md-12 pagination-block">
           {!! $audio_languages->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a genre! All of your genres will be displayed on this page.')}}</small>
          </div>
        @endif
     
      </div>
    </div>
  
  </div>
@endsection
