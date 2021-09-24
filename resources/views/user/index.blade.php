@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="user-img">
            @if(isset($auth->image) && $auth->image != NULL)
              <img src="{{url('images/users'.$auth->image)}}">
            @else
              <img src="{{url('images/default.jpg')}}">
            @endif
          </div>
        </div>
        <div class="col-lg-8">
          <div id="exTab1" class="container"> 
            <ul  class="nav nav-pills">
              <li class="active">
                <a  href="#details" data-toggle="tab">{{__('staticwords.Details')}}</a>
              </li>
              <li><a href="#membership" data-toggle="tab">{{__('staticwords.Membership')}}</a>
              </li>
              <li><a href="#history" data-toggle="tab">{{__('staticwords.PaymentHistory')}}</a>
              </li>
            </ul>
            <div class="tab-content clearfix">
              <div class="tab-pane active" id="details">
                <div class="edit-profile-main-block">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">Change Email</h4>
                        <div class="info">{{__('staticwords.currentemail')}}: {{auth()->user()->email}}</div>
                        <form method="POST" action="{{route('user.profile')}}" accept-charset="UTF-8">
                          @csrf
                          
                          <div class="form-group {{ $errors->has('new_email') ? ' has-error' : '' }}">
                            <label for="new_email">{{__('staticwords.newemail')}}</label>
                            <input class="form-control" name="new_email" type="email" id="new_email">
                            <small class="text-danger">{{ $errors->first('new_email') }}</small>
                          </div>
                          <div class="form-group">
                            <label for="current_password">{{__('staticwords.currentpassword')}}</label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('staticwords.update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('staticwords.changepassword')}}</h4>
                        <div class="info">{{__('staticwords.wanttochangeyourpassword')}}</div>
                        <form method="POST" action="{{url('account/profile')}}" accept-charset="UTF-8">
                          @csrf
                          <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password">{{__('staticwords.currentpassword')}}</label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                          </div>
                          <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password">{{ __('staticwords.newpassword')}}</label>
                            <input class="form-control" name="new_password" type="password" value="" id="new_password">
                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('staticwords.update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('staticwords.updateageandmobile')}}</h4>
                        <div class="info">{{__('staticwords.wanttochangeageandmobile')}}</div>
                        <form method="POST" action="{{route('user.age')}}" accept-charset="UTF-8">
                          @csrf
                          <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob">{{__('staticwords.dateofbirth')}}</label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('staticwords.enterdateofbirthuser')}}"></i>
                            <input type="date" class="form-control" name="dob" @if(isset(Auth::user()->dob)) value="{{Auth::user()->dob}}" @endif >   
                            <small class="text-danger">{{ $errors->first('dob') }}</small>
                          </div>
                          <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile">{{ __('staticwords.mobileno')}}</label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('staticwords.enteryourmobileno')}}"></i>
                            <input type="number" class="form-control" name="mobile" @if(isset(Auth::user()->mobile)) value="{{Auth::user()->mobile}}"@endif>   
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('staticwords.update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="membership">
                <div class="membership-block">
                  <div class="row">
                    <div class="col-lg-4">
                        <h4>{{__('staticwords.yourmembership')}}</h4>
                        <div class="info">{{__('staticwords.wanttochangemembership')}}</div>
                    </div>
                    <div class="col-lg-5">
                      @php
                        $bfree = null;
                         $config=App\Config::first();
                         $auth=Auth::user();
                          if ($auth->is_admin==1) {
                            $bfree=1;
                          }else{
                             $ps=App\PaypalSubscription::where('user_id',$auth->id)->first();
                             if (isset($ps)) {
                               $current_date = Illuminate\Support\Carbon::now();
                                if (date($current_date) <= date($ps->subscription_to)) {
                                  
                                  if ($ps->package_id==100 || $ps->package_id == 0) {
                                      $bfree=1;
                                  }else{
                                    $bfree=0;
                                  }
                                }
                             }
                          }
                         
                      @endphp
                      @if($auth->is_admin==1)
                        <div class="membership-sub">Current Subscription: FREE</div>
                      @else
                        @if($bfree==1)

                          <div class="membership-sub">{{__('staticwords.currentsubscritptionfreetill')}}
                            <strong>{{date('F j, Y  g:i:a',strtotime($ps->subscription_to))}} </strong></div>

                        @elseif($bfree==0)
                        
                         @if(isset($ps) && $current_subscription->subscription_to < $ps->subscription_to)
                            @php
                               $psn=App\Package::where('id',$ps->package_id)->first();
                            @endphp

                            <div class="membership-sub">{{__('staticwords.currentsubscription')}}: {{$psn != NULL ? ucfirst($psn['name']) : '-'}}</div>
                          @else
                             @if($current_subscription != null)

                                <div class="membership-sub">{{__('staticwords.currentsubscription')}}: {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</div>
                            @endif
                          @endif
                          
                       @else

                          @if($current_subscription != null)

                             <div class="membership-sub">{{__('staticwords.currentsubscription')}}: {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</div>
                          @endif
                        @endif
                      @endif
                    </div>
                    <div class="col-lg-3">
                        @if($current_subscription != null && $method == 'stripe') 
                          @if(getPlan() == 0)
                            <a href="{{route('resumeSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                          @else
                            <a href="{{route('cancelSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a>
                          @endif
                        @elseif($current_subscription != null && $method == 'paypal') 
                          @if($current_subscription->status == 0)
                            <a href="{{route('resumeSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                          @elseif ($current_subscription->status == 1)
                            <a href="{{route('cancelSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a>
                          @endif
                        @else 
                          @if($auth->is_admin == 1)
                          @else              
                          <a href="{{url('account/purchaseplan')}}" class="btn btn-setting">{{__('staticwords.subscribenow')}}</a>
                          @endif
                        @endif
                      {{-- <div class="btn-group">
                        <input class="btn btn-success" type="submit" value="Cancel Subscription">
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="history">
                <div class="panel-setting-main-block billing-history-main-block">
                  @if(isset($invoices) && $invoices != null)
                    <div class="container">
                      <h4 class="plan-dtl-heading">{{__('staticwords.stripebillinghistory')}}</h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{__('staticwords.date')}}</th>
                              <th>{{__('staticwords.package')}}</th>
                              <th>{{__('staticwords.serviceperiod')}}</th>
                              <th>{{__('staticwords.paymentmethod')}}</th>
                              <th>{{__('staticwords.total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                           {{-- @dd($invoices); --}}
                            @foreach($invoices as $invoice)
                        {{--     @dd($invoice->created); --}}
                              @php
                                $from = Carbon\Carbon::parse($invoice->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($invoice->subscription_to);
                                $to = $to->toDateString();
                                 $created = Carbon\Carbon::parse($invoice->subscription_from);
                                $created = $created->toDateString();

                                $plan = App\Package::where('plan_id',$invoice->stripe_plan)->first();
                              @endphp
                              <tr>
                                <td>{{$created}}</td>
                                <td>{{$plan->name}}</td>
                                <td>{{$from}} to {{$to}}</td>
                                <td>Stripe</td>
                                <td><i class="{{$currency_symbol}}"></i> {{$invoice->amount}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                  @if (isset($paypal_subscriptions) && $paypal_subscriptions != null && count($paypal_subscriptions) > 0)
                    <div class="container">
                      <h4 class="plan-dtl-heading">{{__('staticwords.billinghistory')}}</h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{__('staticwords.date')}}</th>
                              <th>{{__('staticwords.package')}}</th>
                              <th>{{__('staticwords.serviceperiod')}}</th>
                              <th>{{__('staticwords.paymentmethod')}}</th>
                              <th>{{__('staticwords.total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($paypal_subscriptions as $item)
                              @php
                                $from = Carbon\Carbon::parse($item->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($item->subscription_to);
                                $to = $to->toDateString();
                              @endphp
                              <tr>
                                <td>{{$item->created_at->toDateString()}}</td>
                                <td>{{$item->plan ? $item->plan->name : 'N/A'}}</td>
                                <td>{{$from}} to {{$to}}</td>
                                <td>{{ucfirst($item->method)}}</td>
                                <td><i class="{{$currency_symbol}}"></i> {{$item->price}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection