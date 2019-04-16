  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> User</a></li>
      </ol>
    </section>

    <!--Modal Delete-->
    <div class="modal modal-default fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h4 class="modal-title" id="myModalLabel">Hapus User</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_user" id="id_user">
            <p>Apakah Anda yakin mau menghapus user <b id="text"></b> ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-danger" id="btn-hapus">Hapus</button>
          </div>
        </div>
      </div>
    </div>
    <!--End Modal delete-->

    <!--Modal Edit-->
    <div class="modal modal-default fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit <b id="text_username"></b></h4>
          </div>
          <div class="modal-body">
            <label class="col-form-label">Level</label>
            <div class="form-group">
              <input type="hidden" name="id_user_edit" id="id_user_edit">
              <select class="form-control" id="edit_level">
              </select>
            </div>
            <label class="col-form-label">Status</label>
            <div class="form-group">
              <select class="form-control" id="edit_status">
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" id="btn-simpan-edit">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>
    <!--End Modal edit-->

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
      <div class="col-xs-6" id="addUser">
        <div class="box box-success">
          <div class="box-header">
            <h4>Buat User baru</h4>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
                  <label>Cari Pegawai</label>
                  <div class="form-group" id="form-pegawai">
                    <select class="form-control select2-single" id="tnip">
                    </select>
                    <div class="msg" id="msg-pegawai"></div>
                  </div>
                  <div class="form-group" id="form-username">
                    <label >Nama Pengguna</label>
                    <input type="text" class="form-control" id="tusername" placeholder="Masukan Nama Pengguna">
                    <div class="msg" id="msg-username"></div>
                  </div>
                  <div id="form">
                  <div class="form-group" id="form-password">
                    <label>Kata sandi</label>
                    <input type="password" class="form-control" id="tpassword" placeholder="Password">
                    <div class="msg" id="msg-password"></div>
                  </div>
                  <label>Konfirmasi Kata sandi</label>
                  <div class="form-group" id="form-password2">
                    <input type="password" class="form-control" id="tpassword2" placeholder="Password">
                    <div class="msg" id="msg-password2"></div>
                  </div>
                  <div class="form-group" id="form-level">
                    <label>Level</label>
                    <select class="form-control" id="level">
                      <option value=""> -- pilih -- </option>
                      <option value="2">Admin</option>
                      <option value="3">Administrator</option>
                    </select>
                    <div class="msg" id="msg-level"></div>
                  </div>
                  </div>
          </div>
          <div class="box-footer" id="btn-simpan">
            <button type="button" class="btn btn-success btn-flat" id="simpan"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="box">
              <div class="box-header">
                <button type="button" class="btn btn-default" id="btn-tambah"><i class="fa fa-pencil"></i> Tambah User</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tUser" class="table table-bordered display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
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
    $('#addUser').hide();
    $('#form').hide();
    $('#form-username').hide();
    $('#simpan').hide();

    $(document).ready(function() {
      var table = $('#tUser').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?=base_url("user/getAllUser")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "nip", targets: 0 },
                    { data: "nama", targets: 1 },
                    { data: "username", targets: 2 },
                    { data: "nama_level", targets: 3 },
                    {
                      searchable: false,
                      orderable : false,
                      targets: 4,
                      data: "user_id",
                      render: function ( data, type, row, meta ) {
                                  return "<div class='btn-group'><button type='button' id='edit' class='btn btn-success' data='"+data+"'><i class='fa fa-edit'></i></button><button type='button' id='hapus' class='btn btn-danger' data='"+data+"'><i class='fa fa-trash'></i></button></div>";
                              }
                    }
                  ],
      });

      //Get delete
       $('#tUser').on('click','#hapus',function(){
            var id_user=$(this).attr('data');
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('User/getUsernameByID')?>",
                dataType : "JSON",
                data : {id_user:id_user},
                success: function(data){
                  $('#ModalDelete').modal('show');
                  $('#id_user').val(data['id_user']);
                  $('#text').html(data['username']);
                }
            });
            return false;
        });

       // tombol hapus modal
       $('#btn-hapus').on('click',function () {
          var user = $('#id_user').val();
         $.ajax({
           url: '<?=base_url('User/deleteUser')?>',
           type: 'POST',
           dataType: 'JSON',
           data: {id_user: user},
         })
         .done(function() {
           table.ajax.reload();
           $('#ModalDelete').modal('hide');
           swal ( "Hapus","Hapus Sukses!", "error");
         })
         .fail(function() {
           table.ajax.reload();
           swal ( "Hapus","Hapus Gagal!", "error");
         });
       });

       // get edit
       $('#tUser').on('click','#edit',function(){
        var id_user=$(this).attr('data');
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('User/getUsernameByID')?>",
                dataType : "JSON",
                data : {id_user:id_user},
                success: function(data){
                  $('#ModalEdit').modal('show');
                  $('#id_user_edit').val(data['id_user']);
                  $('#text_username').html(data['username']);
                  showLevel(data['id_level'])
                  showStatus(data['aktif']);
                }
            });
            return false;
       });

       // tombol simpan edit modal
       $('#btn-simpan-edit').on('click',function () {
          var user = $('#id_user_edit').val();
          var status = $('#edit_status').val();
          var level = $('#edit_level').val();
         $.ajax({
           url: '<?=base_url('User/updateuser')?>',
           type: 'POST',
           dataType: 'JSON',
           data: {id_user:user, status:status, level:level},
         })
         .done(function() {
           table.ajax.reload();
           $('#ModalEdit').modal('hide');
           swal ( "Hapus","Edit Sukses!", "success");
         })
         .fail(function() {
           table.ajax.reload();
           swal ( "Hapus","Edit Gagal!", "error");
         });
       });

      // tombol memunculkan form tambah user
      var btnTambah = $('#btn-tambah').on('click',function () {
        $('#addUser').slideDown('slows');
      });

      $('#tusername').on('input',function() {
        var form = '#form';
        var clas = '#form-username';
        var msg = '#msg-username';

        cekUsername(form,clas,msg);
      });

      var cariPegawai = $('#tnip').select2({
        minimumInputLength: 2,
           allowClear: true,
           placeholder: 'masukan NIP pegawai',
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
         $('#form-username').slideDown('slow');
      });

      var btnSimpan = $('#simpan').on('click',function () { // tobol simpan
            var id_pegawai = $('#tnip').val();
            var username = $('#tusername').val();
            var password = $('#tpassword').val();
            var level = $('#level').val();

            var error = '<label class="control-label text-red" id="inputError"><i class="fa fa-times-circle-o"></i> Harus di isi</label>';

            if (id_pegawai == "") {
              $('#form-pegawai').attr('class','form-group has-error');
              $('#msg-pegawai').html(error);
            } else if (username == ""){
              $('#form-username').attr('class','form-group has-error');
              $('#msg-username').html(error);
            } else if (password == ""){
              $('#form-password').attr('class','form-group has-error');
              $('#msg-password').html(error);
            } else if (level == ""){
              $('#form-level').attr('class','form-group has-error');
              $('#msg-level').html(error);
            } else {
              $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('User/insertUser')?>",
                    dataType : "JSON",
                    data : {
                      id_pegawai:id_pegawai,
                      username:username,
                      password:password,
                      level:level,
                    },
                    success: function(data){
                      if (data['status'] == 'success') {
                          formReset();
                          swal ( "success",data['msg'], "success");
                          table.ajax.reload();
                      } else {
                          formReset();
                          swal ( "warning",data['msg'], "warning");
                      }
                    }
                });
            }
            });

      var cekPassword = $('#tpassword2').on('input',function() { // cek password
        var password = $('#tpassword').val();
        var konfirmasi = $('#tpassword2').val();
        var error = '<span class="control-label text-orange"><i class="fa fa-bell"></i> Kata sandi tidak sama</span>';
        var success = '<span class="control-label text-green"><i class="fa fa-check"></i> Kata sandi cocok</span>';

        if (password != konfirmasi ) { // jika password tidak sama dengan kofirmasi
          $('#msg-password2').html(error);
          $('#simpan').hide();
          $('#form-password2').attr('class', 'form-group has-warning');
        } else { // jika benar maka akan menampilkan tombol simpan
          $('#msg-password2').html(success);
          $('#simpan').show('slow');
          $('#form-password2').attr('class', 'form-group has-success');
        }
      });

      // ================  FUNCTION ==================
      function formReset() {
        $('#tnip').val('');
        $('#tpassword').val('');
        $('#tpassword2').val('');
        $('#tusername').val('');
        $('.form-group').attr('class', 'form-group');
        $('.msg').html('');
        $('#form-username').hide();
        $('#simpan').hide();
        $('#form').hide();
      }

      function cekUsername(form,clas,msg) {
        var tusername = $('#tusername').val();
        $.ajax({
          url: '<?=base_url('User/cekUsername')?>',
          type: 'POST',
          dataType: 'json',
          data: {username: tusername},
          success:function (data) {
            if (data['status'] == 'success') {
              $(form).slideDown('slow');
              $(clas).attr('class',data['class']);
              $(msg).html(data['msg']);
            } else {
              $(form).hide();
              $(clas).attr('class',data['class']);
              $(msg).html(data['msg']);
            }
          }
        });
      }

      function showStatus(id_user) {
        $('#edit_status').html('<option value="'+id_user+'" selected>-- Pilih Status --</option>'+
                               '<option value="1">Aktif</option>'+
                               '<option value="0">Non Aktif</option>'+
                               '<option value="2">Banned</option>'
                               );
      }

      function showLevel(id_user) {
        $('#edit_level').html('<option value="'+id_user+'" selected>-- Pilih Level --</option>'+
                               '<option value="2">Admin</option>'+
                               '<option value="3">Administrator</option>'
                               );
      }

    });
  </script>
