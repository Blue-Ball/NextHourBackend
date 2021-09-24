@extends('layouts.admin')
@section('title',__('adminstaticwords.AllLiveEvents'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('liveevent.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateLiveEvent')}}</a>
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
              {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search LiveEvent')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($liveevent) && count($liveevent) > 0)
          @foreach($liveevent as $item)
            <div class="col-lg-3">
              <div class=" card">
                @if($item->thumbnail != NULL)
                <img src="{{url('/images/events/thumbnails/' . $item->thumbnail)}}" class="card-img-top" alt="...">
                @elseif($item->poster != NULL)
                <img src="{{url('/images/events/thumbnails/' . $item->poster)}}" class="card-img-top" alt="...">
                @else
                <img src="{{Avatar::create($item->title)->toBase64()}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->title}}</h5>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Start Time')}}</h6>
                    <p>{{isset($item->start_time) && $item->start_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->start_time)) : '-' }}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('End Time')}}</h6>
                    <p>{{isset($item->end_time) && $item->end_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->end_time)) : '-' }}</p>
                  </div>
                 
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Organized By')}}</h6>
                    <p>{{isset($item->organized_by) && $item->organized_by ? $item->organized_by : '-' }}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Description')}}</h6>
                    <p>{{isset($item->description) && $item->description ? str_limit($item->description,50) : '-' }}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('LiveEvent Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="{{url('event/detail', $item->slug)}}" data-toggle="tooltip" data-original-title=" Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                      
                        <li>
                          <a href="{{route('liveevent.edit', $item->id)}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                        <li>
                          <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> </a>
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
                                    <form method="POST" action="{{route("liveevent.destroy", $item->id)}}">
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
            </div>
          @endforeach
          <div class="col-md-12 pagination-block">
            {!! $liveevent->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a liveevent ! All of your liveevents will be displayed on this page.')}}</small>
          </div>
        @endif
    </div>
  
  </div>
@endsection
