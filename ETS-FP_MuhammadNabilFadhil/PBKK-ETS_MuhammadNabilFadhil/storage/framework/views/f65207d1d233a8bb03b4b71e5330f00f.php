

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Suppliers</h1>
    <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary">Add Supplier</a>
    
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success mt-3">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>

    <!-- Search Form -->
    <form action="<?php echo e(route('suppliers.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search suppliers" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Fixed height container for table and pagination -->
    <div style="height: 500px; overflow-y: auto;">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($supplier->name); ?></td>
                        <td><?php echo e($supplier->contact_info); ?></td>
                        <td>
                            <a href="<?php echo e(route('suppliers.edit', $supplier->id)); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?php echo e(route('suppliers.destroy', $supplier->id)); ?>" method="POST" class="d-inline">
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
        <?php echo e($suppliers->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/suppliers/index.blade.php ENDPATH**/ ?>