
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Divisi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Divisi</a></li>
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Divisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Divisi</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_divisi" placeholder="nama" required>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="keterangan" placeholder="alamat">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
            <h5 class="modal-title">Edit Divisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Divisi</label>
                <div class="col-sm-10">
                <input type="hidden" class="form-control" id="edit_id_divisi" value="">
                <input type="text" class="form-control" id="edit_nama_divisi" placeholder="Nama" value="">
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan" value="">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" id="simpanEdit">Simpan Perubahan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!--End ModalEdit-->
    <!--Modal Delete-->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Divisi</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">

                            <input type="hidden" name="id_divisi" id="id_divisi">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus Divisi ini?</p></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger" id="hapusData">Hapus</button>
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
              <table id="tDivisi" class="table table-striped display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Divisi</th>
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
                  <th>Divisi</th>
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
        var table = $('#tDivisi').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("alldivisi")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "nama_divisi", targets: 1 },
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
                      data: "id_divisi",
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

        //Get Hapus
        $('#tDivisi').on('click','#hapus',function(){
            var id=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="id_divisi"]').val(id);
        });

        //Hapus Divisi
        $('#hapusData').on('click',function(){
            var id_divisi=$('#id_divisi').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('deletedivisi')?>",
            dataType : "JSON",
                    data : {id_divisi: id_divisi},
                    success: function(data){
                          if (data['status'] == 'success') {
                            $('#ModalDelete').modal('hide');
                            table.ajax.reload();
                            swal ( "dihapus",data['msg'], "success");
                          } else {
                            $('#ModalDelete').modal('hide');
                            swal ( "Tidak Bisa dihapus",data['msg'], "error");
                          }
                    }
                });
            return false;
            });

        //Simpan Divisi
        $('#simpanData').on('click',function(){
            var nama_divisi=$('#nama_divisi').val();
            var keterangan=$('#keterangan').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('insertdivisi')?>",
                dataType : "JSON",
                timeout: 5000,
                data : {nama_divisi:nama_divisi, keterangan:keterangan},
                beforeSend: function () {
                  $('#simpanData').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan');
                },
                success: function(data){
                    resetBtn();
                    $('#AddData').modal('hide');
                    resetForm();
                    swal("success","berhasil menyimpan","success");
                    table.ajax.reload();
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
            return false;
        });

        //Get Update
        $('#tDivisi').on('click','#edit',function(){
            var id_divisi=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('divisibyid')?>",
                dataType : "JSON",
                data : {id_divisi:id_divisi},
                success: function(data){
                    $.each(data,function(id_divisi, nama_divisi, keterangan){
                        $('#ModalEdit').modal('show');
                        $('#edit_id_divisi').val(data.id_divisi);
                        $('#edit_nama_divisi').val(data.nama_divisi);
                        $('#edit_keterangan').val(data.keterangan);
                    });
                }
            });
            return false;
        });

        //Simpan Edit Divisi
        $('#simpanEdit').on('click',function(){
            var id=$('#edit_id_divisi').val();
            var nama=$('#edit_nama_divisi').val();
            var keterangan=$('#edit_keterangan').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('updatedivisi')?>",
                dataType : "JSON",
                timeout: 5000,
                data : {id_divisi:id,nama_divisi:nama,keterangan:keterangan},
                beforeSend: function () {
                  $('#simpanEdit').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan perubahan');
                },
                success: function(data){
                    resetBtn();
                    resetForm();
                    $('#ModalEdit').modal('hide');
                    table.ajax.reload();
                    swal ( "success","Perubahan disimpan", "success");
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
            return false;
        });

        // FUNCTION
        function resetForm() {
          // add
          $('[name="nama_divisi"]').val("");
          $('[name="keterangan"]').val("");
          // edit
          $('#edit_id_divisi').val("");
          $('#edit_nama_divisi').val("");
          $('#edit_keterangan').val("");
        }

        function resetBtn() {
          $('#simpanData').html('Simpan');
          $('#simpanEdit').html('Simpan Perubahan');
        }

    });
  </script>
