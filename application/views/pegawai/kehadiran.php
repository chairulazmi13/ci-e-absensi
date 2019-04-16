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
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header"><h4>Info</h4></div>
            <div class="box-body">Semua ringkasan daftar <b>kehadiran</b>, <b>cuti</b>, atau selama <b>dinas di luar kota</b> bisa di dilihat disini</div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-success">
              <div id="calendar"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullCalendar.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
          disableDragging: false,
          editable: false,
          eventSources : [
            '<?=base_url("pegawai_backend/pegawaikehadiran/getAbsensiFullcalendar")?>',
            '<?=base_url("pegawai_backend/pegawaikehadiran/getCutiFullcalendar")?>'
          ]
        });
      });
    </script>
