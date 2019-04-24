<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Absensi
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-user"></i> Absensi</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
  <!-- Your Page Content Here -->
    <div class="row">
      <div class="col-md-4" id="absensi" role="dialog">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Absensi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <form role="form" method="post" id="form-absensi"> -->
              <div class="box-body">
                <div class="form-group">
                  <label>NIP</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-barcode"></i>
                    </div>
                    <input type="text" name="nip" class="form-control pull-right" id="nip" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tanggal" class="form-control pull-right" id="tanggal" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="1" class="status" checked="">
                      Masuk
                    </label>
                    <label>
                      <input type="radio" name="status"  value="2" class="status">
                      Keluar
                    </label>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <!-- <button type="button" class="btn btn-primary" id="simpan">Submit</button> -->
                <div class="btn-group">
                  <button class="btn btn-default-flat" id="reloadData"><i class="fa fa-refresh"></i> Reload</button>
                  <button class="btn btn-default-flat" id="tambahData"><i class="fa fa-pencil"></i> Submit</button>
                </div>
              </div>
            <!-- </form> -->
          </div>
      </div>
      <div class="col-md-8" id="table-content">
        <div class="box">
              <div class="box-header">
                <div id="notif"></div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tAbsensi" class="table table-striped display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>in</th>
                      <th>out</th>
                      <th>keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>in</th>
                      <th>out</th>
                      <th>keterangan</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(document).ready(function(){

    var table = $('#tAbsensi').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("absensitoday")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "nama", targets: 1 },
                    { data: "tanggal", targets: 2},
                    { data: "jam_masuk", targets: 3},
                    { data: "jam_pulang", targets: 4 },
                    { data: "keterangan", targets: 5 },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 0,
                      render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                    },
                  ],
          });
    //Date picker
    $('#tanggal').datepicker({
      format: 'yyyy/mm/dd',
      autoclose: true,
      orientation: "bottom auto"
    });
    $('#tanggal').datepicker('setDate', new Date());

    // Nip ENTER
    $('#nip').focus();
    $('#nip').on('keypress',function(e) {
      if(e.which == 13) {
          insertAbsensi();
          $('#nip').val("");
          $('#nip').focus();
      }
    });

    // Reload
    $('#reloadData').on('click',function(){
          table.ajax.reload();
    });

    $('#tambahData').on('click',function(){
          insertAbsensi();
          $('#nip').val("");
          $('#nip').focus();
    });

    // ----------------- FUNCTION --------------------- //
    function insertAbsensi(){ // insert absensi
      var nip = $('#nip').val();
      var tanggal = $('#tanggal').val();
      var status = $('.status:checked').val();
      var dt = new Date();
      var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('absensi')?>",
        dataType : "JSON",
        data : {
          nip:nip,
          tanggal:tanggal,
          status:status,
          time:time
        },
        success: function(data){
            $('#notif').html(data['notif']);
            
            table.ajax.reload();
          }
      	});
      return false;
    };
  });
</script>
