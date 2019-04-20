
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Formulir Cuti
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> cuti</a></li>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">Cuti Pegawai</h4>
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
                    <i class="fa fa-calendar"></i>
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
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right tanggalAkhir" name="tgl_selesai" id="tanggalAkhir">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Cuti</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <select class="selectpicker form-control" id="jenisCuti">
                    <option value="">-- Pilih --</option>
                    <option value="sakit">Cuti Sakit</option>
                    <option value="tahunan">Cuti Tahunan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" rows="10" id="tKeterangan"></textarea>
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
                  <input type="hidden" name="id_cuti" id="id_cuti">
                  <input type="hidden" name="edit_id_pegawai" id="edit_id_pegawai">
                  <input type="hidden" name="edit_tanggal_pengajuan" id="edit_tanggal_pengajuan">
                  <input type="hidden" name="edit_approve" id="edit_approve">
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
              <label class="col-sm-2 control-label">Jenis Cuti</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <select class="selectpicker form-control" id="edit_jenisCuti">
                    <option value="" id="valJenisCuti" selected>-- Pilih --</option>
                    <option value="sakit">Cuti Sakit</option>
                    <option value="tahunan">Cuti Tahunan</option>
                  </select>
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
                    <form enctype="multipart/form-data" class="form-horizontal" id="submit">
                    <div class="modal-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">File </label>
                      <input type="hidden" name="upload_id" id="upload_id">
                      <input type="file" name="file" id="file">
                      <div class="col-sm-10">
                        <p class="help-block">Bukti Seperti surat dokter bila sakit (opsional)</p>
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
      <div class="col-xs-12">
        <div class="box">
              <div class="box-header">
                <div class="btn-group">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsert"><i class="fa fa-pencil"></i> Input Cuti Pegawai</button>
                <button type="button" class="btn btn-default" id="reloadData"><i class="fa fa-refresh"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tCuti" class="table table-hover display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nomor Cuti</th>
                      <th>Status</th>
                      <th>Nama Pegawai</th>
                      <th>Tanggal Pegajuan</th>
                      <th>Tanggal Cuti</th>
                      <th>Jumlah hari</th>
                      <th>Jenis Cuti</th>
                      <th>Keterangan</th>
                      <th>File</th>
                      <th>Approval</th>
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
  $(document).ready(function(){
        var table = $('#tCuti').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("formCuti/getAllCuti")?>",
              dataType : "json"
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
                    { data: "id_cuti", targets: 1 },
                    {
                      targets: 2 ,
                      data: null,
                      render: function ( data, type, row, meta ) {
                                  if (row.approve == 1) {
                                    var a = '<span class="label label-success">Disetujui oleh</span> <b>'+row.approve_by+'</b>';
                                  } else if (row.approve == 0) {
                                    var a = '<span class="label label-warning">Pending</span>';
                                  } else {
                                    var a = '<span class="label label-danger">Ditolak</span> <b>'+row.approve_by+'</b>';
                                  }
                                  return a;
                              }
                    },
                    { data: "nama", targets: 3 },
                    { data: "tanggal_pengajuan", targets: 4 },
                    {
                      targets: 5,
                      data:null,
                      render: function ( data, type, row, meta ) {
                                  return row.tanggal_mulai+' sampai '+row.tanggal_selesai;
                              }
                    },
                    { data: "jumlah_hari", targets: 6 },
                    { data: "jenis_cuti", targets: 7 },
                    { data: "keterangan", targets: 8 },
                    
                    {
                      data: "file",
                      targets: 9 ,
                      render: function ( data, type, row, meta ) {
                        if (data == null) {
                          var a = 'Belum upload';
                        } else {
                          var a = '<a href="<?=base_url("formCuti/download/")?>'+data+'">Download</a>';
                        }
                        return a;
                      }
                    },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 10,
                      data: null,
                      render: function ( data, type, row, meta ) {
                                  if (row.approve == 1) {
                                    var a = '<button type="button" class="btn btn-warning btn-sm" id="btn-pending" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-remove"></span> Batal</button>';
                                  } else {
                                    var a = '<div class="btn-group"><button type="button" class="btn btn-success btn-sm" id="btn-approve" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-ok"></span></button> <button type="button" class="btn btn-danger btn-sm" id="btn-decline" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-remove"></span></button>';
                                  }
                                  return a;
                              }
                    },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 11,
                      data:null,
                      render: function ( data, type, row, meta ) {
                                    if (row.approve == 1) {
                                      var a = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm" id="upload" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-upload"></span> Upload</button><button type="button" class="btn btn-default btn-sm" id="hapus" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-trash" id="hapus"></span></button>';
                                    } else {
                                      var a = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm" id="upload" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-upload"></span> Upload</button><button type="button" class="btn btn-default btn-sm" id="edit" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-pencil"></span></button><button type="button" class="btn btn-default btn-sm" id="hapus" data="'+row.id_cuti+'"><span class="glyphicon glyphicon-trash" id="hapus"></span></button>';
                                    }
                                  return a;
                              }
                    },
                  ],
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
    $('#edit_tanggalAkhir').on('change', function(event) {
      var awal = $('#edit_tanggalMulai').val();
      var akhir = $('#edit_tanggalAkhir').val();

      if (akhir < awal) {
        $('#simpanEdit').hide();
      } else {
        $('#simpanEdit').show();
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

    // ------ tombon simpan cuti (form cuti) --------
    $('#simpanData').click(function(event) {
      var id_pegawai = $('#tPegawai').val();
      var tanggalMulai = $('#tanggalMulai').val();
      var tanggalAkhir = $('#tanggalAkhir').val();
      var jenisCuti = $('#jenisCuti').val();
      var keterangan = $('#tKeterangan').val();

      $.ajax({
        url: '<?=base_url("formCuti/insert")?>',
        type: 'POST',
        dataType: 'json',
        data: {
          id_pegawai:id_pegawai,
          tgl_mulai:tanggalMulai,
          tgl_selesai:tanggalAkhir,
          jenis_cuti:jenisCuti,
          keterangan:keterangan
        },
        success : function (data) {
          if (data["status"] == 'success') {
              table.ajax.reload();
              $('#modalInsert').modal('hide');
              swal( "Simpan",data["msg"], "success");
            }  else {
              swal( "Gagal",data["msg"], "danger");
            }
        }
      })

    });

    // -------tombol approve dan decline-------------
    $('#tCuti').on('click','#btn-approve',function(){
      var id = $(this).attr('data');
      swal({
        title: "Disetujui ?",
        text: "Pengajuan cuti ini akan di setujui",
        icon: "warning",
        buttons: true,
        buttons: ["Kembali", "Setujui"],
      })
      .then((approve) => {
        if (approve) {
          $.ajax({
            url: '<?=base_url("formCuti/statusApproval")?>',
            type: 'POST',
            dataType: 'json',
            data: {id_cuti: id,approve:'1'},
            success : function (data) {
              table.ajax.reload();
              if (data['status'] == 'error') {
                swal(data['msg'], {
                  icon: "warning",
                });
              } else if (data['status'] == 'success'){
                swal(data['msg'], {
                  icon: "success",
                });
              }
            }
          });
        }
      });
    });

    $('#tCuti').on('click','#btn-decline',function(){
      var id = $(this).attr('data');
      swal({
        title: "Ditolak ?",
        text: "Pengajuan cuti ini akan di tolak",
        icon: "warning",
        buttons: true,
        buttons: ["Kembali", "Tolak"],
      })
      .then((decline) => {
        if (decline) {
          $.ajax({
            url: '<?=base_url("formCuti/statusApproval")?>',
            type: 'POST',
            dataType: 'json',
            data: {id_cuti: id,approve:'2'},
            success : function (data) {
              table.ajax.reload();
              swal(data['msg'], {
                icon: "error",
              });
            }
          });
        }
      });
    });

    $('#tCuti').on('click','#btn-pending',function(){
      var id = $(this).attr('data');
      swal({
        title: "Batal ?",
        text: "Pengajuan cuti ini Disetujui akan di batalkan, status Pending",
        icon: "warning",
        buttons: true,
        buttons: ["Kembali", "Batalkan"],
      })
      .then((pending) => {
        if (pending) {
          $.ajax({
            url: '<?=base_url("formCuti/statusApproval")?>',
            type: 'POST',
            dataType: 'json',
            data: {id_cuti: id,approve:'0'},
            success : function (data) {
              table.ajax.reload();
              swal(data['msg'], {
                icon: "error",
              });
            }
          });
        }
      });
    });
    // ----------------------------------------------

    // --------- Tombol show form upload ------------
    $('#tCuti').on('click','#upload',function(){
      var id=$(this).attr('data');
      $('#ModalUpload').modal('show');
      $('#upload_id').val(id);
    });
    // ----------------------------------------------

    // ------ tombol delete -------------------------
    $('#tCuti').on('click','#hapus',function(){
      var id = $(this).attr('data');
      swal({
        title: "Hapus ?",
        text: "Pengajuan cuti yang dihapus akan permanen",
        icon: "warning",
        buttons: true,
        buttons: ["Kembali", "Hapus"],
      })
      .then((hapus) => {
        if (hapus) {
          $.ajax({
            url: '<?=base_url("formCuti/hapusCuti")?>',
            type: 'POST',
            dataType: 'json',
            data: {id_cuti: id},
            success : function (data) {
              table.ajax.reload();
              swal(data['msg'], {
                icon: "error",
              });
            }
          });
        }
      });
    });
    // ------- tombol form edit ---------------------------
    $('#tCuti').on('click','#edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('formCuti/getCuti')?>",
                dataType : "JSON",
                data : {id_cuti:id},
                success: function(data){
                    $.each(data,function(id_cuti,jenis_cuti,id_pegawai,nama,tanggal_pengajuan, tanggal_mulai, tanggal_selesai, keterangan,approve){
                        $('#ModalEdit').modal('show');
                        $('#id_cuti').val(data.id_cuti);
                        $('#edit_id_pegawai').val(data.id_pegawai);
                        $('#edit_tanggal_pengajuan').val(data.tanggal_pengajuan);
                        $('#edit_tanggalMulai').datepicker('setDate', new Date(data.tanggal_mulai));
                        $('#edit_tanggalAkhir').datepicker('setDate', new Date(data.tanggal_selesai));
                        $('#valJenisCuti').val(data.jenis_cuti);
                        $('#edit_tKeterangan').val(data.keterangan);
                        $('#edit_approve').val(data.approve);
                    });
                }
            });
            return false;
    });
    //  ------- tombol simpan edit -------------------------
    $('#simpanEdit').click(function(event) {
      var id = $('#id_cuti').val();
      var pegawai = $('#edit_id_pegawai').val();
      var tanggalPengajuan = $('#edit_tanggal_pengajuan').val();
      var tanggalMulai = $('#edit_tanggalMulai').val();
      var tanggalAkhir = $('#edit_tanggalAkhir').val();
      var keterangan = $('#edit_tKeterangan').val();
      var approve = $('#edit_approve').val();

      $.ajax({
        url: '<?=base_url("formCuti/updateCuti")?>',
        type: 'POST',
        dataType: 'json',
        data: {
          id_cuti:id,
          id_pegawai:pegawai,
          tgl_pengajuan:tanggalPengajuan,
          tgl_mulai:tanggalMulai,
          tgl_selesai:tanggalAkhir,
          keterangan:keterangan,
          approve:approve
        },
        success : function (data) {
          if (data["status"] == 'success') {
              table.ajax.reload();
              $('#ModalEdit').modal('hide');
              swal( "Simpan",data["msg"], "success");
            }  else {
              swal( "Gagal",data["msg"], "danger");
            }
        }
      })

    });

    // ------- tombol simpan upload -----------------
    $('#submit').submit(function(e){
                  $.ajax({
                     url:'<?=base_url("formCuti/uploadFiles")?>',
                     type:'POST',
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                     success: function(data) {
                          table.ajax.reload();
                          swal( "Simpan",data, "warning");
                      },
                     resetForm: true
                 });
                 return false;
                 e.preventDefault();
            });

    // function ----
    function reloadTable() {
      table.ajax.reload();
    }
  });
  </script>
