<?php

class Photo extends CI_Controller{
    /**
     * @var array : merupakan list effect yang kita miliki pada class Effects
     */
    public $kategori = ['colorise','sepia','sharpen','emboss','cool','old','light','aqua','fuzzy','boost','gray'];

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
        $config['max_size']	= '10000';                // filesize maksimal (dalam Kilo Byte)
        $config['max_width']  = '4000';             // maksimal lebar gambar (dalam pixel)
        $config['max_height']  = '3000';             // maksimal lebar gambar (dalam pixel)

        // mengambil ekstensi file
        $file_ext = explode('.', $_FILES['userfile']['name']);  // memisahkan nama dan ekstensi file
        $file_ext = strtolower(end($file_ext));                 // mengambil ekstensi file;

        // membuat filename baru, disini dibuat filename dengan format [squhart--2014_04_21--18_29_26]
        $username = $this->session->userdata('username');   // memasukan data username dari session kedlm vari $username
        $uid = $this->session->userdata('uid');
        $waktu = date( 'Y_m_d--H_i_s' );                    // mengambil waktu dari zona waktu yang sudah ditetapkan
        $filename = $username.'--'.$waktu;                  // membuat filename baru dengan format yang sudah ditentukan


        $_FILES['userfile']['name'] = $filename.'.'.$file_ext;  //mengubah filename awal dengan ekstensinya
        $nama_sebenarnya = $_FILES['userfile']['name'];

        $this->load->library('upload', $config);    // meload library upload dengan configurasi yang sudah ditetapkan

        if ( ! $this->upload->do_upload() ){                            // jika file tidak bisa diupload
            $error = ['error' => $this->upload->display_errors()]; // ambil pesan error
            $this->load->view('upload_form', $error);                   // tampilkan pesan eror pada halaman eror

        }
        else{                                                           // jika file bisa di upload
            $data = [ 'upload_data' => $this->upload->data() ];         // ambil informasi data yang sudah diupload
            $conf = [
                'source_image' => "./uploads/$nama_sebenarnya",
                'maintain_ration' => true,
                'width' => '400',
                'height' => '400'
            ];
            $this->load->library('image_lib');
            $this->image_lib->initialize($conf);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $data = $data['upload_data'];

            $this->semua->addPhoto($uid,$data['orig_name']);

            redirect('photo/effect/'.$data['orig_name']);                // redirect ke halaman tambah effect

        }
    }

    function effect($imgname){
        $data['gambar'] = $imgname;
        $this->load->view('effect',$data);
    }
    function post(){
        $awal = $_POST['gambar'];
        $encodedData =  substr($awal,strpos($awal,",")+1);
        $decodedData = base64_decode($encodedData);

        $imgname = $this->input->post('imgname');
        $dir='./uploads/'.$imgname;

        file_put_contents($dir, $decodedData);

        $uid = $this->session->userdata('uid');
        $data = $this->semua->getImageByName($imgname);
        foreach ($data as $nilai) {
            $pid=$nilai->id;
        }
        
        $testi = $this->input->post('caption');
        $this->semua->addCaption($uid,$pid,$testi);

        redirect('home');
    }

    function caption($id){
        $caption = $this->input->post('caption');
        $uid = $this->session->userdata('uid');
        $this->semua->addCaption($uid,$id,$caption);
         redirect($_SERVER['HTTP_REFERER']);  
    }

}