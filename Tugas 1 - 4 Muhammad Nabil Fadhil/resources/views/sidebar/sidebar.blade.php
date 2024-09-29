<!-- Sidebar -->
<div id="sidebar" class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="sidebarLabel">Dashboard</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column">
            @can('read categories')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('categories.index') }}">
                    <i class="fa-solid fa-list-alt me-2"></i> Categories
                </a>
            </li>
            @endcan
            @can('read suppliers')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('suppliers.index') }}">
                    <i class="fa-solid fa-truck me-2"></i> Suppliers
                </a>
            </li>
            @endcan
            @can('read products')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('products.index') }}">
                    <i class="fa-solid fa-utensils me-2"></i> Products
                </a>
            </li>
            @endcan
            @can('read orders')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('orders.index') }}">
                    <i class="fa-solid fa-receipt me-2"></i> Orders
                </a>
            </li>
            @endcan
            @can('read order details')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('order_details.index') }}">
                    <i class="fa-solid fa-info-circle me-2"></i> Order Details
                </a>
            </li>
            @endcan
            @can('read inventories')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('inventory.index') }}">
                    <i class="fa-solid fa-boxes me-2"></i> Inventory
                </a>
            </li>
            @endcan
            @can('read feedback')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('feedback.index') }}">
                    <i class="fa-solid fa-comment-dots me-2"></i> Feedback
                </a>
            </li>
            @endcan
            @can('read actions')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('actions.index') }}">
                    <i class="fa-solid fa-tasks me-2"></i> Actions
                </a>
            </li>
            @endcan
            @can('read recommendations')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('recommendations.index') }}">
                    <i class="fa-solid fa-lightbulb me-2"></i> Recommendations
                </a>
            </li>
            @endcan
            @can('read supplier products')
            <li class="nav-item">
                <a class="nav-link text-white py-3 px-4 d-flex align-items-center" href="{{ route('supplier_products.index') }}">
                    <i class="fa-solid fa-box me-2"></i> Supplier Products
                </a>
            </li>
            @endcan
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