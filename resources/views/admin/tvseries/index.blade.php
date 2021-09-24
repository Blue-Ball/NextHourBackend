@extends('layouts.admin')
@section('title',__('adminstaticwords.AllTvSeries'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('tvseries.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateTvSeries')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>   
      @if (Session::has('changed_language'))
        <a href="{{ route('tmdb_tv_translate') }}" class="btn btn-danger btn-md"><i class="material-icons left">translate</i> {{__('adminstaticwords.TranslateAllTo')}} {{Session::get('changed_language')}}</a>   
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
              {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Tvseries')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($tv_serieses) && count($tv_serieses) > 0)
          @foreach($tv_serieses as $item)
            <div class="col-lg-3">
              <div class="card-two card">
                @if($item->thumbnail != NULL)
                <img src="{{url('/images/tvseries/thumbnails/' . $item->thumbnail)}}" class="card-img-top" alt="...">
                @elseif($item->poster != NULL)
                <img src="{{url('/images/tvseries/thumbnails/' . $item->poster)}}" class="card-img-top" alt="...">
                @else
                <img src="{{Avatar::create($item->title)->toBase64()}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->title}}</h5>
                </div>
                <div class="card-body">
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
                   <div class="card-block card-block-ratings">
                    <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                    
                      @if($item->status == 1)
                            <a href="{{route('quick.tv.status', $item->id) }}" class='btn btn-sm btn-success'>{{__('adminstaticwords.Active')}}</a>
                        @else
                            <a href="{{route('quick.tv.status', $item->id) }}" class='btn btn-sm btn-danger'>{{__('adminstaticwords.Deactive')}}</a>
                       @endif
                    
                      
                  </div>
                  
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Tvseries Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        @php 
                          $ifseason = App\Season::where('tv_series_id', '=', $item->id)->first(); 
                        @endphp
                        <li>
                          @if (isset($ifseason) && $item->status == 1)
                          <a href="{{ url('show/detail', $ifseason->season_slug)}}" target="__blank" data-toggle="tooltip" data-original-title="Page Preview" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                          @else
                           <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Create a season first or tvseries is not active yet" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                          @endif
                        </li>
                        
                        <li>
                          <a href="{{route('tvseries.edit', $item->id)}}"  data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                        <li>
                          <a href="{{route('tvseries.show', $item->id)}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.ManageSeasons')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
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
                                  <form method="POST" action="{{route("tvseries.destroy", $item->id)}}">
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
            {!! $tv_serieses->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a tvseries! All of your tvseries will be displayed on this page.')}}</small>
          </div>
        @endif
      
    </div>
  </div>
@endsection
@section('custom-script')
<script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>

  <script>
    $(function () {
      
      var table = $('#tvTable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('tvseries.index') }}",
          columns: [
              
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
              {data: 'thumbnail', name: 'thumbnail'},
              {data: 'title', name: 'title'},
              {data: 'rating', name: 'rating',searchable: false},
              {data: 'tmdb', name: 'tmdb',searchable: false},
              {data: 'featured', name: 'featured',searchable: false},
              {data: 'status', name: 'status',searchable: false},
              {data: 'addedby', name: 'addedby',searchable: false},
              {data: 'action', name: 'action',searchable: false}
             
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'desc']]
      });
      
    });
  </script>
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>
@endsection