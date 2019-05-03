  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header content-justify">
      <h1>
        Profile Pegawai
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-md-12">
        <div class="box-body box-profile">
          <div class="box box-primary">
            <div class="box-header">
              <img class="profile-user-img img-responsive img-circle" src="<?=base_url()?>/assets/dist/img/user.jpg" alt="User profile picture">
              <h3 class="profile-username text-center"><?=$this->session->userdata('p_nama');?></h3>
              <p class="text-muted text-center"><?=$this->session->userdata('p_nama_jabatan');?></p>
              <p class="text-muted text-center">(<?=$this->session->userdata('p_nama_divisi');?>)</p>      
            </div>
            <div class="box-body box-profile">

              <strong><i class="fa fa-book margin-r-5"></i> Alamat IP</strong>
                <p class="text-muted"><?php echo $_SERVER['REMOTE_ADDR'];?> </p>
              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> NIP</strong>
                <p class="text-muted"><?=$this->session->userdata('p_nip');?></p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
                <p class="text-muted"><?=$this->session->userdata('p_kota');?>,<?=$this->session->userdata('p_alamat');?></p>
              <hr>
            <div class="box-footer">
              <a href="<?=base_url('pegawai-logout');?>" class="btn btn-warning btn-block"><b>Log out</b></a>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
      $(document).ready(function(){

 

      });
    </script>
