
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Pegawai</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->

    <!-- ModalEdit  -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">Edit Pegawai</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                     <label class="col-md-2 control-label">NIP</label>
                     <div class="col-md-8">
                       <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                         <input id="id" name="id" placeholder="NIP" class="form-control" required="true" type="hidden">
                         <input id="nip" name="nip" placeholder="NIP" class="form-control" required="true" type="text">
                       </div>
                       <div id="nip_valiadsi"></div>
                     </div>
                  </div>
                   <div class="form-group">
                      <label class="col-md-2 control-label">Nama Pegawai</label>
                      <div class="col-md-8">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input id="nama" name="Nama" placeholder="Nama Lengkap" class="form-control" required="true" type="text">
                        </div>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-2 control-label">IP Address</label>
                      <div class="col-md-8">
                         <div class="input-group">
                           <div class="input-group-addon">
                             <i class="fa fa-laptop"></i>
                           </div>
                           <input type="text" id="ip_address" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label class="col-md-2 control-label">Kota</label>
                      <div class="col-md-8">
                         <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                          <input id="kota" name="kota" placeholder="Kota" class="form-control" required="true" type="text">
                        </div>
                      </div>
                   </div>
                  <div class="form-group">
                     <label class="col-md-2 control-label">Alamat</label>
                     <div class="col-md-8">
                        <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                         <input id="alamat" name="alamat" placeholder="Alamat" class="form-control" required="true" type="text">
                       </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-2 control-label">Jabatan</label>
                     <div class="col-md-8">
                        <div class="input-group">
                           <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                           <select class="selectpicker form-control" id="listjabatan">
                             <option value="" id="jabatan" selected>-- Pilih --</option>
                           </select>
                        </div>
                     </div>
                  </div><div class="form-group">
                     <label class="col-md-2 control-label">Divisi</label>
                     <div class="col-md-8">
                        <div class="input-group">
                           <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                           <select class="selectpicker form-control" id="listdivisi">
                             <option value="" id="divisi" selected>-- Pilih --</option>
                           </select>
                        </div>
                     </div>
                </div>
              </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" id="simpanEdit">Simpan Perubahan</button>
          </div>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus Pegawai</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="id_pegawai">
                          <p>Apakah Anda yakin mau menonaktifkan pegawai ini?</p>
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
      <div class="col-xs-12 col-md-12">
        <div id="form_input">
        </div>
      </div>
      <div class="col-xs-12 col-md-12">
        <div class="box">
              <div class="box-header">
                <div class="btn-group">
                <button type="button" class="btn btn-default" id="reloadData"><i class="fa fa-refresh"></i> Reload</button>
                <button type="button" class="btn btn-default" id="addPegawai"><i class="fa fa-pencil"></i> Tambah</button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tPegawai" class="table table-striped display responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Kota</th>
                      <th>Alamat</th>
                      <th>Divisi</th>
                      <th>Jabatan</th>
                      <th>IP address</th>
                      <th>Last Activity</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Kota</th>
                      <th>Alamat</th>
                      <th>Divisi</th>
                      <th>Jabatan</th>
                      <th>IP address</th>
                      <th>Last Activity</th>
                        <th>action</th>
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
    $('#form_input').hide();

    $(document).ready(function(){
     var empty ='';
     listJabatan();
     listDivisi();
     $("[data-mask]").inputmask();

     var table = $('#tPegawai').DataTable({
            processing : true,
            ajax: {
              type  : "ajax",
              url: "<?php echo base_url("Pegawai/getAllPegawai")?>",
              dataType : "json"
            },
            columnDefs: [
                    { data: "nip", targets: 1 },
                    { data: "nama", targets: 2 },
                    { data: "kota", targets: 3 },
                    { data: "alamat", targets: 4 },
                    { data: "nama_divisi", targets: 5 },
                    { data: "nama_jabatan", targets: 6 },
                    { data: "ip_address", targets: 7 },
                    { data: "last_activity", targets: 8 },
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
                      targets: 9,
                      data: "id",
                      render: function ( data, type, row, meta ) {
                                  return "<div class='btn-group'><button type='button' id='edit' class='btn btn-success btn-sm' data='"+data+"'><i class='fa fa-edit'></i></button><button type='button' id='hapus' class='btn btn-danger btn-sm' data='"+data+"'><i class='fa fa-trash'></i></button></div>";
                              }
                    }
                  ],
      });

      // Tambah Pegawai
      $('#addPegawai').on('click',function(){
          $("#form_input").load('<?=site_url("Pegawai/forminsert")?>');
          $('#form_input').fadeIn('slow');
        });

      // Reload
      $('#reloadData').on('click',function(){
          table.ajax.reload();
        });

      //Get Hapus
      $('#tPegawai').on('click','#hapus',function(){
            var id=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="id_pegawai"]').val(id);
        });

      //Hapus Divisi
      $('#hapusData').on('click',function(){
            var id=$('[name="id_pegawai"]').val();
            $.ajax({
              type : "POST",
              url  : "<?php echo base_url('Pegawai/deletePegawai')?>",
              dataType : "JSON",
              timeout : 5000,
              data : {id:id},
              beforeSend: function () {
                $('#hapusData').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menghapus');
              },
              success: function(data){
                  $('#hapusData').html('Hapus');
                  $('#ModalDelete').modal('hide');
                  table.ajax.reload();
                  swal ( "Hapus",data['msg'], "error");
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus==='timeout') {
                  $('#hapusData').html('Hapus');
                  $('#ModalDelete').modal('hide');
                  swal("timeout","waktu habis gagal menghapus","error");
                } else {
                  $('#hapusData').html('Hapus');
                  $('#ModalDelete').modal('hide');
                  swal("error","gagal menghapus","error");
                }
              }
            });
            return false;
        });

       //Get Update
       $('#tPegawai').on('click','#edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('Pegawai/getPegawaiID')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id,nip,nama,ip_address,kota,alamat,id_jab,id_div){
                        $('#ModalEdit').modal('show');
                        $('#id').val(data.id);
                        $('#nip').val(data.nip);
                        $('#nama').val(data.nama);
                        $('#ip_address').val(data.ip_address);
                        $('#kota').val(data.kota);
                        $('#alamat').val(data.alamat);
                        $('#jabatan').val(data.id_jab);
                        $('#divisi').val(data.id_div);
                    });
                }
            });
            return false;
        });

      //Simpan Edit Divisi
      $('#simpanEdit').on('click',function(){
        var id = $('#id').val();
        var nip = $('#nip').val();
        var nama = $('#nama').val();
        var kota = $('#kota').val();
        var alamat = $('#alamat').val();
        var divisi = $('#listdivisi').val();
        var jabatan = $('#listjabatan').val();
        var ip = $('#ip_address').val();

        if (nip.length < 18) {
            swal ( "Peringatan","NIP Minimal 18 Karakter", "warning");
        } else if (nama.length == 0) {
            swal ( "Peringatan","Nama Pegawai Tidak Boleh kosong", "warning");
        } else if (kota.length == 0) {
            swal ( "Peringatan","Kota Tidak Boleh kosong", "warning");
        } else if (alamat.length == 0) {
            swal ( "Peringatan","Alamat Tidak Boleh kosong", "warning");
        } else {
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('Pegawai/updatePegawai')?>",
                dataType : "JSON",
                timeout:5000,
                data : {id:id,nip:nip,nama:nama,kota:kota,alamat:alamat,id_divisi:divisi,id_jabatan:jabatan,ip_address:ip},
                beforeSend: function () {
                  $('#simpanEdit').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan');
                },
                success: function(data){
                    resetForm();
                    $('#simpanEdit').html('Simpan Perubahan');
                    $('#ModalEdit').modal('hide');
                    table.ajax.reload();
                    swal ( "Edit",data['msg'], "success");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  if (textStatus==='timeout') {
                    $('#simpanEdit').html('Simpan Perubahan');
                    resetForm();
                    $('#ModalEdit').modal('hide');
                    swal("timeout","waktu habis gagal menyimpan","error");
                  } else {
                    $('#simpanEdit').html('Simpan Perubahan');
                    resetForm();
                    $('#ModalEdit').modal('hide');
                    swal("gagal","gagal menyimpan","error");
                  }
                }
            });
          }
            return false;
        });

      $('#nip').on('blur',function(){
          var nip = $(this).val();
          $.ajax({
            type  : 'POST',
            dataType: 'json',
            url   : '<?php echo base_url("Pegawai/PegawaiByNIP"); ?>',
            data  : {nip:nip},
            success : function(data){
              if (data['status'] == 'error') {
                $('#nip_valiadsi').html(data['msg']);
                $('#simpanEdit').hide(200);
              } else if (data['status'] == 'success') {
                $('#nip_valiadsi').html(data['msg']);
                $('#simpanEdit').show(200);
              }
            }
          });
        });

    // ----- FUNCTION -------//
    function listJabatan() {
        $.ajax({
          type : "ajax",
          url  : "<?php echo base_url('Jabatan/droplistjabatan')?>",
          dataType : "json",
          success: function (data) {
            var value = "";
            for (var i=0; i<data.length; i++) {
              value += "<option value='"+data[i].id_jabatan+"'>"+data[i].nama_jabatan+"</option>";
            }
            $('#listjabatan').append(value);
          }
        });
      }

    function listDivisi() {
        $.ajax({
          type : "ajax",
          url  : "<?php echo base_url('Divisi/droplistDivisi')?>",
          dataType : "json",
          success: function (data) {
            var html = "";
            for (var i=0; i<data.length; i++) {
              html += "<option value='"+data[i].id_divisi+"'>"+data[i].nama_divisi+"</option>";
            }
            $('#listdivisi').append(html);
          }
        });
      }

    function resetForm() {
        $('#nip-validasi').html(empty);
        $('#nip').val("");
        $('#nama').val("");
        $('#kota').val("");
        $('#ip_address').val("");
        $('#alamat').val("");
      }
    });
  </script>
