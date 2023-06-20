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
            <h1 class="m-0">Edit Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Student</li>
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
                    <h3 class="card-title">Edit Student</h3>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo base_url('update-student'); ?>" name="edit_student_form" id="edit_student_form" enctype="multipart/form-data">
                    <input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="student_id" value="<?php echo isset($studentData->id)?$studentData->id:''; ?>">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" value="<?php echo isset($studentData->name)?$studentData->name:''; ?>" placeholder="Enter Student Name..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" value="<?php echo isset($studentData->email)?$studentData->email:''; ?>" placeholder="Enter Student Email" class="form-control" >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" id="contact" value="<?php echo isset($studentData->contact)?$studentData->contact:''; ?>" placeholder="Enter Contact Number..." class="form-control">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Enter Address..."><?php echo isset($studentData->address)?$studentData->address:''; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Subject</label>
                            <select name="subject_id" id="subject_id" class="form-control">
                              <option value="">Select Subject</option>
                              <?php 
                              if(isset($subjectData) && !empty($subjectData)){
                                foreach ($subjectData as $value) {
                                  $selected = '';
                                  if($value->id==$studentData->subject_id){
                                    $selected = 'selected';
                                  }
                              ?>
                              <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo $value->name; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Active Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" <?php if($studentData->is_active==1){echo'selected';} ?>>Active</option>
                                <option value="2" <?php if($studentData->is_active==2){echo'selected';} ?>>Inacive</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-md btn-success">Update</button>
                        <a href="<?php echo base_url('view-students'); ?>" class="btn btn-md btn-default">Cancel</a>
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
