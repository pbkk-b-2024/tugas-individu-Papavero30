

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Supplier Products</h1>

    <!-- Display success messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Button to create a new supplier product -->
    <a href="<?php echo e(route('supplier_products.create')); ?>" class="btn btn-primary mb-3">Add New Supplier Product</a>

    <!-- Search Form -->
    <form action="<?php echo e(route('supplier_products.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search supplier products" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Full height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <!-- Display the supplier products in a table with fixed column widths -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 20%;">Supplier</th>
                    <th style="width: 20%;">Product</th>
                    <th style="width: 20%;">Price</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $supplierProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplierProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($supplierProduct->supplier->name); ?></td>
                        <td><?php echo e($supplierProduct->product->name); ?></td>
                        <td><?php echo e($supplierProduct->price); ?></td>
                        <td><?php echo e($supplierProduct->quantity); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="<?php echo e(route('supplier_products.edit', $supplierProduct->id)); ?>" class="btn btn-warning">Edit</a>

                            <!-- Delete Button -->
                            <form action="<?php echo e(route('supplier_products.destroy', $supplierProduct->id)); ?>" method="POST" style="display:inline;">
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
        <?php echo e($supplierProducts->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/supplier_products/index.blade.php ENDPATH**/ ?>