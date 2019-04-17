  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Pegawai
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box box-success">
            <div class="box-header"><h4>QR Code untuk absensi</h4></div>
            <div class="box-body">
              <div id="qr-code"></div>
            </div>
            <div class="box-footer">
              <button class="btn btn-success btn-lg btn-block" id="Generate"><i class="fa fa-fw fa-qrcode"></i> Generate QR Code</button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-primary">
           <div class="box-header with-border">
             <h4 class="box-title">Index Kehadiran Bulan ini</h4>
             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col-md-8">
                 <div class="chart-responsive">
                   <canvas id="chartKehadiran" height="150"></canvas>
                   <br>
                 </div>
                 <!-- ./chart-responsive -->
               </div>
             </div>
             <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Total Kehadiran<span class="pull-right text-green"> 20</span></a></li>
                <li><a href="#">Hari Kerja <span class="pull-right text-yellow"> 30</span></a>
                <li><a href="#">Presentase <span class="pull-right text-green"> 3%</span></a>
              </ul>
            </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
         $('#Generate').click(function(event) {

          var id_pegawai = <?=$this->session->userdata('p_id_pegawai')?>;
          var nip = <?=$this->session->userdata('p_nip')?>;
            $.ajax({
                url:'<?=base_url("pegawai-generate-qrcode")?>',
                method:'POST',
                data: {id_pegawai: id_pegawai,nip:nip},
                dataType:'json',
                beforeSend:function(){
                    $('#qr-code').html('<span class="text-info">Loading response...</span>');
                },
                success: function(data) {
                    console.log(data['img'])
                    $('#qr-code').fadeIn().html('<img class="img-responsive pad" alt="photo" style="margin: 0 auto;" src="<?=base_url()?>'+data['img']+'">');
                }
            });
          });

          var ctx = $('#chartKehadiran').get(0).getContext('2d');
          var option = {
            display : false
            }
          var data = {
                labels: ['Absen', 'Dinas', 'Cuti', 'Hadir'],
                datasets: [{
                    label: '# of Votes',
                    data: $.post('<?=base_url('pegawai_backend/pegawaidashboard/getIndexPerBulan')?>'),
                    backgroundColor: [
                        '#dd4b39',
                        '#00c0ef',
                        '#f39c12',
                        '#00a65a',
                    ],
                    borderColor: [
                        '#dd4b39',
                        '#00c0ef',
                        '#f39c12',
                        '#00a65a'
                    ],
                    borderWidth: 1
                }]
            }
          var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            option : option
        });
      });
    </script>
