    
    </head>

    <body id="page-top">
    <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= URL ?>admin/index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-box-open fa-4x"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">ACAV</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>admin/index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>pages/index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Site web</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                

                <!-- Nav Item - Pages Collapse Menu -->
                

                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Pages
                </div> -->

                <!-- Nav Item - Pages Collapse Menu -->
              
                
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients"
                            aria-expanded="true" aria-controls="collapseClients">
                            <!-- <i class="fas fa-fw fa-folder"></i> -->
                            <i class="fas fa-fw fa-users"></i>
                            <span>Clients</span>
                        </a>
                        <div id="collapseClients" class="collapse" aria-labelledby="headingLivres" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Clients</h6>
                                <a class="collapse-item" href="<?= URL ?>admin/clients/index.php">Liste des clients</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations"
                            aria-expanded="true" aria-controls="collapseLocations">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Créations</span>
                        </a>
                        <div id="collapseLocations" class="collapse" aria-labelledby="headingLocations" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= URL ?>admin/creations/add.php">Ajouter une création</a>
                                <a class="collapse-item" href="<?= URL ?>admin/creations/index.php">Liste des créations</a>
                            </div>
                        </div>
                    </li>
                    <hr class="sidebar-divider d-none d-md-block">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                            aria-expanded="true" aria-controls="collapseUsers">
                            <!-- <i class="fas fa-fw fa-folder"></i> -->
                            <i class="fas fa-fw fa-user-shield"></i>
                            <span>Utilisateurs</span>
                        </a>
                        <div id="collapseUsers" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= URL ?>admin/utilisateurs/add.php">Ajouter un utilisateur</a>
                                <a class="collapse-item" href="<?= URL ?>admin/utilisateurs/index.php">Liste des utilisateurs</a>
                            </div>
                        </div>
                    </li>
                    
                
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>