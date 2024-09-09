

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Customers</h1>
    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary">Add New Customer</a>

    <form action="<?php echo e(route('customers.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search customers" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: 500px; overflow-y: auto;">
        <table class="table table-bordered mt-4 w-100">
            <thead>
                <tr>
                    <th style="width: 25%;">Name</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 25%;">Phone</th>
                    <th style="width: 25%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="width: 25%;"><?php echo e($customer->name); ?></td>
                    <td style="width: 25%;"><?php echo e($customer->email); ?></td>
                    <td style="width: 25%;"><?php echo e($customer->phone); ?></td>
                    <td style="width: 25%;">
                        <a href="<?php echo e(route('customers.edit', $customer->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('customers.destroy', $customer->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($customers->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/customers/index.blade.php ENDPATH**/ ?>