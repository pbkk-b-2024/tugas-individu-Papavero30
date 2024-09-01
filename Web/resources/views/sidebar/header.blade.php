<!-- Sidebar Toggle Button -->
<button class="btn btn-dark" id="sidebarToggle" type="button">
  <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link text-white" href="#" id="pertemuan1-toggle" data-bs-toggle="collapse" data-bs-target="#pertemuan1-collapse" aria-expanded="false" aria-controls="pertemuan1-collapse">
                  Pertemuan1
              </a>
              <ul class="collapse" id="pertemuan1-collapse">
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('Pertemuan1.fibonacci') }}">Fibonacci</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('Pertemuan1.ganjil-genap') }}">Ganjil-Genap</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('Pertemuan1.prima') }}">Prima</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('Pertemuan1.parameter-form') }}">Parameter Form</a>
                </li>
      </ul>
  </div>
</div>

<!-- Include Bootstrap JavaScript (Make sure this is included in your layout) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var sidebarToggle = document.getElementById('sidebarToggle');
      var sidebar = new bootstrap.Offcanvas(document.getElementById('sidebar'));

      sidebarToggle.addEventListener('click', function () {
          sidebar.toggle();
      });
  });
</script>
