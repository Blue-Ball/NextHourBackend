@extends('layouts.admin')
@section('title',__('adminstaticwords.AllMovies'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('movies.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateMovie')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>   
      @if (Session::has('changed_language'))
        <a href="{{ route('tmdb_movie_translate') }}" class="btn btn-danger btn-md"><i class="material-icons left">translate</i> {{__('adminstaticwords.TranslateAllTo')}} {{Session::get('changed_language')}}</a>   
      @endif
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
              {!! Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Movies')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($movies) && count($movies) > 0)
          @foreach($movies as $item)
            <div class="col-lg-3">
              <div class="card">
                @if($item->thumbnail != NULL)
                <img src="{{url('/images/movies/thumbnails/' . $item->thumbnail)}}" class="card-img-top" alt="...">
                @elseif($item->poster != NULL)
                <img src="{{url('/images/movies/posters/' . $item->poster)}}" class="card-img-top" alt="...">
                @else
                <img src="{{ Avatar::create($item->title)->toBase64()}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->title}}</h5>
                </div>
                <div class="card-body">
                  
                  <div class="card-block row">
                    <div class="col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Year')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Length')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>
                    
                  </div>
                  <div class="card-block card-block-ratings">
                    <h6 class="card-body-sub-heading">{{__('Ratings')}}</h6>
                    @php
                    $rating = ($item->rating)/2;
                    @endphp
                    <table>
                      <tr>
                        <td>
                          <input class="rating" id="input-{{$item->id}}" name="input-3" value="{{$rating}}" class="rating-loading" disabled>
                        </td>
                      </tr>
                    </table>
                    <p>{{$item->rating}}/10</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Genre')}}</h6>
                    @php
                     $genres = collect();
                      if (isset($item->genre_id)){
                        $genre_list = explode(',', $item->genre_id);
                        for ($i = 0; $i < count($genre_list); $i++) {
                          try {
                            $genre = App\Genre::find($genre_list[$i])->name;
                            $genres->push($genre);
                          } catch (Exception $e) {

                          }
                        }
                      }
                    @endphp
                    <p>
                      @if (count($genres) > 0)
                        @for($i = 0; $i < count($genres); $i++)
                          @if($i == count($genres)-1)
                            {{$genres[$i]}}
                          @else
                            {{$genres[$i]}},
                          @endif
                         @endfor
                      @endif
                    </p>
                  </div>
                 
                  
                
                  <div class="card-block row">
                    <div class="col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Created By')}}</h6>
                      @php 
                        $username = App\User::find($item->created_by);
                      @endphp
                      <p>{{isset($username) && $username != NULL ? $username->name :'user deleted'}}</p>
                    </div>
                    <div class="col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                    <p class="status-btn">
                      @if($item->status == 1)
                            <a href="{{route('quick.movie.status', $item->id) }}" class='btn btn-sm btn-success'>{{__('adminstaticwords.Active')}}</a>
                        @else
                            <a href="{{route('quick.movie.status', $item->id) }}" class='btn btn-sm btn-danger'>{{__('adminstaticwords.Deactive')}}</a>
                       @endif
                     </p>
                    </div>
                    
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Movie Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="{{url('movie/detail', $item->slug)}}" target="__blank" data-toggle="tooltip" data-original-title="Page Preview" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                        <li>
                          <a href="{{route('movies.link', $item->id)}}" data-toggle="tooltip" data-original-title="{{__('Add more links')}}" class="btn-success btn-floating"><i class="material-icons">link</i></a>
                        </li>
                        <li>
                          <a href="{{route('movies.edit', $item->id)}}"  data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
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
                                  <form method="POST" action="{{route("movies.destroy", $item->id)}}">
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
            {!! $movies->appends(request()->query())->links() !!}
          </div>
         @else
         <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a movie! All of your movies will be displayed on this page.')}}</small>
          </div>
        @endif
    </div>
  </div>
@endsection
@section('custom-script')
 <script>
    $(document).ready(function(){
        $('.rating').rating({displayOnly: false, step: 0.5});
    });
</script>
@endsection