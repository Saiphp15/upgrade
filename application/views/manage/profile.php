<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('manage/common/header'); ?>
  </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('manage/common/navbar'); ?>
  <?php $this->load->view('manage/common/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo base_url('update-profile'); ?>" name="update_user_form" id="update_user_form" enctype="multipart/form-data">
                    <input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo isset($userData->id)?$userData->id:''; ?>">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" value="<?php echo isset($userData->name)?$userData->name:''; ?>" placeholder="Enter Name..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" value="<?php echo isset($userData->email)?$userData->email:''; ?>" placeholder="Enter Email..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact_no" id="contact_no" value="<?php echo isset($userData->contact_no)?$userData->contact_no:''; ?>" placeholder="Enter Contact Number..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Enter Address..."><?php echo isset($userData->address)?$userData->address:''; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Update Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <?php if (isset($userData->profile_picture) && !empty($userData->profile_picture)) { ?>
                                <img src="<?php echo base_url('uploads/user_profile_picture/'); ?>/<?php echo isset($userData->profile_picture) ? $userData->profile_picture : ''; ?>" alt="Profile image" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                            <?php } else { ?>
                                <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" alt="Profile image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-success">Submit</button>
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-md btn-default">Cancel</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-12 -->
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <?php $this->load->view('manage/common/footer'); ?>
</body>
</html>
