

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Recommendations</h1>

    <!-- Display any success messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Button to create a new recommendation record -->
    <a href="<?php echo e(route('recommendations.create')); ?>" class="btn btn-primary mb-3">Add New Recommendation</a>

    <!-- Search Form -->
    <form action="<?php echo e(route('recommendations.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search recommendations" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Full height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <!-- Display the recommendation records in a table with fixed column widths -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 25%;">Customer</th>
                    <th style="width: 25%;">Product</th>
                    <th style="width: 25%;">Recommendation Type</th>
                    <th style="width: 25%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $recommendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommendation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($recommendation->customer->name); ?></td>
                        <td><?php echo e($recommendation->product->name); ?></td>
                        <td><?php echo e(ucfirst($recommendation->recommendation_type)); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="<?php echo e(route('recommendations.edit', $recommendation->id)); ?>" class="btn btn-warning">Edit</a>

                            <!-- Delete Button -->
                            <form action="<?php echo e(route('recommendations.destroy', $recommendation->id)); ?>" method="POST" style="display:inline;">
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
        <?php echo e($recommendations->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/recommendations/index.blade.php ENDPATH**/ ?>