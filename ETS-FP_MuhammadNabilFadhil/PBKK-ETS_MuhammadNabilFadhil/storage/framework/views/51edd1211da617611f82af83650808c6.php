

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Order Details</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('order_details.create')); ?>" class="btn btn-primary mb-3">Add New Order Detail</a>

    <form action="<?php echo e(route('order_details.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search order details" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 20%;">Order ID</th>
                    <th style="width: 20%;">Product</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 20%;">Price</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($orderDetail->order->id); ?></td>
                        <td><?php echo e($orderDetail->product->name); ?></td>
                        <td><?php echo e($orderDetail->quantity); ?></td>
                        <td><?php echo e($orderDetail->price); ?></td>
                        <td>
                            <a href="<?php echo e(route('order_details.edit', $orderDetail->id)); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?php echo e(route('order_details.destroy', $orderDetail->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($orderDetails->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/order_details/index.blade.php ENDPATH**/ ?>