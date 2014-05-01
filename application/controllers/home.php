<?php

class Home extends CI_Controller {

    public $kategori = ['colorise','sepia','sharpen','emboss','cool','old','light','aqua','fuzzy','boost','gray'];

    // fungsi construct
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta'); // setting zona waktu ke WIB (jakarta)

        $sesi = $this->session->userdata('loggedIn'); // memindahkan data session[loggedIn] ke variable $sesi
        if( ! $sesi){                   // pengecekan sesi, jika data loggedIn tidak ada dalam sesi (FALSE),
            redirect('user/login');     // maka akan redirect ke user/login
        }

    }

    // fungsi halaman utama
	function index(){

		$data['title']='Pengugram'; // penambahan variable data['title'] untuk dikirim ke view menjadi title

		echo	$this->session->userdata('username');
		echo	$this->session->userdata('email');
		echo	$this->session->userdata('nama');

        $this->load->view('home',$data); // menampilkan view halaman home pada view dan mengirimkan variable $data

	}

    //fungsi halaman upload
	function upload(){
		$data['title']='Upload'; // judul pada title
		$this->load->view('upload_form',$data);
	}

    //fungsi halaman pemrosesan upload
	function do_upload(){
        // membuat variable config, yaitu berisi informasi tentang penguploadan foto
		$config['upload_path'] = './uploads/';      // folder tempat foto akan disimpan
		$config['allowed_types'] = 'gif|jpg|png';   // tipe gambar yang diperbolehkan
		$config['max_size']	= '100';                // filesize maksimal (dalam Kilo Byte)
		$config['max_width']  = '1024';             // maksimal lebar gambar (dalam pixel)
		$config['max_height']  = '768';             // maksimal lebar gambar (dalam pixel)

		// mengambil ekstensi file
		$file_ext = explode('.', $_FILES['userfile']['name']);  // memisahkan nama dan ekstensi file
		$file_ext = end($file_ext);                             // mengambil ekstensi file

		// membuat filename baru, disini dibuat filename dengan format [squhart--2014_04_21--18_29_26]
		$username = $this->session->userdata('username');   // memasukan data username dari session kedalam variable $username
		$waktu = date( 'Y_m_d--H_i_s' );                    // mengambil waktu dari zona waktu yang sudah ditetapkan
		$filename = $username.'--'.$waktu;                  // membuat filename baru dengan format yang sudah ditentukan


		$_FILES['userfile']['name'] = $filename.'.'.$file_ext;  //mengubah filename awal dengan ekstensinya

		$this->load->library('upload', $config);    // meload library upload dengan configurasi yang sudah ditetapkan diatas

		if ( ! $this->upload->do_upload() ){                            // jika file tidak bisa diupload
			$error = array('error' => $this->upload->display_errors()); // ambil pesan error
			$this->load->view('upload_form', $error);                   // tampilkan pesan eror pada halaman eror
		}
		else{                                                           // jika file bisa di upload
			$data = array( 'upload_data' => $this->upload->data() );    // ambil informasi data yang sudah diupload
			$data = $data['upload_data'];
            redirect('home/effect/'.$data['orig_name']);                // redirect ke halaman tambah effect
		}
	}

    function effect($img_name){

        $file_ext = explode('.', $img_name);  // memisahkan nama dan ekstensi file
        $file_ext = end($file_ext);
        $path = base_url().'uploads/'.$img_name;


        $this->load->library('image_lib');
        foreach ($this->kategori as $kategori) {
            $config = [
                'source_image' => $path,
                'new_image' => "./uploads/thumbs/$kategori". '-' . $img_name,
                'maintain_ration' => true,
                'width' => '150px',
                'height' => '150px'
            ];

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        $data = [
            'link1' => site_url("home/addEffect/$img_name/colorise/$file_ext"),
            'link2' => site_url("home/addEffect/$img_name/sepia/$file_ext"),
            'link3' => site_url("home/addEffect/$img_name/sharpen/$file_ext"),
            'link4' => site_url("home/addEffect/$img_name/emboss/$file_ext"),
            'link5' => site_url("home/addEffect/$img_name/cool/$file_ext"),
            'link6' => site_url("home/addEffect/$img_name/old/$file_ext"),
            'link7' => site_url("home/addEffect/$img_name/light/$file_ext"),
            'link8' => site_url("home/addEffect/$img_name/aqua/$file_ext"),
            'link9' => site_url("home/addEffect/$img_name/fuzzy/$file_ext"),
            'link10' => site_url("home/addEffect/$img_name/boost/$file_ext"),
            'link11' => site_url("home/addEffect/$img_name/gray/$file_ext")
        ];
        $this->load->view('effect',$data);
    }

    function addEffect($img_name,$effect = colorise,$file_ext){
        $this->load->library('effects');
        $path = base_url().'uploads/'.$img_name;

        switch($file_ext){
            case 'gif' : $gambar = imagecreatefromgif($path); break;
            case 'jpeg' : $gambar = imagecreatefromjpeg($path); break;
            case 'png' : $gambar = imagecreatefrompng($path); break;
        }

        $this->effects->add_effect($gambar,$effect);
        imagejpeg($gambar,"./uploads/$img_name");


    }


}