

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Feedback</h1>

    <!-- Display validation errors -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form to update an existing feedback record -->
    <form action="<?php echo e(route('feedback.update', $feedback->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select name="customer_id" class="form-control">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($customer->id); ?>" <?php echo e($feedback->customer_id == $customer->id ? 'selected' : ''); ?>>
                        <?php echo e($customer->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" class="form-control">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" <?php echo e($feedback->product_id == $product->id ? 'selected' : ''); ?>>
                        <?php echo e($product->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" class="form-control" name="rating" value="<?php echo e($feedback->rating); ?>" min="1" max="5" required>
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" name="comment"><?php echo e($feedback->comment); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/feedback/edit.blade.php ENDPATH**/ ?>