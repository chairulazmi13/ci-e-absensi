  <style type="text/css">
    .fc-header-left, fc-header-center, fc-header-right {
      width: 100%;
      display: block;
    }
    .fc-event-time, .fc-event-title {
      padding: 0 1px;
      white-space: nowrap;
    }
    .fc-title {
      white-space: normal;
    }
  </style>
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.css" media="print">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kehadiran
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header"><h4>Info</h4></div>
            <div class="box-body">Semua ringkasan daftar <b>kehadiran</b>, <b>cuti</b>, atau selama <b>dinas di luar kota</b> bisa di dilihat disini</div>
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
               <div class="col-md-12f">
                 <div class="chart-responsive">
                   <canvas id="chartKehadiran" height="150"></canvas>
                   <br>
                 </div>
                 <!-- ./chart-responsive -->
               </div>
             </div>
             <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Total Kehadiran<span class="pull-right text-green kehadiran"> 20</span></a></li>
                <li><a href="#">Hari Kerja <span class="pull-right text-yellow harikerja"> 30</span></a>
                <li><a href="#">Presentase <span class="pull-right text-green presentase"> 3%</span></a>
              </ul>
            </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
         </div>
        </div>
        <div class="col-md-4">
          <div class="box box-success">
              <div id="calendar"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullCalendar.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        getChart();
        var calendar = $('#calendar').fullCalendar({
          disableDragging: false,
          editable: false,
          eventSources : [
            '<?=base_url("pegawai_backend/Pegawaikehadiran/getAbsensiFullcalendar")?>',
            '<?=base_url("pegawai_backend/Pegawaikehadiran/getCutiFullcalendar")?>',
            '<?=base_url("pegawai_backend/Pegawaikehadiran/getDinasFullcalendar")?>'
          ],
          displayEventTime: false
          });

          function getChart() {
              $.ajax({
                url: "<?=base_url('pegawai_backend/Pegawaidashboard/getIndexPerBulan')?>",
                method: "GET",
                dataType : "JSON",
                success: function(data) {
                  
                  var kehadiran = [];
                  var totalKehadiran;
                  var hariKerja;
                  var presentase;

                  for(var i in data) {
                     kehadiran.push(data[i].absen);
                     kehadiran.push(data[i].jumlah_dinas);
                     kehadiran.push(data[i].jumlah_cuti);
                     kehadiran.push(data[i].masuk);
                     totalKehadiran = data[i].kehadiran;
                     hariKerja = data[i].harikerja;
                     presentase = data[i].presentase;
                     console.log(totalKehadiran+hariKerja);
                  }

                  var chartdata = {
                    labels: ['Absen', 'Dinas', 'Cuti', 'Hadir'],
                    datasets : [
                      {
                        label: 'Index Kehadiran',
                        data: kehadiran,
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
                                '#00a65a',
                            ],
                            borderWidth: 0
                      }
                    ]
                  };

                  var ctx = $('#chartKehadiran').get(0).getContext('2d');

                  var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: chartdata
                  });

                  $('.kehadiran').html(totalKehadiran);
                  $('.harikerja').html(hariKerja);
                  $('.presentase').html(presentase);

                },
                error: function(data) {
                  console.log(data);
                }
            });
          } 
      });
    </script>
