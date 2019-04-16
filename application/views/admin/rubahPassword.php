    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> User</a></li>
        <li class="active">Rubah Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Rubah Password</h3> <small id="status"></small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Password Lama</label>
                  <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Password Lama">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password Baru</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password Baru">
                </div>
                <div class="form-group" id="form-confirm">
                  <label for="exampleInputPassword1">Konfirmasi Password Baru</label>
                  <input type="password" class="form-control" id="confirm_password" placeholder="Konfirmasi Password">
                </div>
                <div id="msg"></div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-default pull-right" id="simpan"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
      $('#simpan').hide();
      $(document).ready(function() {

        $('#simpan').click(function(event) {
          var formData = $('form').serialize();
          var pass = $('#new_password').val();
          var panjang = pass.length;
          if (panjang < 8) {
            swal('warning','Password minimal 8 karakter','warning');
          } else {
            $.ajax({
                url:'<?=base_url("user/updatePassword")?>',
                method:'POST',
                data:formData,
                dataType:'json',
                beforeSend:function(){  
                    $('#status').html('<span class="text-info">Loading response...</span>');  
                },
                success: function(data) {
                    console.log(formData)
                    reset();
                    $('#status').fadeIn().html('<span class="text-orange">'+data['msg']+'</span>');
                    setTimeout(function(){  
                      $('#status').fadeOut("slow");  
                    }, 2000);
                }
            });
          }
        });

        var cekPassword = $('#confirm_password').on('input',function() { // cek password
          var password = $('#new_password').val();
          var konfirmasi = $('#confirm_password').val();
          var error = '<span class="control-label text-orange"><i class="fa fa-bell"></i> Kata sandi tidak sama</span>';
          var success = '<span class="control-label text-green"><i class="fa fa-check"></i> Kata sandi cocok</span>';

          if (konfirmasi != password ) { // jika password tidak sama dengan kofirmasi
            $('#msg').html(error);
            $('#simpan').hide();
            $('#form-confirm').attr('class', 'form-group has-warning');
          } else { // jika benar maka akan menampilkan tombol simpan
            $('#msg').html(success);
            $('#simpan').show('slow');
            $('#form-confirm').attr('class', 'form-group has-success');
          }
        });

        function reset() {
          $('#new_password').val('');
          $('#old_password').val('');
          $('#confirm_password').val('');
          $('.form-group').attr('class', 'form-group');
          $('#msg').html('');
          $('#simpan').hide();
        }
        
        
      });
    </script>
