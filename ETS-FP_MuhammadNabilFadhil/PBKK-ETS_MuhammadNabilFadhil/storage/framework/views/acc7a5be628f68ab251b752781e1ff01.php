<!-- Sidebar -->
<div id="sidebar" class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="sidebarLabel">Admin Dashboard</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('customers.index')); ?>">
                    <i class="fa-solid fa-users me-2"></i> Customer List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('categories.index')); ?>">
                    <i class="fa-solid fa-list-alt me-2"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('suppliers.index')); ?>">
                    <i class="fa-solid fa-truck me-2"></i> Suppliers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('products.index')); ?>">
                    <i class="fa-solid fa-utensils me-2"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('orders.index')); ?>">
                    <i class="fa-solid fa-receipt me-2"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('order_details.index')); ?>">
                    <i class="fa-solid fa-info-circle me-2"></i> Order Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('inventory.index')); ?>">
                    <i class="fa-solid fa-boxes me-2"></i> Inventory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('feedback.index')); ?>">
                    <i class="fa-solid fa-comment-dots me-2"></i> Feedback
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('actions.index')); ?>">
                    <i class="fa-solid fa-tasks me-2"></i> Actions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('recommendations.index')); ?>">
                    <i class="fa-solid fa-lightbulb me-2"></i> Recommendations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="<?php echo e(route('supplier_products.index')); ?>">
                    <i class="fa-solid fa-box me-2"></i> Supplier Products
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sidebarToggle = document.getElementById('sidebarToggle');
        var sidebar = new bootstrap.Offcanvas(document.getElementById('sidebar'));

        sidebarToggle.addEventListener('click', function () {
            sidebar.toggle();
        });
    });
</script>


<style>
    .nav-link {
        position: relative;
        overflow: hidden;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover {
        background-color: #1b1b1b;
        color: #f8f9fa;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #f8f9fa20; 
        transition: left 0.5s ease;
    }

    .nav-link:hover::before {
        left: 0;
    }

    .nav-link i {
        transition: transform 0.3s ease;
    }

    .nav-link:hover i {
        transform: scale(1.2);
    }
</style>


<?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/sidebar/sidebar.blade.php ENDPATH**/ ?>