@extends('layouts.admin')
@section('title',__('adminstaticwords.AllGenres'))
@section('content')

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('genres.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateGenre')}}</a>
      {{-- <a href="{{url('admin/update-to-english')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Update Genre to english</a> --}}
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
              {!! Form::open(['method' => 'POST', 'action' => 'GenreController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
   
      <div class="row text-center">
        @if(isset($genres) && $genres->count() > 0)
          @foreach($genres as $genre)
          <div class="col-lg-2">
            <div class="card">
              @if($genre->image != NULL)
              <img src="{{url("images/genre/" . $genre->image)}}" class="card-img-top" alt="...">
              @else
                <img src="{{ Avatar::create($genre->name)->toBase64()}}" class="card-img-top" alt="...">
              @endif
               <div class="overlay-bg"></div>
              <div class="card-body">
                <h5 class="card-title">{{$genre->name}}</h5>
                <div class="card-icons">
                  <ul>
                    <li>
                      <a href="{{route('genres.edit', $genre->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    </li>
                    <li>
                     <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$genre->id }}"><i class="material-icons">delete</i> </a>
                       <div id="deleteModal{{$genre->id }}" class="delete-modal modal fade" role="dialog">
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
                              <form method="POST" action="{{route("genres.destroy", $genre->id)}}">
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
             {!! $genres->appends(request()->query())->links() !!}
          </div> 
           
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a genre! All of your genres will be displayed on this page.')}} <a href="{{route('genres.create')}}"> {{__('click here')}}</a></small>
          </div>
        @endif
      </div>
     
@endsection
