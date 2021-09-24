
<?php $__env->startSection('title',__('adminstaticwords.AddonManager')); ?>
<?php $__env->startSection('content'); ?>
 <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <!-- install Modal -->
      <a data-target="#installnew" data-toggle="modal" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.InstallNewAddOn')); ?></a>   
      <!-- Modal -->
    </div>

 <div class="content-block box-body content-block-two">

    <table id="modules" class="table table-bordered">
        <thead>
            <th>#</th>
            <th><?php echo e(__('adminstaticwords.Logo')); ?></th>
            <th><?php echo e(__('adminstaticwords.Name')); ?></th>
            <th><?php echo e(__('adminstaticwords.Status')); ?></th>
            <th><?php echo e(__('adminstaticwords.Version')); ?></th>
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
        </thead>

        <tbody>

        </tbody>
    </table>

    <div data-backdrop="static" data-keyboard="false" id="installnew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="my-modal-title">
                        <b><?php echo e(__("adminstaticwords.InstallNewAddOn")); ?></b>
                    </h5>
                    
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('addon.install')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label><?php echo e(__('adminstaticwords.EnterPurchaseCode')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" placeholder="<?php echo e(__('adminstaticwords.EnvantoPurchaseCodeOfYourAddon')); ?>" class="form-control" name="purchase_code">
                        </div>

                        <div class="form-group">
                            <label><?php echo e(__('adminstaticwords.ChooseZipFile')); ?>: <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="addon_file">
                        </div>

                        <div class="form-group">
                             <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Install')); ?></button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script>
    $(function () {
        "use strict";
        var table = $('#modules').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(url("admin/addon-manger")); ?>',
            language: {
                searchPlaceholder: "Search Modules..."
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'image',
                    name: 'image',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'version',
                    name: 'version'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            order: [
                [0, 'DESC']
            ]
        });

        $('#modules').on('change', '.toggle_addon', function (e) { 

            var modulename = $(this).data('addon');

            if($(this).is(':checked')){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajax({
                url : '<?php echo e(url("admin/toggle/module")); ?>',
                method : 'POST',
                data : {status : status, modulename : modulename},
                success :function(data){
                    table.draw();

                    if(data.status == 'success'){
                        toastr.success(data.msg,{timeOut: 1500});
                    }else{
                        toastr.error(data.msg, 'Oops!',{timeOut: 1500});
                    }
                    
                },
                error : function(jqXHR,err){
                    console.log(err);
                }
            });

        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/addonmanager/index.blade.php ENDPATH**/ ?>