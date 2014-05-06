<?php

class Semua extends CI_Model {
    public $details;

	function validasi($username,$password){
        $this->db->from( 'user' );
        $this->db->where( 'username', $username );
        $this->db->where( 'password', sha1($password) );
        $login = $this->db->get()->result();
        if ( is_array($login) && count($login) == 1 ) {
            $this->details = $login[0];
            $this->set_session();

            return TRUE;
        }
		return FALSE;
	}

	function register($info){
		$masuk['username'] = $info['username'];
		$masuk['email'] = $info['email'];
		$masuk['fullname'] = $info['fullname'];
		$masuk['password'] = sha1($info['password']);
		return $this->db->insert('user',$masuk);
	}
    function set_session(){
        $masuk = $this->details;
        $sesi = array(
            'username'  	=> $masuk->username,
            'email'     	=> $masuk->email,
            'fullname'  	=> $masuk->fullname,
            'loggedIn'	=> TRUE
        );
        $this->session->set_userdata($sesi);
    }
    function upload($path,$uid){

    }
}