        <div class="box">
                <div class="box-header">
                  <h4>Tambah Pegawai</h4>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                   <form class="form-horizontal">
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                            <label class="col-md-2 control-label">NIP</label>
                            <div class="col-md-8">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="t_nip" name="nip" placeholder="NIP" class="form-control" required="true" type="text">
                              </div>
                              <div id="t_nip_valiadsi"></div>
                            </div>
                         </div>
                          <div class="form-group">
                             <label class="col-md-2 control-label">Nama Pegawai</label>
                             <div class="col-md-8">
                               <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                 <input id="t_nama" name="nama" placeholder="Nama Lengkap" class="form-control" required="true" type="text">
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
                                  <input type="text" id="t_ip_address" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
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
                                 <input id="t_kota" name="kota" placeholder="Kota" class="form-control" required="true" type="text">
                               </div>
                             </div>
                          </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-8">
                               <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input id="t_alamat" name="alamat" placeholder="Alamat" class="form-control" required="true" type="text">
                              </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Jabatan</label>
                            <div class="col-md-8">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" id="t_listjabatan">
                                    <option value=''>-- pilih --</option>
                                  </select>
                               </div>
                            </div>
                         </div><div class="form-group">
                            <label class="col-md-2 control-label">Divisi</label>
                            <div class="col-md-8">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" id="t_listdivisi">
                                    <option value=''>-- pilih --</option>
                                  </select>
                               </div>
                            </div>
                       </div>
                     </div>
                  </div>
                   </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" class="btn btn-primary pull-right" id="simpanPegawai"><i class="fa fa-save"></i> Simpan</button>
                </div>
          </div>
          <!-- /.box -->
          <script type="text/javascript">
            $(document).ready(function(){
              var empty ='';
              $("[data-mask]").inputmask();
              addListJabatan();
              addListDivisi();
              $('#simpanPegawai').hide();

              //Simpan Pegawai
              var simpan = $('#simpanPegawai').on('click',function(){
                      var nip = $('#t_nip').val();
                      var nama = $('#t_nama').val();
                      var kota = $('#t_kota').val();
                      var alamat = $('#t_alamat').val();
                      var divisi = $('#t_listdivisi').val();
                      var jabatan = $('#t_listjabatan').val();

                      if (nip.length < 18) {
                          swal ( "Peringatan","NIP Minimal 18 Karakter", "warning");
                      } else if (nama.length == 0) {
                          swal ( "Peringatan","Nama Pegawai Tidak Boleh kosong", "warning");
                      } else if (kota.length == 0) {
                          swal ( "Peringatan","Kota Tidak Boleh kosong", "warning");
                      } else if (alamat.length == 0) {
                          swal ( "Peringatan","Alamat Tidak Boleh kosong", "warning");
                      } else if (divisi.length == 0) {
                          swal ( "Peringatan","divisi Tidak Boleh kosong", "warning");
                      } else if (jabatan.length == 0) {
                          swal ( "Peringatan","jabatan Tidak Boleh kosong", "warning");
                      } else {
                          $.ajax({
                            type : "POST",
                            url  : "<?php echo base_url('pegawai/insertPegawai')?>",
                            dataType : "JSON",
                            timeout:5000,
                            data : {nip:nip, nama:nama, kota:kota, alamat:alamat, divisi:divisi, jabatan:jabatan},
                            beforeSend: function () {
                              $('#simpanPegawai').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Menyimpan');
                            },
                            success: function(data){
                              $('#simpanPegawai').html('<i class="fa fa-save"></i> Simpan');
                              resetForm();
                              swal ( "success","Pegawai ditambah", "success");
                              table.ajax.reload();
                              $('#simpanPegawai').hide();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                              if (textStatus==='timeout') {
                                resetForm();
                                $('#simpanPegawai').html('<i class="fa fa-save"></i> Simpan');
                                swal("timeout","waktu habis gagal menyimpan","error");
                              } else {
                                resetForm();
                                $('#simpanPegawai').html('<i class="fa fa-save"></i> Simpan');
                                swal("gagal","gagal menyimpan","error");
                              }
                            }
                        });
                      };
                      return false;
                  });

                  $('#t_nip').on('blur',function(){
                    var nip = $(this).val();
                    $.ajax({
                      type  : 'POST',
                      dataType: 'json',
                      url   : '<?php echo base_url("Pegawai/PegawaiByNIP"); ?>',
                      data  : {nip:nip},
                      success : function(data){
                        if (data['status'] == 'error') {
                          $('#t_nip_valiadsi').html(data['msg']);
                          $('#simpanPegawai').hide(200);
                        } else if (data['status'] == 'success') {
                          $('#t_nip_valiadsi').html(data['msg']);
                          $('#simpanPegawai').show(200);
                        }
                      }
                    });


                  });
                  // FUNCTION
                  function addListJabatan() {
                      $.ajax({
                        type : "ajax",
                        url  : "<?php echo base_url('Jabatan/droplistjabatan')?>",
                        dataType : "json",
                        success: function (data) {
                          var value = "";
                          for (var i=0; i<data.length; i++) {
                            value += "<option value='"+data[i].id_jabatan+"'>"+data[i].nama_jabatan+"</option>";
                          }
                          $('#t_listjabatan').append(value);
                        }
                      });
                    }

                  function addListDivisi() {
                      $.ajax({
                        type : "ajax",
                        url  : "<?php echo base_url('Divisi/droplistDivisi')?>",
                        dataType : "json",
                        success: function (data) {
                          var html = "";
                          for (var i=0; i<data.length; i++) {
                            html += "<option value='"+data[i].id_divisi+"'>"+data[i].nama_divisi+"</option>";
                          }
                          $('#t_listdivisi').append(html);
                        }
                      });
                    }

                  function resetForm() {
                    $('#t_nip-validasi').html(empty);
                    $('#t_nip').val("");
                    $('#t_nama').val("");
                    $('#t_kota').val("");
                    $('#t_ip_address').val("");
                    $('#t_alamat').val("");
                  }
            });
          </script>
