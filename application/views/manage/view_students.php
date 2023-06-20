<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once('manage/common/header'); ?>
  </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include_once('manage/common/navbar'); ?>
  <?php include_once('manage/common/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Students</li>
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
                    <h3 class="card-title">All Students</h3>
                </div>
                <div class="card-body">
                    <table id="studentDatatableList" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(isset($studentData) && !empty($studentData)){
                                $i=1;
                                foreach ($studentData as $value) {
                                  $is_active = $value->is_active==1?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">Inactive</span>';
                                  
                            ?>
                            <tr>
                                <th><?php echo $i; ?></th>
                                <th><?php echo isset($value->name)?$value->name:'NA'; ?></th>
                                <th><?php echo isset($value->email)?$value->email:'NA'; ?></th>
                                <th><?php echo isset($value->contact)?$value->contact:'NA'; ?></th>
                                <th><?php echo isset($value->created_datetime)?date("d/m/Y",strtotime($value->created_datetime)):'NA'; ?></th>
                                <th><?php echo $is_active; ?></th>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" fdprocessedid="bkdm2o">Action</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" fdprocessedid="1ajo6r" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" >
                                            <a class="dropdown-item" href="<?php echo base_url('student-details/' . $value->id); ?>" >View</a>
                                            
																						<?php
																						if(isset($loggedInUsrData) && !empty($loggedInUsrData)){
																						if($loggedInUsrData->id==$value->created_by){ ?>
                                              <?php if ($value->is_active == 1) { ?>
                                                  <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('deactivate-student'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> Deactivate</a>
                                              <?php } else { ?>
                                                  <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('activate-student'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> Activate</a>
                                              <?php } ?>
                                              <a class="dropdown-item" href="<?php echo base_url('edit-student/' . $value->id); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                              <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('delete-student'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i>Delete </a>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
  <?php include_once('manage/common/footer'); ?>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/data-table-page.js"></script>
</body>
</html>
