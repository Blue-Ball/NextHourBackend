@extends('layouts.admin')
@section('title',__('adminstaticwords.AllDirectors'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('directors.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateDirector')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>   
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
              {!! Form::open(['method' => 'POST', 'action' => 'DirectorController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Directors')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($directors) && $directors->count() > 0)
          @foreach($directors as $item)
            <div class="col-lg-3">
              <div class="card-two card">
                @if($item->image != NULL)
                <img src="{{url('/images/directors/' . $item->image)}}" class="card-img-top" alt="...">
                @else
                <img src="{{Avatar::create($item->name)->toBase64()}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->name}}</h5>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('DOB')}}</h6>
                    <p>{{isset($item->DOB) && $item->DOB != NULL ? $item->DOB : '-' }}</p>
                  </div>
                 
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Place Of Birth')}}</h6>
                    <p>{{isset($item->place_of_birth) && $item->place_of_birth != NULL ? str_limit($item->place_of_birth,30) : '-'}}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('BioGraphy')}}</h6>
                    <p>{{isset($item->biography) && $item->biography != NULL ? str_limit($item->biography,50) : '-'}}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Director Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="{{url('video/detail/director_search', $item->name)}}" target="__blank" data-toggle="tooltip" data-original-title="Page Preview" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                        <li>
                        <li>
                          <a href="{{route('directors.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                        <li>
                          <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> </a>
                          <div id="deleteModal{{$item->id}}" class="delete-modal modal fade" role="dialog">
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
                                  <form method="POST" action="{{route("directors.destroy", $item->id)}}">
                                    @method('DELETE')
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
            </div>
          @endforeach
          <div class="col-md-12 pagination-block text-center">
           {!! $directors->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a director ! All of your directors will be displayed on this page.')}}</small>
          </div>
        @endif
      </div>
   
  </div>
@endsection
