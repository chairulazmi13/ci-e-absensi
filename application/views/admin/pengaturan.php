
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Divisi</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pengaturan Aplikasi</h3> <small id="status"></small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Perusahaan</label>
                  <input type="hidden" class="form-control" id="id" name="id">
                  <input type="text" class="form-control" id="namaperusahaan" name="namaperusahaan">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat Perusahaan</label>
                  <input type="text" class="form-control" id="alamat" name="alamat">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mulai Absensi</label>
                  <input type="text" class="form-control time" id="mulaiAbsensi" name="mulaiAbsensi">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mulai Masuk</label>
                  <input type="text" class="form-control time" id="mulaiMasuk" name="mulaiMasuk">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mulai Pulang</label>
                  <input type="text" class="form-control time" id="mulaiPulang" name="mulaiPulang">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Expired QR Code</label>
                  <input type="text" class="form-control time" id="ExpiredQR" name="ExpiredQR">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-primary" id="simpan">Simpan Perubahan</button>
              </div>
            </form>
          </div>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).ready(function(){
      getdata();
      $('.time').datetimepicker({
          format: 'HH:mm:ss'
      });

      $('#simpan').click(function(event) {
          var formData = $('form').serialize();
            $.ajax({
                url:'<?=base_url("Cpengaturan/updatePengaturan")?>',
                method:'POST',
                data:formData,
                dataType:'json',
                beforeSend:function(){  
                    $('#status').html('<span class="text-info">Loading response...</span>');  
                },
                success: function(data) {
                    getdata();
                    $('#status').fadeIn().html('<span class="text-orange">'+data['msg']+'</span>');
                    setTimeout(function(){  
                      $('#status').fadeOut("slow");  
                    }, 2000);
                }
            });
        });


      function getdata() {
        $.ajax({
          url: '<?=base_url("Cpengaturan/loadPengaturan")?>',
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            $.each(data,function(id,nama_perusahaan,alamat,mulai_absensi,mulai_masuk,mulai_pulang,timeoutQR) {
              $('#id').val(data.id);
              $('#namaperusahaan').val(data.nama_perusahaan);
              $('#alamat').val(data.alamat);
              $('#mulaiAbsensi').val(data.mulai_absensi);
              $('#mulaiMasuk').val(data.mulai_masuk);
              $('#mulaiPulang').val(data.mulai_pulang);
              $('#ExpiredQR').val(data.timeoutQR);
            });
          }
        })
        
      }
    });
  </script>
