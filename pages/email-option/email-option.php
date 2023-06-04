<!DOCTYPE html>
<html lang="en">
<?php
    include '../header_footer/header.php';
    ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <?php
    include '../sidebar_navbar.php';
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SMS and Email Settings</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
            include 'add-modal.php';  
            include '../header_footer/scripts.php';
            include 'function.php'; 
            ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
      <div class="card">
        <div class="card-body">
            <?php
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT e_option_id, username, password, enabled FROM tbl_email_option";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($e_option_id, $username, $password, $enabled);
            $qry->store_result();
            $qry->fetch();
            if ($qry->num_rows==0){
                echo "<div class='alert alert-warning'>
                    <i class='icon fas fa-info'></i>To enable Email Support please insert your GMAIL Username and Password. <a href='#' data-toggle='modal' data-target='#add-email'>Click here to add.</a> This Email Support is powered by PHP Mailer. In order to send Email using your gmail account, please enable POP and IMAP <a target='_blank' href='https://mail.google.com/mail/u/0/#settings/fwdandpop'>here.</a> And turn ON the Less Secure apps <a target='_blank' href='https://myaccount.google.com/lesssecureapps?gar=1&pli=1&rapt=AEjHL4OmefMsYc5NQQWHkzaQR0M6H6__7bg1dTAiuP8vqeFtfQscAQrTM7mwLr6_652vPx8YFKF4dSZOG9XHdEVV2pcgIuDYGg'>here.</a> For full documentation of PHPMailer please visit <a target='_blank' href='https://github.com/PHPMailer/PHPMailer'>github.com/PHPMailer/PHPMailer</a>
                    </div>";
            }
            else {
                if ($enabled == 1){
                    $enabled_txt = 'Enabled';
                }
                else {
                    $enabled_txt = 'Disabled';
                }
                echo "
                <div class='alert alert-warning'>
                    <i class='icon fas fa-info'></i>This Email Support is powered by PHP Mailer. In order to send Email using your gmail account, please enable POP and IMAP <a target='_blank' href='https://mail.google.com/mail/u/0/#settings/fwdandpop'>here.</a> And turn ON the Less Secure apps <a target='_blank' href='https://myaccount.google.com/lesssecureapps?gar=1&pli=1&rapt=AEjHL4OmefMsYc5NQQWHkzaQR0M6H6__7bg1dTAiuP8vqeFtfQscAQrTM7mwLr6_652vPx8YFKF4dSZOG9XHdEVV2pcgIuDYGg'>here.</a> For full documentation of PHPMailer please visit <a target='_blank' href='https://github.com/PHPMailer/PHPMailer'>github.com/PHPMailer/PHPMailer</a>
                    </div>
                <table id='#' class='table table-striped'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <button class='btn btn-flat btn-success btn-xs' data-toggle='modal' data-target='#edit-email'><i class='nav-  icon fas fa-pen'></i></button> 
                        </td>
                        <td>$username</td>
                        <td>$password</td>
                        <td>$enabled_txt</td>
                        </tr>
                    
                </tbody>
                </table>";
                include 'edit-email.php';
            }
            ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
        
        include '../header_footer/footer.php';  
    ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
    include '../header_footer/scripts.php';
    ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
