  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kehadiran
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header"><h4>Info</h4></div>
            <div class="box-body">Permohonan cuti akan di tinjau oleh admin dan berstatus <b class="text-yellow">Pending</b></div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-success">
              <div class="box-header">
                <h4>Permohonan Cuti</h4>
              </div>
              <div class="box-body form-horizontal">
                <div class="form-group" id="form-admin">
                  <label class="col-sm-2 control-label">Admin</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <select class="selectpicker form-control" id="admin">
                        <option value="" selected>-- Pilih --</option>
                      </select>
                    </div>
                    <span class="msg" id="msg-admin"></span>
                  </div>
                </div>
                <div class="form-group" id="form-tanggalmulai">
                  <label class="col-sm-2 control-label">Tanggal Mulai</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" placeholder="yyyy-mm-dd" class="form-control pull-right tanggal" id="tanggalMulai">
                    </div>
                    <span class="msg" id="msg-tglmulai"></span>
                  </div>
                </div>
                <div class="form-group" id="form-tanggalakhir">
                  <label class="col-sm-2 control-label">Sampai Tanggal</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" placeholder="yyyy-mm-dd" class="form-control pull-right tanggal" id="tanggalAkhir">
                    </div>
                    <span class="msg" id="msg-tglakhir"></span>
                  </div>
                </div>
                <div class="form-group" id="form-jeniscuti">
                  <label class="col-sm-2 control-label">Jenis Cuti</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-bars"></i>
                      </div>
                      <select class="selectpicker form-control" id="jenisCuti">
                        <option value="">-- Pilih --</option>
                        <option value="sakit">Cuti Sakit</option>
                        <option value="tahunan">Cuti Tahunan</option>
                      </select>
                    </div>
                    <span class="msg" id="msg-jeniscuti"></span>
                  </div>
                </div>
                <div class="form-group" id="form-keterangan">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="keterangan" rows="5" id="tKeterangan"></textarea>
                    <span class="msg" id="msg-keterangan"></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-lg btn-warning pull-left" id="btn-reset">Reset</button>
                <button type="button" class="btn btn-lg btn-success pull-right" id="btn-kirim">Kirim</button>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
      $(document).ready(function(){
        // List Piih Admin
        listAdmin();

        //Date picker
        $('.tanggal').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          orientation: "bottom auto"
        });

        $('#btn-kirim').click(function(event) {
          var admin   = $('#admin').val();
          var tanggalMulai = $('#tanggalMulai').val();
          var tanggalAkhir = $('#tanggalAkhir').val();
          var jenisCuti    = $('#jenisCuti').val();
          var keterangan   = $('#tKeterangan').val();

          var tanggal = $('.tanggal').val();

          if (admin.length <= 0) {
            $('#form-admin').attr('class', 'form-group has-warning');
            $('#msg-admin').html('<span class="help-block">Admin tidak boleh kosong</span>');
          }
          if (tanggalMulai.length <= 0) {
            $('#form-tanggalmulai').attr('class', 'form-group has-warning');
            $('#msg-tglmulai').html('<span class="help-block">tanggal mulai tidak boleh kosong</span>');
          }
          if (tanggalAkhir.length <= 0) {
            $('#form-tanggalakhir').attr('class', 'form-group has-warning');
            $('#msg-tglakhir').html('<span class="help-block">tanggal akhir tidak boleh kosong</span>');
          }
          if (jenisCuti.length <= 0) {
            $('#form-jeniscuti').attr('class', 'form-group has-warning');
            $('#msg-jeniscuti').html('<span class="help-block">jenis cuti tidak boleh kosong</span>');
          }
          if (keterangan.length <= 0) {
            $('#form-keterangan').attr('class', 'form-group has-warning');
            $('#msg-keterangan').html('<span class="help-block">keterangan tidak boleh kosong</span>');
          }
          else {
            $.ajax({
              url: '<?=base_url("pegawai_backend/pegawaipermohonancuti/insert")?>',
              type: 'POST',
              dataType: 'json',
              timeout: 5000,
              data: {
                admin:admin,
                tanggalMulai:tanggalMulai,
                tanggalAkhir:tanggalAkhir,
                jenisCuti:jenisCuti,
                keterangan:keterangan
              },
              beforeSend: function () {
                $('#btn-kirim').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> ..Mengirim');
              },
              success: function (data) {
                $('#btn-kirim').html('Kirim');
                swal('Dikirim',data['msg'],'success');
                resetForm();
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus==='timeout') {
                  $('#btn-kirim').html('Kirim');
                  resetForm();
                  swal("timeout","waktu habis gagal mengirim","error");
                } else {
                  $('#btn-kirim').html('Kirim');
                  resetForm();
                  swal("gagal","gagal mengirim","error");
                }
            }
          });
          }
        });

        $('#btn-reset').click(function(event) {
          resetForm();
        });

        // ----- FUNCTION --------
        function listAdmin() {
          $.ajax({
                type : "ajax",
                url  : "<?php echo base_url('pegawaipermohonancuti/listAdmin')?>",
                dataType : "json",
                success: function (data) {
                    var value = "";
                    for (var i=0; i<data.length; i++) {
                        value += "<option value='"+data[i].username+"'>"+data[i].nama+"</option>";
                    }
                    $('#admin').append(value);
                }
            });
        }

        function resetForm() {
          $('#tanggalMulai').val("");
          $('#tanggalAkhir').val("");
          $('#tKeterangan').val("");
          $('.form-group').attr('class', 'form-group');
          $('.msg').html('');
        }

      });
    </script>
