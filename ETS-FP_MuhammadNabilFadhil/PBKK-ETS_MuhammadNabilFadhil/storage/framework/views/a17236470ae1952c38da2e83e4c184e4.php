

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Create New Order Detail</h1>

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

    <!-- Form to create a new order detail -->
    <form action="<?php echo e(route('order_details.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="order_id">Order:</label>
            <select name="order_id" class="form-control">
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($order->id); ?>"><?php echo e($order->id); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" class="form-control">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" min="1" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/order_details/create.blade.php ENDPATH**/ ?>