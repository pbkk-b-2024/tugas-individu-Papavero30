

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Actions</h1>

    <!-- Display any success messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Button to create a new action record -->
    <a href="<?php echo e(route('actions.create')); ?>" class="btn btn-primary mb-3">Add New Action</a>

    <!-- Search Form -->
    <form action="<?php echo e(route('actions.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search actions" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Fixed height container for table and pagination -->
    <div style="height: 500px; overflow-y: auto;">
        <!-- Display the actions records in a table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Action Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($action->customer ? $action->customer->name : 'N/A'); ?></td>
                        <td><?php echo e($action->product ? $action->product->name : 'N/A'); ?></td>
                        <td><?php echo e(ucfirst($action->action_type)); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="<?php echo e(route('actions.edit', $action->id)); ?>" class="btn btn-warning">Edit</a>

                            <!-- Delete Button -->
                            <form action="<?php echo e(route('actions.destroy', $action->id)); ?>" method="POST" style="display:inline;">
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

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        <?php echo e($actions->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/actions/index.blade.php ENDPATH**/ ?>