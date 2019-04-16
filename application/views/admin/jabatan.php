
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Jabatan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Jabatan</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->

    <!-- ModalAdd  -->
    <div class="modal fade" id="AddData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">Tambah jabatan</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                  <label class="col-form-label">Nama Jabatan</label>
                  <input type="text" class="form-control" id="nama_jabatan" placeholder="nama" required>
              </div>
              <div class="form-group">
                  <label  class="col-form-label">Keterangan</label>
                  <textarea class="form-control" id="keterangan"  rows="3" placeholder="Enter ..."></textarea>
              </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- End ModalAdd  -->

    <!-- ModalEdit  -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">Edit jabatan</h4>
          </div>
          <div class="modal-body">
          <form>
              <div class="form-group">
                  <label class="col-form-label">Nama Jabatan</label>
                  <input type="hidden" class="form-control" id="edit_id_jabatan">
                  <input type="text" class="form-control" id="edit_nama_jabatan" placeholder="nama">
              </div>
              <div class="form-group">
                  <label  class="col-form-label">Keterangan</label>
                  <textarea class="form-control" id="edit_keterangan"  rows="3" placeholder="Enter ..."></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" id="simpanEdit">Simpan Perubahan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!--End ModalEdit-->
    <!--Modal Delete-->
        <div class="modal modal-warning fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus jabatan</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="id_jabatan" id="id_jabatan">
                          <p>Apakah Anda yakin mau memhapus Jabatan ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-outline" id="hapusData">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!--END MODAL HAPUS-->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
              <div class="box-header">
                <div class="btn-group">
                <button type="button" class="btn btn-default" id="reloadData"><i class="fa fa-refresh"></i> Reload</button>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddData"><i class="fa fa-pencil"></i> Tambah</button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tJabatan" class="table table-striped display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jabatan</th>
                      <th>Jumlah Pegawai</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Jabatan</th>
                      <th>Jumlah Pegawai</th>
                      <th>Keterangan</th>
                      <th>Action</th>
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
    $('.row').hide();
    $('.row').fadeIn(1000);

    $(document).ready(function(){
     var table = $('#tJabatan').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("alljabatan")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "nama_jabatan", targets: 1 },
                    { data: "jumlah", targets: 2 },
                    { data: "keterangan", targets: 3 },
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
                      targets: 4,
                      data: "id_jabatan",
                      render: function ( data, type, row, meta ) {
                                  return "<div class='btn-group'><button type='button' id='edit' class='btn btn-success btn-sm' data='"+data+"'><i class='fa fa-edit'></i></button><button type='button' id='hapus' class='btn btn-danger btn-sm' data='"+data+"'><i class='fa fa-trash'></i></button></div>";
                              }
                    }
                  ],
      });

      // Reload
      $('#reloadData').on('click',function(){
          table.ajax.reload();
        });

      //Simpan Jabatan
      $('#simpanData').on('click',function(){
            var nama_jabatan = $('#nama_jabatan').val();
            var keterangan = $('#keterangan').val();

            if (nama_jabatan == "") {
                swal ( "Peringatan","Nama Jabatan Tidak Boleh kosong", "warning");
            } else {
                $.ajax({
                  type : "POST",
                  url  : "<?php echo base_url('insertjabatan')?>",
                  dataType : "JSON",
                  timeout:5000,
                  data : {nama_jabatan:nama_jabatan, keterangan:keterangan},
                  beforeSend: function () {
                    $('#simpanData').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan');
                  },
                  success: function(data){
                      resetForm();
                      resetBtn();
                      $('#AddData').modal('hide');
                      table.ajax.reload();
                      swal ( "success","Jabatan Ditambah", "success");
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (textStatus==='timeout') {
                      resetBtn();
                      resetForm();
                      swal("timeout","waktu habis gagal menyimpan","error");
                    } else {
                      resetBtn();
                      resetForm();
                      swal("gagal","gagal menyimpan","error");
                    }
                  }
              });
            };

            return false;
        });

      //Get Hapus
      $('#tJabatan').on('click','#hapus',function(){
            var id=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="id_jabatan"]').val(id);
        });

      //Hapus Divisi
      $('#hapusData').on('click',function(){
            var id_jabatan=$('#id_jabatan').val();
            $.ajax({
              type : "POST",
              url  : "<?php echo base_url('deletejabatan')?>",
              dataType : "JSON",
              timeout : 5000,
              data : {id_jabatan:id_jabatan},
              beforeSend: function () {
                $('#hapusData').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menghapus');
              },
              success: function(data){
                if (data['status']=='success') {
                  $('#ModalDelete').modal('hide');
                  table.ajax.reload();
                  swal ( "Hapus",data['msg'], "error");
                } else {
                  $('#ModalDelete').modal('hide');
                  swal ( "tidak bisa dihapus",data['msg'], "error");
                }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus==='timeout') {
                  $('#ModalDelete').modal('hide');
                  swal("timeout","waktu habis gagal menghapus","error");
                } else {
                  $('#ModalDelete').modal('hide');
                  swal("error","gagal menghapus","error");
                }
              }
            });
            return false;
        });

       //Get Update
       $('#tJabatan').on('click','#edit',function(){
            var id_jabatan=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('jabatanbyid')?>",
                dataType : "JSON",
                data : {id_jabatan:id_jabatan},
                success: function(data){
                    $.each(data,function(id_jabatan,nama_jabatan,keterangan){
                        $('#ModalEdit').modal('show');
                        $('#edit_id_jabatan').val(data.id_jabatan);
                        $('#edit_nama_jabatan').val(data.nama_jabatan);
                        $('#edit_keterangan').val(data.keterangan);
                    });
                }
            });
            return false;
        });

      //Simpan Edit Divisi
      $('#simpanEdit').on('click',function(){
            var id=$('#edit_id_jabatan').val();
            var nama=$('#edit_nama_jabatan').val();
            var keterangan=$('#edit_keterangan').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('updatejabatan')?>",
                dataType : "JSON",
                timeout:5000,
                data : {id_jabatan:id,nama_jabatan:nama,keterangan:keterangan},
                beforeSend: function () {
                  $('#simpanEdit').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan');
                },
                success: function(data){
                    resetForm();
                    resetBtn();
                    $('#ModalEdit').modal('hide');
                    table.ajax.reload();
                    swal ( "Edit","Data Telah diedit", "success");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  if (textStatus==='timeout') {
                    resetBtn();
                    resetForm();
                    $('#ModalEdit').modal('hide');
                    swal("timeout","waktu habis gagal menyimpan","error");
                  } else {
                    resetBtn();
                    resetForm();
                    $('#ModalEdit').modal('hide');
                    swal("gagal","gagal menyimpan","error");
                  }
                }
            });
            return false;
        });
    // ----- FUNCTION -------//
      function resetForm() {
        $('#nama_jabatan').val("");
        $('#keterangan').val("");
        $('#edit_id_jabatan').val("");
        $('#edit_nama_jabatan').val("");
        $('#edit_keterangan').val("");
      }

      function resetBtn() {
        $('#simpanData').html('Simpan');
        $('#simpanEdit').html('Simpan Perubahan');
      }
    });
  </script>
