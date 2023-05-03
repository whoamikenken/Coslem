<nav class="sb-topnav navbar navbar-expand navbar-dark bg-<?php echo $this->session->userdata("bg")?>" style="border-bottom: 5px solid #6c757d;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url() ?>"><img src="<?= base_url(); ?>images/logo.png" alt="" width="30" height="24"> COSLEM</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" id="mainform" method="POST">
          <input type="hidden" name="sitename">
          <input type="hidden" name="titlebar">
          <input type="hidden" name="tag">
            <!-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div> -->
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!" id="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="<?= base_url() ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <?php if ($this->session->userdata("type") == "admin" || $this->session->userdata("type") == "treasurer"): ?>
                            <div class="sb-sidenav-menu-heading">Management</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                User Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link menuLink" type="button" tag="member" siteName="setup/member">Member Management</a>
                                    <?php if ($this->session->userdata("type") == "admin"): ?>    
                                        <a class="nav-link menuLink" type="button" tag="tresurer" siteName="setup/tresurer">Treasurer Management</a>
                                        <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/admin">Admin Management</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                            <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/annual">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Annual Period
                            </a>
                        <?php endif ?>
                        <?php if ($this->session->userdata("type") == "member"): ?>
                            <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/loan">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Loan
                            </a>
                        <?php endif ?>
                        <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/transact">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Transactions&nbsp;&nbsp;&nbsp;<span class="badge bg-secondary"><?= $this->setup->countPendingContribution() ?></span>
                        </a>
                        <?php if ($this->session->userdata("type") == "admin"): ?>
                        <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/activity">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Activity Logs&nbsp;&nbsp;&nbsp;<span class="badge bg-secondary"></span>
                        </a>
                        <?php endif ?>
                        <?php if ($this->session->userdata("type") == "admin"): ?>
                        <div class="sb-sidenav-menu-heading">Reports</div>
                            <!-- <a class="nav-link reportType" role="button" rap="contribution" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                All Contribution
                            </a> -->
                            
                            <a class="nav-link menuLink" type="button" tag="admin" siteName="setup/loan">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Loan List &nbsp;&nbsp;&nbsp;<span class="badge bg-secondary"><?= $this->setup->countPendingLoan() ?></span>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= $this->session->userdata()['name'] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4" id="mainContainer">