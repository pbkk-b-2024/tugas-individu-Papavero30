

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Inventory List</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <a href="<?php echo e(route('inventory.create')); ?>" class="btn btn-primary mb-3">Add New Inventory</a>

    <!-- Search Form -->
    <form action="<?php echo e(route('inventory.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search inventory" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Fixed height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 30%;">Product</th>
                    <th style="width: 20%;">Quantity Available</th>
                    <th style="width: 20%;">Last Updated</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="width: 10%;"><?php echo e($inventory->id); ?></td>
                        <td style="width: 30%;"><?php echo e($inventory->product->name); ?></td>
                        <td style="width: 20%;"><?php echo e($inventory->quantity_available); ?></td>
                        <td style="width: 20%;"><?php echo e($inventory->updated_at); ?></td>
                        <td style="width: 20%;">
                            <a href="<?php echo e(route('inventory.edit', $inventory->id)); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?php echo e(route('inventory.destroy', $inventory->id)); ?>" method="POST" style="display:inline-block;">
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

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        <?php echo e($inventories->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/inventory/index.blade.php ENDPATH**/ ?>