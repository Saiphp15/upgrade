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
            <h1 class="m-0">Add Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Subject</li>
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
                    <h3 class="card-title">Add Subject</h3>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo base_url('save-subject'); ?>" name="add_subject_form" id="add_subject_form" enctype="multipart/form-data">
                    <input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Subject Name..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Active Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inacive</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-success">Submit</button>
                        <a href="<?php echo base_url('view-subjects'); ?>" class="btn btn-md btn-default">Cancel</a>
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
