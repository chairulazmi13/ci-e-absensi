  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?=base_url('pegawai-permohonan-cuti');?>" class="btn btn-default btn-lg"><i class="fa fa-fw fa-file-text-o"></i> Buat Permohonan cuti</a>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
        <div class="box box-warning">
              <div class="box-header">
                <h4>Daftar permohonan Cuti</h4>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tCuti" class="table table-hover display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No Cuti</th>
                      <th>Tanggal Pegajuan</th>
                      <th>Keterangan</th>
                      <th>Tanggal Cuti</th>
                      <th>Jumlah hari</th>
                      <th>Jenis Cuti</th>
                      <th>Status</th>
                      <th>File</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
      $(document).ready(function(){

        var table = $('#tCuti').DataTable({

                  "processing": true, //Feature control the processing indicator.
                  "serverSide": true, //Feature control DataTables' server-side processing mode.
                  "order": [], //Initial no order.

                  // Load data for the table's content from an Ajax source
                  "ajax": {
                      "url": "<?php echo site_url('pegawai_backend/Pegawaiinboxcuti/table_cuti')?>",
                      "type": "POST"
                  },

                  //Set column definition initialisation properties.
                  "columnDefs": [
                  {
                      "targets": [ 0 ], //first column / numbering column
                      "orderable": false, //set not orderable
                  },
                  ],

        });

        $('#tCuti_filter input').unbind();
        $('#tCuti_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
              table.search($(this).val()).draw();
            }
        });

      });
    </script>
