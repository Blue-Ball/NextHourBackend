
<?php $__env->startSection('title','User Dashboard'); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="user-img">
            <?php if(isset($auth->image) && $auth->image != NULL): ?>
              <img src="<?php echo e(url('images/users'.$auth->image)); ?>">
            <?php else: ?>
              <img src="<?php echo e(url('images/default.jpg')); ?>">
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-8">
          <div id="exTab1" class="container"> 
            <ul  class="nav nav-pills">
              <li class="active">
                <a  href="#details" data-toggle="tab"><?php echo e(__('staticwords.Details')); ?></a>
              </li>
              <li><a href="#membership" data-toggle="tab"><?php echo e(__('staticwords.Membership')); ?></a>
              </li>
              <li><a href="#history" data-toggle="tab"><?php echo e(__('staticwords.PaymentHistory')); ?></a>
              </li>
            </ul>
            <div class="tab-content clearfix">
              <div class="tab-pane active" id="details">
                <div class="edit-profile-main-block">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">Change Email</h4>
                        <div class="info"><?php echo e(__('staticwords.currentemail')); ?>: <?php echo e(auth()->user()->email); ?></div>
                        <form method="POST" action="<?php echo e(route('user.profile')); ?>" accept-charset="UTF-8">
                          <?php echo csrf_field(); ?>
                          
                          <div class="form-group <?php echo e($errors->has('new_email') ? ' has-error' : ''); ?>">
                            <label for="new_email"><?php echo e(__('staticwords.newemail')); ?></label>
                            <input class="form-control" name="new_email" type="email" id="new_email">
                            <small class="text-danger"><?php echo e($errors->first('new_email')); ?></small>
                          </div>
                          <div class="form-group">
                            <label for="current_password"><?php echo e(__('staticwords.currentpassword')); ?></label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="<?php echo e(__('staticwords.update')); ?>">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changepassword')); ?></h4>
                        <div class="info"><?php echo e(__('staticwords.wanttochangeyourpassword')); ?></div>
                        <form method="POST" action="<?php echo e(url('account/profile')); ?>" accept-charset="UTF-8">
                          <?php echo csrf_field(); ?>
                          <div class="form-group <?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                            <label for="current_password"><?php echo e(__('staticwords.currentpassword')); ?></label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
                          </div>
                          <div class="form-group <?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
                            <label for="new_password"><?php echo e(__('staticwords.newpassword')); ?></label>
                            <input class="form-control" name="new_password" type="password" value="" id="new_password">
                            <small class="text-danger"><?php echo e($errors->first('new_password')); ?></small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="<?php echo e(__('staticwords.update')); ?>">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.updateageandmobile')); ?></h4>
                        <div class="info"><?php echo e(__('staticwords.wanttochangeageandmobile')); ?></div>
                        <form method="POST" action="<?php echo e(route('user.age')); ?>" accept-charset="UTF-8">
                          <?php echo csrf_field(); ?>
                          <div class="form-group <?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
                            <label for="dob"><?php echo e(__('staticwords.dateofbirth')); ?></label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('staticwords.enterdateofbirthuser')); ?>"></i>
                            <input type="date" class="form-control" name="dob" <?php if(isset(Auth::user()->dob)): ?> value="<?php echo e(Auth::user()->dob); ?>" <?php endif; ?> >   
                            <small class="text-danger"><?php echo e($errors->first('dob')); ?></small>
                          </div>
                          <div class="form-group <?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                            <label for="mobile"><?php echo e(__('staticwords.mobileno')); ?></label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('staticwords.enteryourmobileno')); ?>"></i>
                            <input type="number" class="form-control" name="mobile" <?php if(isset(Auth::user()->mobile)): ?> value="<?php echo e(Auth::user()->mobile); ?>"<?php endif; ?>>   
                            <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="<?php echo e(__('staticwords.update')); ?>">
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
                        <h4><?php echo e(__('staticwords.yourmembership')); ?></h4>
                        <div class="info"><?php echo e(__('staticwords.wanttochangemembership')); ?></div>
                    </div>
                    <div class="col-lg-5">
                      <?php
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
                         
                      ?>
                      <?php if($auth->is_admin==1): ?>
                        <div class="membership-sub">Current Subscription: FREE</div>
                      <?php else: ?>
                        <?php if($bfree==1): ?>

                          <div class="membership-sub"><?php echo e(__('staticwords.currentsubscritptionfreetill')); ?>

                            <strong><?php echo e(date('F j, Y  g:i:a',strtotime($ps->subscription_to))); ?> </strong></div>

                        <?php elseif($bfree==0): ?>
                        
                         <?php if(isset($ps) && $current_subscription->subscription_to < $ps->subscription_to): ?>
                            <?php
                               $psn=App\Package::where('id',$ps->package_id)->first();
                            ?>

                            <div class="membership-sub"><?php echo e(__('staticwords.currentsubscription')); ?>: <?php echo e($psn != NULL ? ucfirst($psn['name']) : '-'); ?></div>
                          <?php else: ?>
                             <?php if($current_subscription != null): ?>

                                <div class="membership-sub"><?php echo e(__('staticwords.currentsubscription')); ?>: <?php echo e($method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)); ?></div>
                            <?php endif; ?>
                          <?php endif; ?>
                          
                       <?php else: ?>

                          <?php if($current_subscription != null): ?>

                             <div class="membership-sub"><?php echo e(__('staticwords.currentsubscription')); ?>: <?php echo e($method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)); ?></div>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                    <div class="col-lg-3">
                        <?php if($current_subscription != null && $method == 'stripe'): ?> 
                          <?php if(getPlan() == 0): ?>
                            <a href="<?php echo e(route('resumeSub', $current_subscription->stripe_plan)); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.resumesubscription')); ?></a>
                          <?php else: ?>
                            <a href="<?php echo e(route('cancelSub', $current_subscription->stripe_plan)); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.cancelsubscription')); ?></a>
                          <?php endif; ?>
                        <?php elseif($current_subscription != null && $method == 'paypal'): ?> 
                          <?php if($current_subscription->status == 0): ?>
                            <a href="<?php echo e(route('resumeSubPaypal')); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.resumesubscription')); ?></a>
                          <?php elseif($current_subscription->status == 1): ?>
                            <a href="<?php echo e(route('cancelSubPaypal')); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.cancelsubscription')); ?></a>
                          <?php endif; ?>
                        <?php else: ?> 
                          <?php if($auth->is_admin == 1): ?>
                          <?php else: ?>              
                          <a href="<?php echo e(url('account/purchaseplan')); ?>" class="btn btn-setting"><?php echo e(__('staticwords.subscribenow')); ?></a>
                          <?php endif; ?>
                        <?php endif; ?>
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="history">
                <div class="panel-setting-main-block billing-history-main-block">
                  <?php if(isset($invoices) && $invoices != null): ?>
                    <div class="container">
                      <h4 class="plan-dtl-heading"><?php echo e(__('staticwords.stripebillinghistory')); ?></h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th><?php echo e(__('staticwords.date')); ?></th>
                              <th><?php echo e(__('staticwords.package')); ?></th>
                              <th><?php echo e(__('staticwords.serviceperiod')); ?></th>
                              <th><?php echo e(__('staticwords.paymentmethod')); ?></th>
                              <th><?php echo e(__('staticwords.total')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                           
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                              <?php
                                $from = Carbon\Carbon::parse($invoice->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($invoice->subscription_to);
                                $to = $to->toDateString();
                                 $created = Carbon\Carbon::parse($invoice->subscription_from);
                                $created = $created->toDateString();

                                $plan = App\Package::where('plan_id',$invoice->stripe_plan)->first();
                              ?>
                              <tr>
                                <td><?php echo e($created); ?></td>
                                <td><?php echo e($plan->name); ?></td>
                                <td><?php echo e($from); ?> to <?php echo e($to); ?></td>
                                <td>Stripe</td>
                                <td><i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($invoice->amount); ?></td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if(isset($paypal_subscriptions) && $paypal_subscriptions != null && count($paypal_subscriptions) > 0): ?>
                    <div class="container">
                      <h4 class="plan-dtl-heading"><?php echo e(__('staticwords.billinghistory')); ?></h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th><?php echo e(__('staticwords.date')); ?></th>
                              <th><?php echo e(__('staticwords.package')); ?></th>
                              <th><?php echo e(__('staticwords.serviceperiod')); ?></th>
                              <th><?php echo e(__('staticwords.paymentmethod')); ?></th>
                              <th><?php echo e(__('staticwords.total')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $paypal_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php
                                $from = Carbon\Carbon::parse($item->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($item->subscription_to);
                                $to = $to->toDateString();
                              ?>
                              <tr>
                                <td><?php echo e($item->created_at->toDateString()); ?></td>
                                <td><?php echo e($item->plan ? $item->plan->name : 'N/A'); ?></td>
                                <td><?php echo e($from); ?> to <?php echo e($to); ?></td>
                                <td><?php echo e(ucfirst($item->method)); ?></td>
                                <td><i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($item->price); ?></td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/index.blade.php ENDPATH**/ ?>