<html>
<head>
<title>
    {{__("Payment in process please do not refresh page")}}
</title>
<link rel="stylesheet" href="{{ url("css/bootstrap.min.css") }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@notify_css
</head>
<body>
	<br>
	<br>
	<center><h1>{{ __("Your transaction is being processed!!!") }}</h1></center>
	<center><h4>{{ __("Please do not refresh this page...") }}</h4></center>
    <center><h4>{{ __("Checkout ID :") }} {{ $checkoutid }} </h4></center>
    <center><h6>{{ __("Getting payment status for ") }} {{ $checkoutid }} </h6></center>

    <div class="mt-2 mb-2">
       <h5 class="payment_status text-primary text-center">
            {{__("Awaiting payment status....")}}
       </h5>
    </div>
    
    <div class="container">
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 99%"></div>
        </div>
    </div>
    <br>
    <center><h6 class="text-secondary">{{ __("Page will automatically expires within 1 min if no response received.") }}</h6></center>
    <br>
    <div class="text-center">
        <a href="{{ url('account/purchaseplan') }}" role="button" class="btn btn-md btn-danger text-center">
            {{__("Cancel Payment")}}
        </a>
    </div>
   <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    @notify_js
    @notify_render
<script>
   
        setTimeout(() => {
                toastr.error('Payment failed !', 'Timeout No Response !');
                location.href = '{{  url('account/purchaseplan') }}';
        }, 80000);

        var myVar;
        myVar = setInterval(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
                
                type : 'POST',
                dataType : 'json',
                url  : '{{ route('verify.mpesa',$checkoutid) }}',
                success : function(data){
                    
                    if(data.resultCode == 0){
                        console.log(data);
                        clearInterval(myVar);
                        $('.payment_status').html(data.msg);
                        //setTimeout(function(){  location.href = '{{ url("/home") }}'+data.order_id; }, 2500);
    
                    }else{
                        console.log(data);
                        clearInterval(myVar);
                        $('.payment_status').html(data.msg).removeClass('text-primary').addClass('text-danger');
                        //setTimeout(function(){  location.href = '{{ url("account/purchaseplan") }}'; }, 2500);
                       
                        
                    }
                        
                }
                
            });  
            
        }, 3000);

       
   
</script>
</body>

</html>