  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{ url('/admin/beranda') }}">
                  <i class="bi bi-house-door-fill"></i> <span>Beranda</span>
              </a>
          </li>

          <!-- sub menu service layanan -->
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse">
                  <i class="bi bi-gear-wide-connected"></i><span>Service Layanan</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.services.index') }}">
                          <i class="bi bi-circle"></i><span>List Service Layanan</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- sub menu pelanggan -->
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-person-fill"></i><span>Pelanggan</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('list.pelanggan') }}">
                          <i class="bi bi-circle"></i><span>Rekap Pelanggan</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- sub menu order -->
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-medical"></i><span>Order Layanan</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('rekap-order-selesai') }}">
                          <i class="bi bi-circle"></i><span>Rekap Order Selesai</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('order-list-validasi') }}">
                          <i class="bi bi-circle"></i><span>Order Masuk</span>
                      </a>
                  </li>
              </ul>
          </li>

          {{-- <!-- sub menu deposit -->
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-wallet2"></i><span>Deposit</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              </ul>
          </li> --}}
      </ul>
  </aside>
