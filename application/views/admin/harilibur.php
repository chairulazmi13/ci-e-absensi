     <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.css" media="print">
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Hari Libur
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu Absensi</a></li>
        <li class="active">Hari Libur</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">

    <!-- MODAL EDIT -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Edit</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label class="control-label">Tanggal</label>
                <input type="hidden" class="form-control pull-right id" name="id" id="id">
                <input type="text" class="form-control pull-right tanggal" name="tanggal" id="edit-tanggal">
              </div>
              <div class="form-group">
                <label class="control-label">Keterangan</label>
                <input type="text" class="form-control pull-right keterangan" name="keterangan" id="edit-keterangan">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success simpan-perubahan">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL EDIT -->

    <div class="row">
      <div class="col-md-3">
        <div class="box box-success">
          <div class="box-header"><h4>Input Hari Libur</h4></div>
          <div class="box-body">
            <form>
              <div class="form-group">
                <label class="control-label">Tanggal</label>
                <input type="text" class="form-control pull-right tanggal" name="tanggal" id="text-tanggal">
              </div>
              <div class="form-group">
                <label class="control-label">Keterangan</label>
                <input type="text" class="form-control pull-right keterangan" name="keterangan" id="text-keterangan">
              </div>
            </form>
          </div>
          <div class="box-footer">
            <div class="input-group">
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="button" class="btn btn-success simpan">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab-table" data-toggle="tab" aria-expanded="false">Tabel</a></li>
              <li class="active"><a href="#tab-calendar" data-toggle="tab" aria-expanded="true">Kalendar</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> Kalendar Hari Libur</li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab-table">
                <table class="table table-stripped display responsive nowrap" style="width:100%" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab-calendar">
                  <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="full-calendar"></div>
                  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
      </div>
    </div>


    </section>
    <!-- /.content -->

    <!-- ChartJS 1.0.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullCalendar.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        //Date picker
        $('.tanggal').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          orientation: "bottom auto"
        });

        var calendar = $('#full-calendar').fullCalendar({
          disableDragging: false,
          editable: true,
          events : '<?=base_url("harilibur/getFullcalendar")?>',
        });

        var table = $('.table').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("harilibur/getAllhariLibur")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "tanggal_libur", targets: 1 },
                    { data: "keterangan", targets: 2 },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 0,
                      render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                    },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 3,
                      data: "id",
                      render: function ( data, type, row, meta ) {
                                  return "<div class='btn-group'><button type='button' id='edit' class='btn btn-success' data='"+data+"'><i class='fa fa-edit'></i></button><button type='button' id='hapus' class='btn btn-danger' data='"+data+"'><i class='fa fa-trash'></i></button></div>";
                              }
                    }
                  ],
          });

        $('.simpan').click(function() {
          var tanggal = $('#text-tanggal').val();
          var keterangan = $('#text-keterangan').val();
          $.ajax({
            url: '<?=base_url("harilibur/insertHariLibur")?>',
            type: 'POST',
            dataType: 'json',
            timeout: 5000,
            data: {tanggal:tanggal, keterangan: keterangan},
            beforeSend: function () {
              $('.simpan').html('<i class="fa fa-fw fa-spinner"></i> ..Menyimpan');
            },
            success: function (data) {
              $('.simpan').html('Simpan');
              swal("disimpan",data['msg'],"success");
              resetForm();
              table.ajax.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              if (textStatus==='timeout') {
                $('.simpan').html('Simpan');
                resetForm();
                swal("timeout","waktu habis gagal menyimpan","error");
              } else {
                $('.simpan').html('Simpan');
                resetForm();
                swal("gagal","gagal menyimpan","error");
              }
            }
          });
        });

        // --- Tombol Edit, Delete ------
        // Simpan Edit
        $('.simpan-perubahan').click(function() {
          var id = $('#id').val();
          var tanggal = $('#edit-tanggal').val();
          var keterangan = $('#edit-keterangan').val();
          $.ajax({
            url: '<?=base_url("harilibur/updateHariLibur")?>',
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            data: {id:id,tanggal:tanggal,keterangan: keterangan},
            beforeSend: function () {
              $('.simpan-perubahan').html('<i class="fa fa-fw fa-spinner"></i> ..Menyimpan');
            },
            success: function (data) {
              $('.simpan-perubahan').html('Simpan perubahan');
              swal("disimpan",data['msg'],"success");
              resetForm();
              $('#ModalEdit').modal('hide');
              table.ajax.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              if (textStatus==='timeout') {
                $('.simpan-perubahan').html('Simpan perubahan');
                swal("timeout","waktu habis gagal menyimpan","error");
              } else {
                $('.simpan-perubahan').html('Simpan perubahan');
                swal(textStatus,errorThrown,"error");
              }
            }
          });
        });
        // Get Update
        $('.table').on('click', '#edit', function() {
          var id = $(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?=base_url("harilibur/getHariLibur")?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, tanggal_libur, keterangan){
                        $('#ModalEdit').modal('show');
                        $('#id').val(data.id);
                        $('#edit-tanggal').val(data.tanggal_libur);
                        $('#edit-keterangan').val(data.keterangan);
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  swal(textStatus,errorThrown,'error');
                  console.log(textStatus,' : ',errorThrown);
                }
            });
            return false;
        });
        // Delete
        $('.table').on('click', '#hapus', function() {
          var id = $(this).attr('data');
          swal({
            title: "Hapus",
            text: "hapus hari libur ini ?",
            icon: "warning",
            buttons: true,
            buttons: ["Kembali", "Hapus"],
          })
          .then((hapus) => {
            if (hapus) {
              $.ajax({
                url: '<?=base_url("harilibur/deleteHariLibur")?>',
                type: 'POST',
                dataType: 'json',
                data: {id: id},
                success:function (data) {
                  table.ajax.reload();
                  swal(data['msg'], {
                    icon: "warning",
                  });             
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  swal("gagal menghapus", {
                    icon: "error",
                  });
                }
              })
            }
          });
        });

        // -------------- FUNCTION -----------
        function resetForm() {
          $('.tanggal').val('');
          $('.keterangan').val('');
        }
      });
    </script>