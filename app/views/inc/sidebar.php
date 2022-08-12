    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
						<!-- sublist of sidebar -->
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="/admin" class="nav-link px-3 active">
                <span class="me-2">
									<i class="bi bi-speedometer2"></i>
								</span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
						<!--
							collabse links
						-->
						<!-- first item -->
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2">
									<i class="bi bi-layout-split"></i>
								</span>
                <span>Layouts</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="/admin" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-speedometer2"></i>
											</span>
                      <span>Dashboard</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
						<!-- seoncd item -->
								<li>
								<a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#second-layout"
              >
                <span class="me-3">
									<i class="bi bi-person"></i>
							</span>
                <span>Admin</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="second-layout">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-people"></i>
										</span>
                      <span>All admins</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-person-plus"></i>
											</span>
                      <span>Add admin</span>
                    </a>
                  </li>
                </ul>
              </div>
						</li>
						<!-- third item -->
						<li>
								<a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#third-layout"
              >
                <span class="me-3"><i class="bi bi-building"></i></span>
                <span>Building</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="third-layout">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-border-all"></i>
										</span>
                      <span>All buildings</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-pencil"></i>
											</span>
                      <span>Add building</span>
                    </a>
                  </li>
                </ul>
              </div>
						</li>
						<!-- fourth item -->
						<li>
						<a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#fourth-layout"
              >
                <span class="me-3">
									<i class="bi bi-basket-fill"></i>
								</span>
                <span>Category</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="fourth-layout">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-border-all"></i>
											</span>
                      <span>All categories</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-bag-plus-fill"></i>
											</span>
                      <span>Add category</span>
                    </a>
                  </li>
                </ul>
              </div>
						</li>
						<!-- fifth item -->
						<li>
						<a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#fifth-layout"
              >
                <span class="me-3">
									<i class="bi bi-geo-alt"></i>
								</span>
                <span>Location</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="fifth-layout">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="/admin/location" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-map"></i>
											</span>
                      <span>All locations</span>
                    </a>
                  </li>
                  <li>
                    <a href="/admin/location/add" class="nav-link px-3">
                      <span class="me-2">
												<i class="bi bi-plus-circle"></i>
											</span>
                      <span>Add location</span>
                    </a>
                  </li>
                </ul>
              </div>
						</li>
						<!--
								End of collabsed items
						-->
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Pages</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Addons
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Charts</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Tables</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
