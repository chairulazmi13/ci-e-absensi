
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Dinas Luar kota
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Dinas luar kota</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->

    <!-- Modal Insert  -->
    <div class="modal fade" id="modalInsert" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              <h4 class="modal-title">Dinas Luar kota</h4>
          </div>
          <div class="modal-body form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Pegawai</label>
              <div class="col-sm-10">
                <select class="form-control select2-single" name="id_pegawai" id="tPegawai">
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar-minus-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right tanggalMulai" name="tgl_mulai" id="tanggalMulai">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sampai Tanggal</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar-plus-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right tanggalAkhir" name="tgl_selesai" id="tanggalAkhir">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tempat dinas</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-map"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tempat" id="tempat">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" rows="5" id="tKeterangan"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary simpanData" id="simpanData">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End ModalAdd  -->

    <!-- Modal Edit  -->
    <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">Edit Cuti Pegawai</h4>
          </div>
          <div class="modal-body form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="hidden" name="id_dinas" id="edit_id_dinas">
                  <input type="hidden" name="id_pegawai" id="edit_id_pegawai">
                  <input type="hidden" name="tanggal_pengajuan" id="edit_tgl_pengajuan">
                  <input type="text" class="form-control pull-right tanggalMulai" name="edit_tanggalMulai" id="edit_tanggalMulai">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sampai Tanggal</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right tanggalAkhir" name="edit_tanggalAkhir" id="edit_tanggalAkhir">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tempat dinas</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-map"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="edit_tempat" id="edit_tempat">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" rows="10" id="edit_tKeterangan"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary simpanData" id="simpanEdit">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Edit  -->

    <!--Modal Upload-->
        <div class="modal modal-default fade" id="ModalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Upload Dokumen</h4>
                    </div>
                    <form class="form-horizontal" id="submit">
                    <div class="modal-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">File </label>
                      <input type="hidden" name="upload_id" id="upload_id">
                      <input type="file" name="file" id="file">
                      <div class="col-sm-10">
                        <p class="help-block">Bukti Seperti surat perjalanan Dinas</p>
                        <p class="help-block">JPG|PNG|PDF</p>
                      </div>
                      <div class="progress">
                          <div class="bar"></div >
                          <div class="percent">0%</div >
                      </div>
                      <div id="status"></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="btn-upload">Upload</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End Modal Upload-->

    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Filter Data</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <!-- Date -->
                <div class="form-group">
                <label>Dari Tanggal</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right filterDate fromDate" id="fromDate">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                </div>
                <div class="col-md-6">
                   <!-- Date range -->
                  <div class="form-group">
                    <label>Sampai Tanggal</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right filterDate fromDate" id="toDate">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
              </div>

            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-success pull-right" id="btn-filterdate"><i class="fa fa-filter"></i> Filter</button>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsert"><i class="fa fa-pencil"></i> Buat dinas pegawai</button>
              </div>
            <!-- /.box-body -->
          </div>
      </div>
      <div class="col-xs-12 col-md-12">
        <div class="box box-table">
              <div class="box-header">
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tDinas" class="table table-hover display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Pegawai</th>
                      <th>Tanggal Dibuat</th>
                      <th>Tanggal Dinas</th>
                      <th>Jumlah hari</th>
                      <th>Tempat</th>
                      <th>File</th>
                      <th>Action</th>
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
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
  $('.box-table').hide();
  $(document).ready(function(){
      //Date Filter
      $('.filterDate').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom auto"
      });

      $('#btn-filterdate').on('click',function(event) {
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        if (fromDate == '') {
          swal('peringatan','tanggal fromDate harus diisi','warning');
        } else if (toDate == '') {
          swal('peringatan','tanggal toDate harus diisi','warning');
        } else {
        $('.box-table').fadeIn('slow');
        tableDinas(fromDate,toDate);
        }
      });

    //Date picker
    $('.tanggalMulai').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      orientation: "bottom auto"
    });
    // $('#tanggalMulai').datepicker('setDate', new Date());
    $('.tanggalAkhir').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      orientation: "bottom auto"
    });
    $('#tanggalAkhir').on('change', function(event) {
      var awal = $('#tanggalMulai').val();
      var akhir = $('#tanggalAkhir').val();

      if (akhir < awal) {
        $('#simpanData').hide();
      } else {
        $('#simpanData').show();
      }
    });

    $('#toDate').on('change', function(event) {
      if (toDate < fromDate) {
        $('#btn-filterdate').hide();
      } else {
        $('#btn-filterdate').show();
      }
    });

    $('#tPegawai').select2({
         dropdownParent: $("#modalInsert"),
         minimumInputLength: 3,
         allowClear: true,
         placeholder: 'Masukan Nama Pegawai',
         width: '100%',
         ajax: {
            dataType: 'json',
            url: '<?=base_url("User/select2")?>',
            delay: 800,
            data: function(params) {
              return {
                nama: params.term
              }
            },
            processResults: function (data, page) {
            return {
              results: data
            };
          },
        }
    }).on('select2:select', function () {
       var data = $("#tnip option:selected").text();
       // $('#form-username').slideDown('slow');
    });

    // ------ tombon simpan dinas (form dinas) --------
    $('#simpanData').click(function(event) {
      var id_pegawai = $('#tPegawai').val();
      var tanggalMulai = $('#tanggalMulai').val();
      var tanggalAkhir = $('#tanggalAkhir').val();
      var tempat = $('#tempat').val();
      var keterangan = $('#tKeterangan').val();

      $.ajax({
        url: '<?=base_url("Formdinas/insert")?>',
        type: 'POST',
        dataType: 'json',
        data: {
          id_pegawai:id_pegawai,
          tgl_mulai:tanggalMulai,
          tgl_selesai:tanggalAkhir,
          tempat:tempat,
          keterangan:keterangan
        },
        success : function (data) {
          if (data["status"] == 'success') {
              tableDinas(tanggalMulai,tanggalAkhir);
              clearForm();
              $('#modalInsert').modal('hide');
              swal( "Simpan",data["msg"], "success");
            }  else {
              swal( "Gagal",data["msg"], "danger");
            }
        }
      })

    });

    // --------- Tombol show form upload ------------
    $('#tDinas').on('click','#upload',function(){
      var id=$(this).attr('data');
      $('#ModalUpload').modal('show');
      $('#upload_id').val(id);
    });
    // ----------------------------------------------

    // ------ tombol delete -------------------------
    $('#tDinas').on('click','#hapus',function(){
      var id = $(this).attr('data');
      var fromDate = $('#fromDate').val();
      var toDate = $('#toDate').val();
      swal({
        title: "Hapus ?",
        text: "Data dinas yang dihapus akan permanen",
        icon: "warning",
        buttons: true,
        buttons: ["Kembali", "Hapus"],
      })
      .then((hapus) => {
        if (hapus) {
          $.ajax({
            url: '<?=base_url("Formdinas/hapusDinas")?>',
            type: 'POST',
            dataType: 'json',
            data: {id_dinas: id},
            success : function (data) {
              tableDinas(fromDate,toDate);
              swal(data['msg'], {
                icon: "error",
              });
            }
          });
        }
      });
    });

    // ------- tombol form edit ---------------------------
    $('#tDinas').on('click','#edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('Formdinas/getDinasByID')?>",
                dataType : "JSON",
                data : {id_dinas:id},
                success: function(data){
                    $.each(data,function(id_dinas, id_pegawai,nama,tanggal_pengajuan, tanggal_mulai, tanggal_selesai,tempat,keterangan){
                        $('#ModalEdit').modal('show');
                        $('#edit_id_dinas').val(data.id_dinas);
                        $('#edit_id_pegawai').val(data.id_pegawai);
                        $('#edit_tgl_pengajuan').val(data.tanggal_pengajuan);
                        $('#edit_tanggalMulai').datepicker('setDate', new Date(data.tanggal_mulai));
                        $('#edit_tanggalAkhir').datepicker('setDate', new Date(data.tanggal_selesai));
                        $('#edit_tempat').val(data.tempat)
                        $('#edit_tKeterangan').val(data.keterangan);
                    });
                }
            });
            return false;
    });
    //  ------- tombol simpan edit -------------------------
    $('#simpanEdit').click(function(event) {
      var id = $('#edit_id_dinas').val();
      var id_pegawai = $('#edit_id_pegawai').val();
      var tanggalPengajuan = $('#edit_tgl_pengajuan').val();
      var tanggalMulai = $('#edit_tanggalMulai').val();
      var tanggalAkhir = $('#edit_tanggalAkhir').val();
      var tempat = $('#edit_tempat').val();
      var keterangan = $('#edit_tKeterangan').val();
      var fromDate = $('#fromDate').val();
      var toDate = $('#toDate').val();

      $.ajax({
        url: '<?=base_url("Formdinas/updateDinas")?>',
        type: 'POST',
        dataType: 'json',
        data: {
          id_dinas:id,
          id_pegawai:id_pegawai,
          tgl_pengajuan: tanggalPengajuan,
          tgl_mulai:tanggalMulai,
          tgl_selesai:tanggalAkhir,
          tempat:tempat,
          keterangan:keterangan
        },
        success : function (data) {
          if (data["status"] == 'success') {
              tableDinas(fromDate,toDate);
              $('#ModalEdit').modal('hide');
              swal( "Simpan",data["msg"], "success");
            }  else {
              swal( "Gagal",data["msg"], "danger");
            }
        }
      })

    });

    // ------- tombol simpan upload -----------------
    $('form').submit(function(e){
		    e.preventDefault();

            var bar = $('.bar');
            var percent = $('.percent');
            var status = $('#status');
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();

                  $.ajax({
                     url:'<?=base_url("Formdinas/uploadFiles")?>',
                     type:'POST',
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache: false,
                     beforeSend: function() {
                          status.empty();
                          var percentVal = '0%';
                          bar.width(percentVal);
                          percent.html(percentVal);
                      },
                      uploadProgress: function(event, position, total, percentComplete) {
                          var percentVal = percentComplete + '%';
                          bar.width(percentVal);
                          percent.html(percentVal);
                      },
                      complete: function(xhr) {
                          status.html(xhr.responseText);
                      },
                      success: function(data) {
                          tableDinas(fromDate,toDate);
                          alert(data['msg']);
                          swal( "Simpan",data["msg"], "success");
                      },
                     resetForm: true
                 });
                 return false;
            });

    // ------------------function--------------------------------------
    function tableDinas(fromDate,toDate) {
            var table = $('#tDinas').DataTable({
            destroy:true,
            processing : true,
            ajax: {
              type  : 'ajax',
              url: '<?=base_url("Formdinas/getDinasByDate/")?>'+fromDate+'/'+toDate,
              dataType : 'json',
            },
            columnDefs: [
                    {
                      searchable: false,
                      orderable : false,
                      targets: 0,
                      render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                    },
                    { data: "nama", targets: 1 },
                    { data: "tanggal_pengajuan", targets: 2 },
                    {
                      targets: 3,
                      data:null,
                      render: function ( data, type, row, meta ) {
                                  return row.tanggal_mulai+' sampai '+row.tanggal_selesai;
                              }
                    },
                    { data: "jumlah_hari", targets: 4 },
                    { data: "tempat", targets: 5 },
                    {
                      data: "file",
                      targets: 6 ,
                      render: function ( data, type, row, meta ) {
                        if (data == null) {
                          var a = 'Belum upload';
                        } else {
                          var a = '<a href="<?=base_url('Formdinas/download/')?>'+data+'">Download</a>';
                        }
                        return a;
                      }
                    },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 7,
                      data:'id_dinas',
                      render: function ( data, type, row, meta ) {
                                    var a = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm" id="upload" data="'+data+'"><span class="glyphicon glyphicon-upload"></span> Upload</button><button type="button" class="btn btn-default btn-sm" id="edit" data="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button><button type="button" class="btn btn-danger btn-sm" id="hapus" data="'+data+'"><span class="glyphicon glyphicon-trash" id="hapus"></span></button>';
                                  return a;
                              }
                    },
                  ],
          });
    }

    function clearForm() {
      $('#tanggal_mulai').val();
      $('#tanggal_selesai').val();
      $('#tempat').val();
      $('#keterangan').val();
    }
  });
  </script>
