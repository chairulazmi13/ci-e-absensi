<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Absensi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div id="msg"></div>
  <div class="lockscreen-logo">
    <h1> <div id="watch"></div></h1>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?=date('Y-m-d')?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url(); ?>assets/dist/img/barcode.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <div class="lockscreen-credentials">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Masukan QR COde" id="nip">
      </div>
    </div>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
<!--   <div class="help-block text-center">
    <div class="form-group">
      <div class="radio">
        <label>
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
        Masuk
        </label>
      </div>
      <div class="radio">
        <label>
        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
        Pulang
        </label>
      </div>
    </div>
  </div> -->

  <div class="text-center">
    <button type="button" class="btn bg-olive btn-flat margin">Absen</button>
  </div>
  <div class="lockscreen-footer text-center">
    <strong>Copyright &copy; 2019 <b><?=$this->loadpengaturan->getPengaturan('nama_perusahaan');?></b><br></strong> <?=$this->loadpengaturan->getPengaturan('alamat');?>
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#nip').focus();
      $('#nip').on('keypress',function(e) {
      if(e.which == 13) {
          insertAbsensi();
          $('#nip').val("");
          $('#nip').focus();
      }
    });

      // ------------------ FUNCTION ----------------
    function insertAbsensi(){ // insert absensi
          var qrcode = $('#nip').val();
          var tgl = getDate();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('frontAbsensi/insert')?>",
            dataType : "JSON",
            data : { qrcode:qrcode,tanggal:tgl},
            beforeSend:function(){  
                    $('#msg').html('<span class="text-info">Loading response...</span>');  
                },
            success: function(data) {
                    $('#msg').fadeIn().html('<span class="text-orange">'+data['msg']+'</span>');
                    setTimeout(function(){  
                      $('#msg').fadeOut("slow");  
                    }, 5000);
                }
            });
          return false;
        };

        function clock() {
          var now = new Date();
          var secs = ('0' + now.getSeconds()).slice(-2);
          var mins = ('0' + now.getMinutes()).slice(-2);
          var hr = now.getHours();
          var Time = hr + ":" + mins + ":" + secs;
          document.getElementById("watch").innerHTML = Time;
          requestAnimationFrame(clock);
        }

        function getDate() {
          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + dd + '-' + mm;
          return today;
        }

        requestAnimationFrame(clock);
    });
</script>
</body>
</html>
