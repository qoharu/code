<?php

/**
 * Class Home
 */
class Home extends CI_Controller {



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

        $gambar = $this->semua->getImageAll();
        $data['gambar'] = $gambar;
   
        $this->load->view('home',$data); // menampilkan view halaman home pada view dan mengirimkan variable $data

	}


}