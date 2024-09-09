

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Feedback</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('feedback.create')); ?>" class="btn btn-primary mb-3">Add New Feedback</a>

    <form action="<?php echo e(route('feedback.index')); ?>" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search feedback" value="<?php echo e(request()->query('search')); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 20%;">Customer</th>
                    <th style="width: 20%;">Product</th>
                    <th style="width: 10%;">Rating</th>
                    <th style="width: 40%;">Comment</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="width: 20%;"><?php echo e($feedback->customer->name); ?></td>
                        <td style="width: 20%;"><?php echo e($feedback->product->name); ?></td>
                        <td style="width: 10%;"><?php echo e($feedback->rating); ?></td>
                        <td style="width: 40%;"><?php echo e($feedback->comment); ?></td>
                        <td style="width: 10%;">
                            <a href="<?php echo e(route('feedback.edit', $feedback->id)); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?php echo e(route('feedback.destroy', $feedback->id)); ?>" method="POST" style="display:inline;">
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
        <?php echo e($feedbacks->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/feedback/index.blade.php ENDPATH**/ ?>