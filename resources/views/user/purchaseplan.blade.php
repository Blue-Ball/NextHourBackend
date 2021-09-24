@extends('layouts.theme')
@section('title','Purchase Plan')
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading">{{__('staticwords.pricingplan')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('staticwords.dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('staticwords.pricingplan')}}</li>
      </ul>
      <div class="purchase-plan-main-block main-home-section-plans purchase-section">
        <div class="panel-setting-main-block panel-purchase">
          <div class="container">
            <div class="plan-block-dtl">
              <h3 class="plan-dtl-heading">{{__('staticwords.purchasemembership')}}</h3>
              <h4 class="plan-dtl-sub-heading">{{__('staticwords.membershipline')}}</h4>
              <div class="plan-dtl-list">
                <ul>
                  <li>{{__('staticwords.membershiplines1')}}
                  </li>
                  <li>{{__('staticwords.membershiplines2')}}
                  </li>
                </ul>
              </div>
            </div>
            
            <div class="snip1404 row">
              @foreach($plans as $plan)
              @if($plan->delete_status ==1 )
                @if($plan->status != 'inactive')
                  <div class="col-lg-3">
                    <div class="main-plan-section">
                      <header>
                        <h4 class="plan-home-title">
                          {{$plan->name}}
                        </h4>
                        <div class="plan-cost"><span class="plan-price"><i class="{{$plan->currency_symbol}}"></i>{{$plan->amount}}</span><span class="plan-type">
                            <i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}
                            @if($plan->interval == 'year')
                              Yearly
                            @elseif($plan->interval == 'month')
                              Monthly
                            @elseif($plan->interval == 'week')
                              Weekly
                            @elseif($plan->interval == 'day')
                              Daily
                            @endif
                        </span></div>
                      </header>
                        
                      @php
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                      @endphp
                      @if(isset($package_feature))
                        @foreach($package_feature as $pf)
                           <ul class="plan-features">
                            @isset($plan['feature'])
                             <li>@if(in_array($pf->id, $plan['feature']))<i class="fa fa-check "> </i>@else <i class="fa fa-close "> </i> @endif {{ $pf->name }}</li> @endisset
                           </ul>
                        @endforeach
                      @endif
                  
                      @auth
                        @if($plan->free == 1 && $plan->status == 'upcoming')
                            <div class="plan-select"><a href="#" class="btn btn-prime">{{__('COMING SOON!')}}</a></div>
                        @elseif($plan->free == 1 && $plan->status == 'active')
                         <form action="{{route('free.package.subscription',$plan->id)}}" method="POST">
                          @csrf
                            <div class="plan-select btn-prime-subs"><a class="btn btn-prime"><input type="submit" class="btn-subscribe" value="{{__('staticwords.subscribe')}}"></a></div>
                          </form>
                        @elseif($plan->status == 'upcoming')
                         <div class="plan-select"><a href="#" class="btn btn-prime">{{__('COMING SOON!')}}</a></div>
                        @else
                          <div class="plan-select"><a href="{{route('get_payment', $plan->id)}}" class="btn btn-prime">{{__('staticwords.subscribe')}}</a></div>
                        @endif
                        
                      @else
                        <div class="plan-select"><a href="{{route('register')}}">{{__('staticwords.registernow')}}</a></div>
                      @endauth
                    </div>
                  </div>
                @endif
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection