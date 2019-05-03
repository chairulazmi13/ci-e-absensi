  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header content-justify">
      <h1>Dashboard</h1><small>Selamat datang <b><?=$this->session->userdata('p_nama');?></b></small>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header bg-green"><h4>QR Code</h4><small>Generate lalu arahkan pada mesin scanner</small></div>
            <div class="box-body">
              <div id="qr-code">
                <div class="callout callout-warning">
                  <h4>Info</h4>
                  <p>Lakukan Generate setiap kali melakukan Absensi</p>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button class="btn btn-default btn-flat btn-lg btn-block" id="Generate"><i class="fa fa-fw fa-qrcode"></i> Generate QR Code</button>
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
         // memanggila chart
         $('#Generate').click(function(event) {
          var id_pegawai = <?=$this->session->userdata('p_id_pegawai')?>;
          var nip = <?=$this->session->userdata('p_nip')?>;
            $.ajax({
                url:'<?=base_url("pegawai-generate-qrcode")?>',
                method:'POST',
                data: {id_pegawai: id_pegawai,nip:nip},
                dataType:'json',
                beforeSend:function(){
                    $('#Generate').html('Loading response... <i class="fa fa-circle-o-notch fa-spin fa-fw">');
                },
                success: function(data) {
                    console.log(data['img']);
                    $('#Generate').html('<i class="fa fa-fw fa-qrcode"></i> Generate QR Code');
                    $('#qr-code').fadeIn().html('<img class="img-responsive pad" alt="photo" style="margin: 0 auto;" src="<?=base_url()?>'+data['img']+'">');
                }
            });
          });

      });
    </script>
