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
    function getImageByName($path){
        $query = $this->db->query("SELECT * FROM photo where photo.path='$path' ");
        return $query->result();
    }
    function getImageAll(){
        $query = $this->db->query("SELECT * FROM photo ORDER BY id DESC ");
        return $query->result();
    }
    function getImageByUser($user){
        $query = $this->db->query("SELECT * FROM photo where photo.id_user='$user' ");
        return $query->result();
    }

    function getUserByUser($user){
        $query = $this->db->query("SELECT * FROM user where user.username='$user' ");
        return $query->result();
    }
    function getUserById($id){
        $query = $this->db->query("SELECT * FROM user where user.id='$id' ");
        return $query->result();
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
            'uid' => $masuk->id,
            'username'  => $masuk->username,
            'email'     => $masuk->email,
            'fullname'  => $masuk->fullname,
            'loggedIn'  => TRUE
        );
        $this->session->set_userdata($sesi);
    }
    function addPhoto($id,$imgname){
        $masuk['id_user'] = $id;
        $masuk['path'] = $imgname;
        return $this->db->insert('photo',$masuk);
    }
    function addCaption($uid,$pid,$caption){
        $masuk['user_id'] = $uid;
        $masuk['photo_id'] = $pid;
        $masuk['testimony'] = $caption;
        return $this->db->insert('testi',$masuk);
    }
    function getCaption($imgid){
        $query = $this->db->query("SELECT * FROM testi where photo_id='$imgid' ");
        return $query->result();
    }
}