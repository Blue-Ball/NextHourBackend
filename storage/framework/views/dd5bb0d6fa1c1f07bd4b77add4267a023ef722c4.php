
<?php $__env->startSection('title',__('staticwords.subscribe')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<section id="main-wrapper" class="main-wrapper user-account-section stripe-content">
  <div class="container-fluid">
    <h3 class="payment-title"><?php echo e(__('staticwords.paymentinformation')); ?></h3><br/>
    <div class="row panel-setting-main-block">
      <div class="col-md-4 col-sm-6 package_information ">
        <div class="panel-default">
          <div class="panel-heading"><?php echo e(__('staticwords.purchasepackageinformation')); ?></div>
          <div class="panel-body">
           
            <table class="table">
              <tr>
                <th><?php echo e(__('staticwords.packagename')); ?></th>
                <td><?php echo e($plan->name); ?></td>
              </tr>
              <tr>
                <th><?php echo e(__('staticwords.amount')); ?></th>
                <td><i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(number_format(($plan->amount) / ($plan->interval_count),2)); ?></td>
              </tr>
              <?php if(Session::has('coupon_applied')): ?>
              <tr>
                <th><?php echo e(__('Coupon')); ?> - (<b><?php echo e(ucfirst(Session::get('coupon_applied')['code'])); ?></b>)</th>
                <td><i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(Session::get('coupon_applied')['amount']); ?> OFF</td>
              </tr>

              <tr>
                <th><?php echo e(__('Total Amount')); ?></th>
                <td><i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e($plan->amount - Session::get('coupon_applied')['amount']); ?> /  <?php echo e($plan->interval); ?></td>
              </tr>
              <?php endif; ?>
              <?php if(!Session::has('coupon_applied')): ?>
              <tr>
                <th><?php echo e(__('staticwords.duration')); ?></th>
                <td><i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(number_format(($plan->amount) / ($plan->interval_count),2)); ?>/
                            <?php echo e($plan->interval); ?></td>
              </tr>
            <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    
      <div class="col-md-8 col-sm-6">
       &nbsp;
        <div class="col-md-4 col-xs-12"> <!-- required for floating -->
          <!-- Nav tabs -->
          &nbsp;
          <ul class="nav nav-tabs tabs-left sideways">


           
            <?php if($currency_code == "USD"): ?>
              <!-- stripe tab -->
              <?php if(isset($stripe_payment) && $stripe_payment == 1): ?>
                <li class="active"><a href="#stripe" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Stripe</a></li>
              <?php endif; ?>
              <!-- end stripe -->



              <!-- paypal tree -->
              <?php if(isset($paypal_payment) && $paypal_payment == 1): ?>
                <li><a href="#paypal" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Paypal !</a></li>
              <?php endif; ?>
              <!-- paypal end -->

              <!-- braintree tab -->
              <?php if(isset($braintree) && $braintree==1): ?>
                <li><a href="#braintree" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Braintree</a></li>
              <?php endif; ?>
              <!-- end braintree -->

              <!-- coinpayment tab -->
              <?php if(isset($coinpay) && $coinpay==1): ?>
                <li><a href="#coinpay" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> CoinPayment</a></li>
              <?php endif; ?>
              <!-- end coin payment -->
            <?php endif; ?>

           <!-- Mollie tab -->
            <?php if(isset($mollie_payment) && $mollie_payment == 1): ?>
              <li><a href="#mollie" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Mollie</a></li>
            <?php endif; ?>
            <!-- end Mollie -->

            <!-- Cashfree tab -->
            <?php if(isset($cashfree_payment) && $cashfree_payment == 1): ?>
              <li><a href="#cashfree" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Cashfree</a></li>
            <?php endif; ?>
            <!-- end cashfree -->

            <?php if($currency_code == "INR"): ?>
              <!-- payu tab -->
              <?php if(isset($payu_payment) && $payu_payment == 1): ?>
                <li><a href="#payu" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> PayUmoney !</a></li>
              <?php endif; ?>
            
              <!-- end payu tab -->

              <!-- Paytm tab-->
              <?php if(isset($paytm_payment) && $paytm_payment == 1): ?>
                <li><a href="#paytm" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Paytm</a></li>
              <?php endif; ?>
              <!-- end paytm-->

              <!-- Razorpay tab-->
              <?php if(isset($razorpay_payment) && $razorpay_payment == 1): ?>
                <li><a href="#razorpay" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Razorpay</a></li>
              <?php endif; ?>
              <!-- end razorpay-->

              <!-- Instamojo tab-->
              <?php if(isset($instamojo_payment) && $instamojo_payment == 1): ?>
                <li><a href="#instamojo" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Instamojo</a></li>
              <?php endif; ?>
              <!-- end instamojo-->
            <?php endif; ?>

            <?php if($currency_code == "NGN" || $currency_code == "GHS"): ?>
              <!-- Paystack Tab -->
              <?php if(isset($paystack) && $paystack == 1): ?>
                <li><a href="#paystack" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Paystack</a></li>
              <?php endif; ?>
              <!-- flutterrave tab-->
              <?php if(isset($flutterrave_payment) && $flutterrave_payment == 1): ?>
                <li><a href="#flutterrave" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Flutterrave</a></li>
              <?php endif; ?>
              <!-- end flutterrave tab-->

            <?php endif; ?>

            <?php if($currency_code == "THB" || $currency_code == "GBP" || $currency_code == "USD"): ?>
              <!-- omise tab -->
              <?php if(isset($omise_payment) && $omise_payment == 1): ?>
                <li class=""><a href="#omise" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> Omise</a></li>
              <?php endif; ?>
              <!-- end omise -->
            <?php endif; ?>

            <?php if(isset($manualpaymentmethod)): ?> 
              <?php $__currentLoopData = $manualpaymentmethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mpm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="#<?php echo e(str_slug($mpm->payment_name, '-')); ?>" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> <?php echo e($mpm->payment_name); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if(isset($bankdetails) && $bankdetails == 1): ?> 
              <li><a href="#bankdetails" data-toggle="tab"><?php echo e(__('staticwords.CheckoutWith')); ?> <?php echo e(__('staticwords.BankTransfer')); ?></a></li>
            <?php endif; ?>
          </ul>
        </div>
        <br/>

        <div class="col-md-7 col-xs-12">
          <!-- Tab panes -->
          &nbsp;
          <h4 class="heading"><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.Pay')); ?> &nbsp;<i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($plan->amount); ?> <?php echo e(__('staticwords.pay_method')); ?></a></h4>
          <hr/>
<?php
          $session_amount = Session::has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0
?>
          <div class="row">
              <?php if(Session::has('success')): ?>
            
                <div class="alert alert-success">
                  <?php echo e(Session::get('success')); ?>

                </div>

               <?php endif; ?>
                <?php if(Session::has('deleted')): ?>
                
                <div class="alert alert-danger">
                  <?php echo e(Session::get('deleted')); ?>

                </div>

               <?php endif; ?>
            </div>
            
             <form action="<?php echo e(route('coupon.apply')); ?>" method="POST">
              <?php echo csrf_field(); ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-10 col-xs-10">
                   
                      <input id="coupon" class="form-control" type="text" name="coupon_code" placeholder="Enter Your Coupon Code">
                      <input id="plan_id" class="form-control" type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>" >
                      <input id="user_id" class="form-control" type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>" >

                    </div>
                    <div class="col-sm-2 col-xs-2">
                      <input type="submit" class="btn btn-md btn-info applybutton" value="Apply">
                    </div>
                  </div>
                  
                  
                </div>
            </form>
          <div class="tab-content">
           
            <!-- Stript tab -->
            <?php if(isset($stripe_payment) && $stripe_payment == 1): ?>
              <div class="tab-pane active" id="stripe">
                <?php if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL): ?>
                  <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@subscribe', 'id' => 'payment-form']); ?>

                  <?php echo e(csrf_field()); ?>

                  <div class="form-row">
                    
                    <input type="hidden" name="plan" value="<?php echo e($plan->id); ?>">
                    <label for="card-element">
                      Credit or debit card
                    </label>
                    <div id="card-element">
                      <!-- a Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert"></div>
                  </div>
                  <button id="card-button" data-secret="<?php echo e($intent->client_secret); ?>" class="payment-btn stripe"><i class="fa fa-credit-card"></i> Submit Payment</button>
                <?php echo Form::close(); ?>

                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                      Stripe Payment
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <!-- end stripe -->
           

            <!-- paypal tab -->
            <?php if(isset($paypal_payment) && $paypal_payment == 1): ?>
           
              <div class="tab-pane" id="paypal">
                <?php if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL): ?>
                  <?php echo Form::open(['method' => 'POST', 'action' => 'PaypalController@postPaymentWithpaypal']); ?>

                   
                    <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                    <input type="hidden" name="amount" value="<?php echo e($plan->amount - $session_amount); ?>">
                    <button class="payment-btn paypal-btn"><i class="fa fa-credit-card"></i> <?php echo e(__('staticwords.payvia')); ?> Paypal</button>
                  <?php echo Form::close(); ?>

                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                    Paypal Payment
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <!-- end paypal -->

            <!-- Braintree tab -->
            <?php if(isset($braintree) && $braintree==1): ?>
              <div class="tab-pane" id="braintree">
                <?php if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') !=NULL && env('BTREE_PUBLIC_KEY') !=NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL): ?>
                  <div id="paypal-errors" role="alert"></div>
                  <a href="javascript:void(0);" class="payment-btn bt-btn"><i class="fa fa-credit-card"></i> <?php echo e(__('staticwords.payvia')); ?> Card / Paypal</a>
                  <div class="braintree">
                    <form method="POST" id="bt-form" action="<?php echo e(url('payment/braintree')); ?>">
                      <?php echo e(csrf_field()); ?> 
                      <div class="form-group">
                       
                        <label for="amount"><?php echo e(__('staticwords.amount')); ?></label>                       
                        <input type="text" class="form-control"name="amount" readonly="" value="<?php echo e($plan->amount - $session_amount); ?>">  
                      </div>
                      <div class="bt-drop-in-wrapper">
                          <div id="bt-dropin"></div>
                      </div>
                      <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>"/>
                      <input id="nonce" name="payment_method_nonce" type="hidden" />
                      <div id="pay-errors" role="alert"></div>
                      <button class="payment-btn" type="submit"><span><?php echo e(__('staticwords.paynow')); ?></span></button>
                    </form>
                  </div>
                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                    Braintree Payment
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
              </div>
              
            <?php endif; ?>
            <!-- end braintree -->

            <!-- Mollie tab -->
            <?php if(isset($mollie_payment) && $mollie_payment == 1): ?> 
              <div class="tab-pane" id="mollie">
                <?php if(env('MOLLIE_KEY') != NULL): ?>
                <div class="paymollie">
                  <form method="POST" action="<?php echo e(route('payviamoli_subscription')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                   <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="amount" value="<?php echo e($plan->amount - $session_amount); ?>"> 
                    <input type="hidden" name="currency" value="<?php echo e($plan->currency); ?>"> 
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['plan_id' => $plan->id,])); ?>" > 
                    
                    <button class="payment-btn paymollie-btn"><i class="fa fa-credit-card"></i> Pay Via Mollie</button>
                  </form>
                </div>
                <?php endif; ?>
              </div>
            <?php endif; ?> 
            <!-- end Mollie -->

            <!-- cashfree tab -->
            <?php if(isset($cashfree_payment) && $cashfree_payment == 1): ?>
            <div class=" row tab-pane" id="cashfree">
               <?php if(env('CASHFREE_APP_ID') != NULL && env('CASHFREE_SECRET_ID') != NULL && env('CASHFREE_API_END_URL') != NULL): ?>
                  <?php if(isset(Auth::user()->mobile) && Auth::user()->mobile != NULL): ?>
                    <div class="cashfree">
                      <?php echo Form::open(['method' => 'POST', 'action' => 'PayViaCashFreeController@payment']); ?>

                      <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                      <input type="hidden" name="amount" value="<?php echo e($plan->amount - $session_amount); ?>">
                      <input type="hidden" name="currency" value="<?php echo e($plan->currency); ?>">
                      <button class="payment-btn cashfree-btn"><i class="fa fa-credit-card"></i> Pay Via Cashfree</button>
                    <?php echo Form::close(); ?>

                    </div>
                  <?php else: ?>
                    <p class="text-danger">Please filled your mobile no. <a href="<?php echo e(url('/account/profile')); ?>"><?php echo e(__('clickhere')); ?></a></p>
                  <?php endif; ?>
                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                    Cashfree
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
            </div>
            <?php endif; ?> 

            <!-- end cashfree tab -->

            <!-- coinpayment tab -->
            <?php if(isset($coinpay) && $coinpay==1): ?>
              <div class="tab-pane" id="coinpay">
                <?php if(env('COINPAYMENTS_MERCHANT_ID') != NULL && env('COINPAYMENTS_PUBLIC_KEY') != NULL && env('COINPAYMENTS_PRIVATE_KEY') != NULL): ?>
                  <div class="coinpayment">
                    <form method="POST" id="coinpayment-form" action="<?php echo e(url('payment/coinpayment')); ?>">
                      <?php echo e(csrf_field()); ?> 
                      <div class="form-group"> 
                        <label for="amount"><?php echo e(__('staticwords.amount')); ?></label>                       
                        <input type="text" class="form-control"name="amount" readonly="" value="<?php echo e($plan->amount - $session_amount); ?>">
                         <label for="amount"><?php echo e(__('staticwords.currency')); ?></label> 
                        <select style="padding: 0px; " class="form-control" name="currency">
                          <option value="BTC">BTC</option>
                           <option value="LTC">LTC</option>
                            <option value="ETH">ETH</option>
                             <option value="LOKI">LOKI</option>
                              <option value="XZC">XZC</option>
                        </select>
                           <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>"/>
                      </div>
                     
                      <button class="payment-btn" type="submit"><span><?php echo e(__('staticwords.paynow')); ?></span></button>
                    </form>
                  </div> 
                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                    Coin Payment
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <!-- end coinpayment -->

           
            <?php if($currency_code == "INR"): ?>
              <!-- Payu tab -->
              <?php if(isset($payu_payment) && $payu_payment == 1): ?>
                <div class="tab-pane" id="payu">
                  <?php if(env('PAYU_METHOD') != NULL && env('PAYU_DEFAULT') != NULL && env('PAYU_MERCHANT_KEY') != NULL && env('PAYU_MERCHANT_SALT') != NULL): ?>
                    <?php echo Form::open(['method' => 'POST', 'action' => 'PayuController@payment']); ?>

                      <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                      <button class="payment-btn payu-btn"><i class="fa fa-credit-card"></i> <?php echo e(__('staticwords.payvia')); ?> Payu</button>
                    <?php echo Form::close(); ?>

                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                      Payu Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <!-- end payu -->
              <!-- patym tab -->
              <?php if(isset($paytm_payment) && $paytm_payment == 1): ?>
                <div class="tab-pane" id="paytm">
                  <?php if(env('PAYTM_MID') != NULL && env('PAYTM_MERCHANT_KEY') != NULL): ?>
                    <div class="paytm">
                      <?php echo Form::open(['method' => 'POST', 'action' => 'PaytemController@store']); ?>

                        <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                        <button class="payment-btn paytm-btn"><i class="fa fa-credit-card"></i> <?php echo e(__('staticwords.payvia')); ?> Paytm</button>
                      <?php echo Form::close(); ?>

                    </div>
                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                      Paytm Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <!-- end paytm -->

              <!-- razorpay tab -->
              <?php if(isset($razorpay_payment) && $razorpay_payment == 1): ?>
                <div class="tab-pane" id="razorpay">
                  <?php if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL): ?>
                    <form action="<?php echo e(route('paysuccess',$plan->id)); ?>" method="POST">
                      <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="<?php echo e(env('RAZOR_PAY_KEY')); ?>"
                                    data-amount="<?php echo e(($plan->amount - $session_amount)*100); ?>"
                                    data-buttontext="Pay Via Razorpay"
                                    data-name="<?php echo e(config('app.name')); ?>"
                                    data-description="Payment For Order <?php echo e(uniqid()); ?>"
                                    data-image="<?php echo e(url('images/logo/'.$logo)); ?>"
                                    data-prefill.name="<?php echo e(Auth::user()->name); ?>"
                                    data-prefill.email="<?php echo e(Auth::user()->email); ?>"
                              data-theme.color="#111111">
                      </script>
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" custom="Hidden Element" name="hidden">
                    </form>
                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                        Razorpay Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <!-- end razorpay -->

              <!-- instamojo tab -->
              <?php if(isset($instamojo_payment) && $instamojo_payment == 1): ?>
                <div class="tab-pane" id="instamojo">
                  <?php if(env('IM_API_KEY') != NULL && env('IM_AUTH_TOKEN') != NULL && env('IM_URL') != NULL): ?>
                    <form action="<?php echo e(route('payinstamojo')); ?>" method="POST">
                       <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                   
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Name</strong>
                                    <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>" class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Mobile Number</strong>
                                    <input type="text" name="mobile_number" value="<?php echo e(Auth::user()->mobile ? Auth::user()->mobile:''); ?>" class="form-control" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Email Id</strong>
                                    <input type="text" name="email" value="<?php echo e(Auth::user()->email); ?>" class="form-control" placeholder="Enter Email id" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Event Fees</strong>
                                    <input type="text" name="amount" class="form-control" placeholder="" value="<?php echo e($plan->amount - $session_amount); ?>" readonly="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <button type="submit" class="payment-btn instamojo-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                        Instamojo Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <!-- end instamojo -->
            <?php endif; ?>

            <?php if($currency_code == "NGN" || $currency_code == "GHS"): ?>
              <!-- Paystack Tab -->
              <?php if(isset($paystack) && $paystack == 1): ?>
                <div class="tab-pane" id="paystack">
                  <?php if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL): ?>
                    <div class="paystack">
                      <?php
                        $amount = ($plan->amount - $session_amount)*100;
                      ?>
                      <form method="POST" action="<?php echo e(url('payment/paystack')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <input type="hidden" name="email" value="<?php echo e($auth->email); ?>"> 
                        <input type="hidden" name="amount" value="<?php echo e($amount); ?>"> 
                        <input type="hidden" name="currency" value="<?php echo e($plan->currency); ?>"> 
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['plan_id' => $plan->plan_id,])); ?>" > 
                        <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>">
                        <input type="hidden" name="key" value="<?php echo e(config('paystack.secretKey')); ?>"> 
                        <?php echo e(csrf_field()); ?>

                        <button class="payment-btn paystack-btn"><i class="fa fa-credit-card"></i><?php echo e(__('staticwords.payvia')); ?> Paystack</button>
                      </form>
                    </div>
                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                      Paystack Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <!-- end paystack -->

              <?php if(isset($flutterrave_payment) && $flutterrave_payment == 1): ?>
                <div class="tab-pane" id="flutterrave">
                  <?php if(env('RAVE_PUBLIC_KEY') != NULL && env('RAVE_SECRET_KEY') != NULL && env('RAVE_COUNTRY') != NULL ): ?>
                   <form method="POST" action="<?php echo e(route('flutterrave.pay')); ?>" id="paymentForm">
                      <?php echo e(csrf_field()); ?>


                      <input class="form-control col-md-6" name="plan_id" type="hidden" value="<?php echo e($plan->id); ?>" placeholder="planid" />
                      <input class="form-control col-md-6" name="name" value="<?php echo e(auth()->user()->name); ?>" placeholder="Name" />
                      <input class="form-control col-md-6" name="amount" value="<?php echo e($plan->amount - $session_amount); ?>" placeholder="plan amount" disabled="" />
                      <input class="form-control col-md-6" name="email" value="<?php echo e(auth()->user()->email); ?>" type="email" placeholder="Your Email" />
                      <input class="form-control col-md-6" name="phone" value="<?php echo e(auth()->user()->mobile ? auth()->user()->mobile : '9999999999'); ?>" type="tel" placeholder="Phone number" />

                      <input type="submit" class="payment-btn" value="<?php echo e(__('staticwords.paynow')); ?>" />
                  </form>
                  <?php else: ?>
                    <?php $__env->startComponent('components.alert'); ?>
                      Flutterrave Payment
                    <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

            <?php endif; ?>

            <!-- omise tab -->
            <?php if($currency_code == "THB" || $currency_code == "GBP" || $currency_code == "USD"): ?>
              <?php if(isset($omise_payment) && $omise_payment == 1): ?>
                 <div class="tab-pane" id="omise">
                    <?php if(env('OMISE_PUBLIC_KEY') != NULL && env('OMISE_SECRET_KEY') != NULL && env('OMISE_API_VERSION') != NULL): ?>
                      <form id="checkoutForm" method="POST" action="<?php echo e(route('pay.via.omise')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
                        <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                          data-key="<?php echo e(env('OMISE_PUBLIC_KEY')); ?>"
                          data-amount="<?php echo e(($plan->amount - $session_amount)*100); ?>"
                          data-frame-label="<?php echo e(config('app.name')); ?>"
                          data-image="<?php echo e(url('images/logo/'.$configs->logo)); ?>"
                          data-currency="<?php echo e($currency_code); ?>"
                          data-default-payment-method="credit_card">
                        </script>
                      </form>
                    <?php else: ?>
                      <?php $__env->startComponent('components.alert'); ?>
                        Omise Payment
                      <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                    <?php endif; ?>
                 </div>
              <?php endif; ?>
            <?php endif; ?>
             <!-- omise tab -->
            
            <!-- Bank detail Tab -->
            <?php if(isset($bankdetails) && $bankdetails == 1): ?>
              <div class="tab-pane" id="bankdetails">
                <?php if(($account_name != NULL) && ($account_no != NULL) && ($ifsc_code != NULL) && ($bank!= NULL)): ?>
                  <button class="payment-btn" id="bankbutton"><?php echo e(__('staticwords.DirectBankTransfer')); ?></button>
                      <div id="bankdetail" style="display: none;">
                        <br/>
                        <table class="table">
                          <tr>
                            <th><?php echo e(__('staticwords.AccountName')); ?></th>
                            <td><?php echo e($account_name); ?></td>
                          </tr>
                           <tr>
                            <th><?php echo e(__('staticwords.accountnumber')); ?></th>
                            <td><?php echo e($account_no); ?></td>
                          </tr>
                           <tr>
                            <th><?php echo e(__('staticwords.BankName')); ?></th>
                            <td><?php echo e($bank); ?></td>
                          </tr>
                           <tr>
                            <th><?php echo e(__('staticwords.IFSCCode')); ?></th>
                            <td><?php echo e($ifsc_code); ?></td>
                          </tr>
                        </table>
                        <div class="row">
                          
                          <div class="col-md-12">
                             <p style="color: #d63031;">* <?php echo e(__('staticwords.BankNote')); ?> <a href="<?php echo e(url('contactus')); ?>" style="color: #00b894;"><?php echo e(__('ContactHere')); ?></a></p>
                          </div>
                        </div>
                        <br/>
                        <div class="row"> 
                        <form action="<?php echo e(route('manualpayment',$plan->id)); ?>" method="POST" enctype="multipart/form-data" >
                          <?php echo csrf_field(); ?>
                            <div class="form-group<?php echo e($errors->has('recipt') ? ' has-error' : ''); ?> input-file-block col-md-12">
                              <?php echo Form::label('recipt', 'Manual Payment -Slip upload for verification'); ?>

                              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Manual payment - Slip Upload for verification"></i>
                              <?php echo Form::file('recipt', ['class' => 'input-file', 'id'=>'recipt']); ?>

                              <input type="hidden" name="user_id" value="<?php echo e($auth->id); ?>"> 
                              <input type="hidden" name="user_name" value="<?php echo e($auth->name); ?>">
                              <input type="hidden" name="price" value="<?php echo e($plan->amount -$session_amount); ?>"> 
                              <input type="hidden" name="status" value="0">
                              <input type="hidden" name="currency" value="<?php echo e($plan->currency); ?>"> 
                              <input type="hidden" name="plan_id" value="<?php echo e($plan->plan_id); ?>"> 
                              <input type="hidden" name="method" value="banktransfer">
                              <br/>
                             
                               <button type="submit" class="btn payment-btn ">Proceed</button>
                              
                              <small class="text-danger"><?php echo e($errors->first('recipt')); ?></small>
                            </div>
                           
                           </form>
                        </div>

                      </div>
                <?php else: ?>
                  <?php $__env->startComponent('components.alert'); ?>
                    Bank Detail
                  <?php if (isset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407)): ?>
<?php $component = $__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407; ?>
<?php unset($__componentOriginalc52bd2838f3f04f134d65e73fedfb6e6c096b407); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <!--end Bank detail tab -->

            <?php if(isset($manualpaymentmethod)): ?>
              <?php $__currentLoopData = $manualpaymentmethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mpm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="tab-pane" id="<?php echo e(str_slug($mpm->payment_name, '-')); ?>">
                <p><?php echo e($mpm->description); ?></p>
                <?php if($mpm->thumbnail != NULL): ?>
                  <img src="<?php echo e(url('/images/manual_payment/'.$mpm->thumbnail)); ?>" class="img img-responsive">
                <?php endif; ?>
                <form action="<?php echo e(route('manualpayment',$plan->id)); ?>" method="POST" enctype="multipart/form-data" >
                  <?php echo csrf_field(); ?>
                  <div class="form-group<?php echo e($errors->has('recipt') ? ' has-error' : ''); ?> input-file-block col-md-12">
                   <input class="form-control" type="hidden" name="user_id" value="<?php echo e($auth->id); ?>"> 
                    <input class="form-control" type="hidden" name="user_name" value="<?php echo e($auth->name); ?>">
                    <input class="form-control" type="hidden" name="price" value="<?php echo e($plan->amount - $session_amount); ?>"> 
                    <input  class="form-control" type="hidden" name="status" value="0">
                    <input class="form-control" type="hidden" name="currency" value="<?php echo e($plan->currency); ?>"> 
                    <input class="form-control" type="hidden" name="plan_id" value="<?php echo e($plan->plan_id); ?>"> 
                    <input class="form-control" type="hidden" name="method" value="<?php echo e($mpm->payment_name); ?>">
                    <input class="form-control input-file" type="file" name="recipt" required="">
                    <button type="submit" class="btn payment-btn ">Proceed</button>
                  </div>
                </form>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="clearfix"></div>

      </div>
     
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>

 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

       const stripe = Stripe('<?php echo e(env("STRIPE_KEY")); ?>', { locale: "<?php echo e(app()->getLocale()); ?>" }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

       // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
        // Handle form submission.
        var form = document.getElementById('payment-form');


        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {

        event.preventDefault();

        stripe
            .handleCardSetup(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    // Send the token to your server.
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
      });

        // Submit the form with the token ID.
        function stripeTokenHandler(paymentMethod) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);

            // hiddenInput.setAttribute('name', 'stripeToken');
            // hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

  <script>
     
    $(function(){
      $('.paypal-btn').on('click', function(){
        $('.paypal-btn').addClass('load');
      });

      $('.paystack-btn').on('click', function(){
        $('.paystack-btn').addClass('load');
      });  
      $('.payu-btn').on('click', function(){
        $('.payu-btn').addClass('load');
      }); 
      $('.braintree').hide();
    });
   </script>
  <script src="https://js.braintreegateway.com/web/dropin/1.20.0/js/dropin.min.js"></script>
 <script>  
    var client_token = null;   
    $(function(){
      $('.bt-btn').on('click', function(){
        $('.bt-btn').addClass('load');
        $.ajax({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          },
          type: "POST",
          
          url: "<?php echo e(url('bttoken')); ?>",
          success: function(t) {   
              if(t.client != null){
                client_token = t.client;
                btform(client_token);
                console.log(client_token);
              }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            $('.bt-btn').removeClass('load');
            alert('Payment error. Please try again later.');
          }
        });
      });
    });
    function btform(token){
      var payform = document.querySelector('#bt-form'); 
      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',  
        paypal: {
          flow: 'vault'
        },
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          alert('Payment error. Please try again later.');
          return;
        }
        else{
          $('.bt-btn').hide();
          $('.braintree').show();
        }
        payform.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            alert('Payment error. Please try again later.');
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          payform.submit();
        });
      });
    });
    }
    $('#bankbutton').click(function () {$('#bankdetail').toggle();});
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/subscribe.blade.php ENDPATH**/ ?>