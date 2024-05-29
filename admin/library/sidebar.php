<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="./public/img/cm.jpg" alt="Cybermaisha Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">LMS Admin</span>
    </a>
<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="public/img/cm.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucwords($_SESSION['admin_firstname'].' '.$_SESSION['admin_lastname']) ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
     
            </ul>
          </li>

          <li class="nav-item menu nav-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 <li class="nav-item">
                <a href="index.php?page=pending_loans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Loans</p>
                </a>
              </li>
                 <li class="nav-item">
                <a href="index.php?page=rejected_loans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected Loans</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="index.php?page=approved_loans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Loans</p>
                </a>
              </li>
                  <li class="nav-item">
                <a href="index.php?page=released_loans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Released Loans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=loan_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan List</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="index.php?page=loan_schedule_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Shedule List</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="loan_schedule.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Release Loan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_loan_application" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Loan Application</p>
                </a>
              </li>
            </ul>
          </li>  
                 <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Loan Payment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=payment_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_payment" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment</p>
                </a>
              </li>
            </ul>
          </li>  
          
           <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loan Types
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=loan_types" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_loan_type" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Loan Type</p>
                </a>
              </li>
            </ul>
          </li>  

                <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loan Plans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=loan_plans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Plans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_loan_plan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Loan Plan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Clients
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=client_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=add_client" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=client_log" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Log</p>
                </a>
              </li>
            </ul>
          </li>
         
      <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Adminstrators
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=admin_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=new_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Admin</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="index.php?page=admin_log" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Log</p>
                </a>
              </li>
            </ul>
          </li>  
          
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>