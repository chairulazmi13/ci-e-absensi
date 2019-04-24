  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/img/ixls.png">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/img/ixlsx.png">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/img/xls.svg">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/img/xlsx.svg">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.1/xlsx.core.min.js"></script>
  <script src="https://fastcdn.org/FileSaver.js/1.1.20151003/FileSaver.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-chart"></i> Laporan</a></li>
        <li class="active">Laporan Absensi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header">
              <h4>Filter Laporan</h4>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pilih Bulan</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <select class="selectpicker form-control" id="bulan">
                        <option value="">-- Pilih --</option>
                        <option value="1">Janurai</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <!-- <p class="help-block">Pilih </p> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tahun</label>
                    <select class="selectpicker form-control" id="tahun">
                        <option value="">-- Pilih --</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                    <!-- <p class="help-block">Help text here.</p> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default pull-right" id="search">
                <i class="fa fa-search"></i> Cari
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-success box-report">
            <div class="box-header">
              <h4>Laporan Absensi</h4>
            </div>
            <div class="box-body" id="showReport" style="overflow-x:auto;">
            </div>
            <div class="box-footer">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
    $('.box-report').hide();
    $(document).ready(function(){
      $('#search').click(function(event) {
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $.ajax({
          url: '<?=base_url("Laporanabsensi/report")?>',
          type: 'POST',
          dataType : 'html',
          data: {bulan: bulan,tahun:tahun},
          beforeSend:function (){  
                  $('#showReport').html('<span class="text-info">Loading response...</span>');  
          },
          success: function (data) {
                  $('#showReport').fadeIn('slow').html(data);
                  $('.box-report').fadeIn('slow');
          }
        })
        
      });
    });
    </script>
