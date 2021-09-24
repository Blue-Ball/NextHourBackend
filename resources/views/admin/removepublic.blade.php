@extends('layouts.admin')
@section('title',__('adminstaticwords.RemovePublic'))
@section('content')
<div class="admin-form-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text">{{__('adminstaticwords.RemovePublic')}}</h4>
  </div>
   <div class="row">
      <div class="col-lg-10 col-xs-6">
      	<div class="admin-form-block z-depth-1">
      		<div class="callout callout-danger">
	    		<i class="fa fa-info-circle"></i>
	    		 {{__('adminstaticwords.ImportantNotes')}}
	    		 <ol type="1">
	    		 	<li>- {{__('adminstaticwords.RemovePublicNote1')}}</li>
	    		 	<li>- {{__('adminstaticwords.RemovePublicNote2')}}</li>
	    		 </ol>
	    	</div>
      		<form method="POST" action="{{route('remove.public')}}">
      			@csrf
      			<button type="submit" class="btn btn-success">{{__('adminstaticwords.RemovePublic')}}</button>
      			
      		</form>
      	</div>

      </div>
  </div>
</div>
@endsection