
<?php $__env->startSection('title','Manual Payment Gateway'); ?>
<?php $__env->startSection('body'); ?>
<?php $__env->startComponent('components.box',['border' => 'with-border']); ?>
<?php $__env->slot('header'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
    <div class="row admin-form-block z-depth-1">   
        <div class="pull-right">

            <a data-toggle="modal" data-target="#addPaymentModal" href="" class="btn btn-md btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>

        </div>

        <table style="width:100%" id="full_detail_table" class="table table-bordered">
            <thead>
                <th>
                    #
                </th>
                <th>
                    Payment Gateway Name
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e(ucfirst($m->payment_name)); ?></td>
                    <td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manual-payment.edit')): ?>
                        <a data-toggle="modal" data-target="#editPaymentmethod<?php echo e($m->id); ?>" class="btn-info btn-floating"><i class="material-icons">mode_edit</i>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manual-payment.delete')): ?>
                        <a data-toggle="modal" data-target="#deletepaymentmethod<?php echo e($m->id); ?>"  class="btn-danger btn-floating"><i class="material-icons">delete</i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>

                <!-- Edit Payment Method Modal -->
                <div data-backdrop="false" id="editPaymentmethod<?php echo e($m->id); ?>" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="editPaymentModal-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="editPaymentModal-title">Edit Payment method: <?php echo e($m->payment_name); ?>

                                </h5>

                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(route('manual.payment.gateway.update',$m->id)); ?>" method="POST"
                                    enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <label for="">
                                            Payment method name: <span class="text-red">*</span>
                                        </label>
                                        <input required type="text" value="<?php echo e($m['payment_name']); ?>" name="payment_name"
                                            class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">
                                            Payment Instructions : <span class="text-red">*</span>
                                        </label>

                                        <textarea name="description" id="" cols="30" rows="5"
                                            class="form-control editor"><?php echo $m['description']; ?></textarea>

                                    </div>

                                    <div class="form-group">
                                        <label for="">
                                            Image :
                                        </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-5">Status :</label>
                                        <label class="make-switch col-md-7 pad-0">
                                            <input class="bootswitch" id="status" type="checkbox" name="status"
                                                <?php echo e($m['status'] == 1 ? "checked" : ""); ?>>
                                            
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-success">
                                            <i class="fa fa-save"></i> Update
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Delete Payment -->
                <div id="deletepaymentmethod<?php echo e($m->id); ?>" class="delete-modal modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                                <h4 class="modal-heading">Are You Sure ?</h4>
                                <p>Do you really want to delete this Payment method <b><?php echo e($m->payment_name); ?></b>? This process
                                    cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="<?php echo e(route('manual.payment.gateway.delete',$m->id)); ?>"
                                    class="pull-right">
                                    <?php echo csrf_field(); ?>
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Create Payment Method Modal -->
        <div data-backdrop="false" id="addPaymentModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="addPaymentModal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="addPaymentModal-title">Add new payment method</h5>

                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('manual.payment.gateway.store')); ?>" method="POST" enctype="multipart/form-data">

                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="">
                                    Payment method name: <span class="text-red">*</span>
                                </label>
                                <input required type="text" value="<?php echo e(old('payment_name')); ?>" name="payment_name"
                                    class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="">
                                    Payment Instructions : <span class="text-red">*</span>
                                </label>

                                <textarea name="description" id="" cols="30" rows="5"
                                    class="form-control editor"><?php echo old('description'); ?></textarea>

                            </div>

                            <div class="form-group">
                                <label for="">
                                    Image :
                                </label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 bootstrap-switch-label">Status :</label>
                                <label class="make-switch col-md-7 pad-0">
                                    <input class="bootswitch" id="status" type="checkbox" name="status" <?php echo e(old('status') ? "checked" : ""); ?>>
                                    
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle"></i> Create
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/manualpayment/index.blade.php ENDPATH**/ ?>