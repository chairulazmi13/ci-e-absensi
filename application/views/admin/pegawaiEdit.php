        <div class="box">
                <div class="box-header">
                  <h4>Edit Pegawai </h4>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                   <form class="form-horizontal">
                      <fieldset>
                        <div class="form-group">
                           <label class="col-md-2 control-label">NIP</label>
                           <div class="col-md-8 inputGroupContainer">
                             <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                               <input id="nip" name="nip" placeholder="NIP" class="form-control" required="true" type="text" value="">
                             </div>
                             <div id="nip-validasi"></div>
                           </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Nama Pegawai</label>
                            <div class="col-md-8 inputGroupContainer">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nama" name="Nama" placeholder="Nama Lengkap" class="form-control" required="true" type="text">
                              </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Kota</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input id="kota" name="kota" placeholder="Kota" class="form-control" required="true" type="text">
                              </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input id="alamat" name="alamat" placeholder="Alamat" class="form-control" required="true" type="text">
                              </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label">Jabatan</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" id="droplistjabatan">
                                  </select>
                               </div>
                            </div>
                         </div><div class="form-group">
                            <label class="col-md-2 control-label">Divisi</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" id="droplistdivisi">
                                    <option value=''>pilih</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                      </fieldset>
                   </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button class="btn btn-success pull-right" id="simpanEdit"><i class="fa fa-save"></i> Simpan Edit</button>
                </div>
          </div>
          <!-- /.box -->
          <script type="text/javascript">
            $(document).ready(function(){
              var empty ='';

              tampiData()
              droplistJabatan();
              droplistDivisi();
              $('#simpanPegawai').hide();

              //Simpan Pegawai
              var simpan = $('#simpanPegawai').on('click',function(){
                      var nip = $('#nip').val();
                      var nama = $('#nama').val();
                      var kota = $('#kota').val();
                      var alamat = $('#alamat').val();
                      var divisi = $('#droplistdivisi').val();
                      var jabatan = $('#droplistjabatan').val();
                      var spin = '<i class="fas fa-circle-notch fa-spin"></i> Simpan';

                      if (nama == "") {
                          swal ( "Peringatan","Nama Pegawai Tidak Boleh kosong", "warning");
                      } else if (kota == "") {
                          swal ( "Peringatan","Kota Tidak Boleh kosong", "warning");
                      } else if (alamat == "") {
                          swal ( "Peringatan","Alamat Tidak Boleh kosong", "warning");
                      } else {
                          $.ajax({
                            type : "POST",
                            url  : "<?php echo base_url('pegawai/insertPegawai')?>",
                            dataType : "JSON",
                            data : {nip:nip, nama:nama, kota:kota, alamat:alamat, divisi:divisi, jabatan:jabatan},
                            success: function(data){
                                $('#nip-validasi').html(empty);
                                $('#nip').val("");
                                $('#nama').val("");
                                $('#kota').val("");
                                $('#alamat').val("");
                                swal ( "success","Pegawai ditambah", "success");
                                table.ajax.reload();
                                $('#simpanPegawai').hide();
                            }
                        });
                      };

                      return false;
                  });

                  $('#nip').blur(function(){
                    var nip = $(this).val();
                    var btnsimpan = '<button type="button" class="btn btn-primary pull-right" id="simpanPegawai"><i class="fa fa-save"></i> Simpan</button>';
                    var error = '<label class="control-label text-red" id="inputError"><i class="fa fa-times-circle-o"></i> NIP sudah ada</label>';
                    var success = '<label class="control-label text-green" id="inputSuccess"><i class="fa fa-check"></i> NIP Bisa Dipakai</label>';

                    $.ajax({
                      type  : 'POST',
                      url   : '<?php echo base_url("Pegawai/PegawaiByNIP"); ?>',
                      data  : {nip:nip},
                      success : function(data){
                        if (data == 1) {
                          $('#nip-validasi').html(error);
                          $('#simpanPegawai').hide(200);
                        } else {
                          $('#nip-validasi').html(success);
                          $('#simpanPegawai').show(200);
                        }
                      }
                    });
                  });
                  // FUNCTION

                  function tampiData(){
                      $.ajax({
                      type : "GET",
                      url  : "<?php echo base_url('Pegawai/getPegawaiID')?>",
                      dataType : "JSON",
                      data : {id:id_pegawai},
                      success: function(data){
                          $.each(data,function(nip){
                              $('#nip').val(data.nip);
                          });
                      }
                    });
                  }

                  function droplistJabatan() {
                      $.ajax({
                        type : "ajax",
                        url  : "<?php echo base_url('Jabatan/droplistjabatan')?>",
                        dataType : "json",
                        success: function (data) {
                          var value = "";
                          for (var i=0; i<data.length; i++) {
                            value += "<option value='"+data[i].id_jabatan+"'>"+data[i].nama_jabatan+"</option>";
                          }
                          $('#droplistjabatan').html(value);
                        }
                      });
                    }

                  function droplistDivisi() {
                      $.ajax({
                        type : "ajax",
                        url  : "<?php echo base_url('Divisi/droplistDivisi')?>",
                        dataType : "json",
                        success: function (data) {
                          var html = "";
                          for (var i=0; i<data.length; i++) {
                            html += "<option value='"+data[i].id_divisi+"'>"+data[i].nama_divisi+"</option>";
                          }
                          $('#droplistdivisi').html(html);
                        }
                      });
                    }
            });
          </script>
