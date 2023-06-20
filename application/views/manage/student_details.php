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
            <h1 class="m-0">Student Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Details</li>
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
                    <h3 class="card-title">Student Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Enrollment ID</th>
                                <td><?php echo isset($studentData->enrollment_id)?$studentData->enrollment_id:'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo isset($studentData->name)?$studentData->name:'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo isset($studentData->email)?$studentData->email:'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td><?php echo isset($studentData->contact)?$studentData->contact:'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo isset($studentData->address)?$studentData->address:'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Enrollment Date</th>
                                <td><?php echo isset($studentData->created_datetime)?date("d/m/Y",strtotime($studentData->created_datetime)):'NA'; ?></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td><?php echo isset($studentData->subject_name)?$studentData->subject_name:'NA'; ?></td>
                            </tr>
                            <tr> 
                                <th>Score</th>
                                <td>
                                  <table class="table table-bordered">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Mark</th>
                                    </tr>
                                    <?php 
                                      if(isset($studentScoreData) && !empty($studentScoreData)){ 
                                        foreach($studentScoreData as $scoreValue){ 
                                    ?>
                                    <tr>
                                        <td><?php echo isset($scoreValue->subject_name)?$scoreValue->subject_name:'NA'; ?></td>
                                        <td><?php echo isset($scoreValue->marks)?$scoreValue->marks:'NA'; ?></td>
                                    </tr>
                                    <?php } } ?>
                                  </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Active Status</th>
                                <td><?php echo $studentData->is_active==1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-warning">Inactive</span>'; ?> </td>
                            </tr>
                            
                        </table>
                        
                      </div>
                      
                      <div class="col-md-12">
                        <a href="<?php echo base_url('view-students'); ?>" class="btn btn-md btn-default">Back</a>
                      </div>
                    </div>
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
