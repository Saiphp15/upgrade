<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- LoggedIn User Short Info Start -->
            <div class="media">
              <?php if (isset($userData->profile_picture) && !empty($userData->profile_picture)) { ?>
                  <img src="<?php echo base_url('uploads/user_profile_picture/'); ?>/<?php echo isset($userData->profile_picture) ? $userData->profile_picture : ''; ?>" alt="Profile image" class="img-size-50 mr-3 img-circle" >
              <?php } else { ?>
                  <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" alt="Profile image | Default" class="img-size-50 mr-3 img-circle" >
              <?php } ?>
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo isset($loggedInUsrData->name)?$loggedInUsrData->name:'NA'; ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm"><?php echo isset($loggedInUsrData->designation)?$loggedInUsrData->designation:'NA'; ?></p>
              </div>
            </div>
            <!-- LoggedIn User Short Info End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('profile'); ?>" class="dropdown-item dropdown-footer">Profile</a>
          <a href="<?php echo base_url('logout'); ?>" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
