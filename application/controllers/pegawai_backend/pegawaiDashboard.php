<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawaiDashboard extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('pegawai_login') == 0){
  		redirect(base_url('pegawai-login'));
  	}

  	$this->load->model('mPegawai');

  }

  function index()
  {
  	$this->load->view('template/header_pegawai');
    $this->load->view('pegawai/dashboard');
    $this->load->view('template/footer_pegawai');
  }

  function appsview()
  {
    $this->load->view('template/header_pegawai_x');
    $this->load->view('pegawai/dashboard');
    $this->load->view('template/footer_pegawai');
  }

  function gerateQrCode()
  {
        $id_pegawai = $this->input->post('id_pegawai');
        $nip = $this->input->post('nip');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $ip2long = ip2long($ip_address);

        // mengkofersi ip address ke long integer
        $qrcode = $nip.$ip2long;

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$nip.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $qrcode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->load->helper("file");
        $path = $config['imagedir'].$image_name;
        delete_files($path);
        $this->mPegawai->generateQR($id_pegawai,$image_name); //simpan ke database

        $response['img'] = $path;
        $response['msg'] = 'generate QR Code success !';

        echo json_encode($response);
  }

  function cobaqr(){
    $qrcode = '311111111111111000-1062731515';

    $nip = substr($qrcode,0,18);
    $ip = ltrim($qrcode,$nip);

    $ip_address = long2ip($ip);

    echo $nip.'<br>'.$ip_address;
  }
}
