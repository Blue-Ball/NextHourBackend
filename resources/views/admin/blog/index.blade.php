@extends('layouts.admin')
@section('title',__('adminstaticwords.AllBlogs'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('blog.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreatePost')}}</a>
      <!-- Delete Modal -->
     {{--  <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>    --}}
     
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
              {!! Form::open(['method' => 'POST', 'action' => 'BlogController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Blog')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($blogs) && $blogs->count() > 0)
        @foreach($blogs as $item)
          <div class="col-lg-3">
            <div class="card-two card">
              @if($item->image != NULL)
              <img src="{{url('/images/blog/' . $item->image)}}" class="card-img-top" alt="...">
              @else
              <img src="{{Avatar::create($item->title)->toBase64()}}" class="card-img-top" alt="...">
              @endif
              <div class="overlay-bg"></div>
              <div class="card-body card-header">
                <h5 class="card-title">{{$item->title}}</h5>
              </div>
              <div class="card-body">
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Description')}}</h6>
                  <p>{!! isset($item->detail) && $item->detail != NULL ? str_limit($item->detail,100) : '-' !!}</p>
                </div>
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                  @if($item->is_active == 1)
                    <p>{{__('Active')}}</p>
                  @else
                    <p>{{__('DeActive')}}</p>
                  @endif
                </div>
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Blog Emotions')}}</h6>
                  <div class="card-icons">
                    <ul>
                      <li>
                          <a href="{{url('account/blog/', $item->slug)}}" data-toggle="tooltip" data-original-title=" Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                      </li>
                      <li>
                        <a href="{{route('blog.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
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
                                <form method="POST" action="{{route("blog.destroy", $item->id)}}">
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
           {!! $blogs->appends(request()->query())->links() !!}
        </div>
      @else
        <div class="col-md-12 text-center">
          <h5>{{__("Let's start :)")}}</h5>
          <small>{{__('Get Started by creating a actor! All of your actors will be displayed on this page.')}}<a href=""></a></small>
        </div>
      @endif
      </div>
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
      
      var table = $('#blogTable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('blog.index') }}",
          columns: [
              
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
             
                {data: 'image', name: 'image'},
              {data: 'title', name: 'title'},
              {data: 'detail', name: 'detail'},
               {data: 'status', name: 'status'},
              {data: 'created_at', name: 'created_at',searchable: false},
          
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
  
@endsection