<?php

class User extends CI_Controller{

    public $username;
    // halaman utama pada controller user
    function __construct(){
    	parent::__construct();
    	$this->username = $this->session->userdata('username');
    }

	function index(){
		$sesi = $this->session->userdata('loggedIn');
		if(  $sesi){
			redirect('home');       // jika sudah login, redirect ke ke halaman home
		}else{
            redirect('user/login'); // jika belum login, redirect ke halaman login
        }
	}


	function register(){
        $sesi = $this->session->userdata('loggedIn');
        if(  $sesi){
            redirect('home');       // jika sudah login, redirect ke ke halaman home
        }

        // pembuatan rules untuk form validation
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		$data['title']='register';

		if( $this->form_validation->run() == FALSE ){
			$this->load->view('register',$data);
		}
		else{
			$userInfo=$this->input->post();
			if( count($userInfo) ) {
		    	$saved = $this->semua->register($userInfo);
			}
			if ( isset($saved) && $saved ) {
				redirect('home');
	    	}
		}

	}

	function login(){
        $sesi = $this->session->userdata('loggedIn');
        if( $sesi){
            redirect('home');       // jika sudah login, redirect ke ke halaman home
        }

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['title']='Login';
	
		if( $this->form_validation->run() == FALSE ){
			$this->load->view('login',$data);
		}else{
			if( $this->semua->validasi($username,$password) ){
				redirect('home');
			}
	    }
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('home');
	}

	function profile($user = ""){
		if(empty($user)){
			$user = $this->username;
		}
		$user = $this->semua->getUserbyUser($user);

        foreach ($user as $nilai) {
        	$data = [	'uid' => $nilai->id,
        				'username' => $nilai->username,
						'email' => $nilai->email,
						'fullname' => $nilai->fullname
					];
        }

		$uid = $data['uid'];
		$gambar = $this->semua->getImageByUser($uid);
		$data['gambar'] = $gambar;

		$this->load->view('profile',$data);

	}	
}