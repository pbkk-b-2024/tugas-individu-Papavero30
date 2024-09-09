

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Add New Inventory</h1>
    <form action="<?php echo e(route('inventory.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">-- Select Product --</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity_available" class="form-label">Quantity Available</label>
            <input type="number" name="quantity_available" id="quantity_available" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Inventory</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('TemplateLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebarcontent/inventory/create.blade.php ENDPATH**/ ?>