<?php
/**
 * Created by IntelliJ IDEA.
 * User: squhart
 * Date: 5/5/2014
 * Time: 9:57 PM
 */

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

            redirect('photo/effect/'.$data['orig_name']);                // redirect ke halaman tambah effect
        }
    }


    /**
     * halaman untuk memberikan efek pada gambar yang sudah di upload
     * @param $img_name : parameter untuk nama gambar yang akan di berikan effect
     */
    function effect($img_name){
        $this->load->library('image_lib');

        $file_ext = explode('.', $img_name);  // memisahkan nama dan ekstensi file
        $file_ext = strtolower(end($file_ext));

        foreach($this->kategori as $cat) {
            $nama = $cat;
            $namanya = "$nama-$img_name";
            $config = [
                'source_image' => "./uploads/$img_name",
                'new_image' => "./uploads/thumbs/$namanya",
                'maintain_ration' => true,
                'width' => '300',
                'height' => '300'
            ];

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $this->addEffectThumbs($namanya,$nama,$file_ext);

            //sekalian membuat link dan alamat gambar kedalam array untuk nanti di tampilkan pada halaman
            $data['link'][$nama] = site_url("photo/addEffect/$img_name/$nama/$file_ext");
            $data['gambar'][$nama] = base_url("uploads/thumbs/$namanya");
        }

        $this->load->view('effect',$data);

    }

    /**
     * fungsi yang digunakan untuk memberikan efek pada gambar
     * @param $img_name : nama gambar
     * @param $effect : efek yang akan dipakai
     * @param $file_ext : ekstensi file gambar
     */
    function addEffect($img_name,$effect = colorise,$file_ext){
        $this->load->library('effects');
        $path = base_url().'uploads/'.$img_name;

        switch($file_ext){
            case 'gif' : $gambar = imagecreatefromgif($path); break;
            case 'jpeg' : $gambar = imagecreatefromjpeg($path); break;
            case 'jpg' : $gambar = imagecreatefromjpeg($path); break;
            case 'png' : $gambar = imagecreatefrompng($path); break;
        }

        $this->effects->add_effect($gambar,$effect);
        switch($file_ext){
            case 'gif' : imagegif($gambar,"./uploads/$img_name"); break;
            case 'jpeg' : imagejpeg($gambar,"./uploads/$img_name"); break;
            case 'jpg' : imagejpeg($gambar,"./uploads/$img_name"); break;
            case 'png' : imagepng($gambar,"./uploads/$img_name"); break;
        }

        $data['gambar'] = $path;
        $data['nama'] = $img_name;

        $this->load->view('caption',$data);

    }

    /**
     * fungsi yang digunakan untuk memberi efek pada thumbnails gambar pada halaman pemilihan efek.
     * @param $img_name : nama gambar
     * @param $effect : efek yang akan diterapkan
     * @param $file_ext : ekstensi gambar
     */
    function addEffectThumbs($img_name,$effect = colorise,$file_ext){
        $this->load->library('effects');
        $path = base_url().'uploads/thumbs/'.$img_name;

        switch($file_ext){
            case 'gif' : $gambar = imagecreatefromgif($path); break;
            case 'jpeg' : $gambar = imagecreatefromjpeg($path); break;
            case 'jpg' : $gambar = imagecreatefromjpeg($path); break;
            case 'png' : $gambar = imagecreatefrompng($path); break;
        }

        $this->effects->add_effect($gambar,$effect);

        switch($file_ext){
            case 'gif' : imagegif($gambar,"./uploads/thumbs/$img_name"); break;
            case 'jpeg' : imagejpeg($gambar,"./uploads/thumbs/$img_name"); break;
            case 'jpg' : imagejpeg($gambar,"./uploads/thumbs/$img_name"); break;
            case 'png' : imagepng($gambar,"./uploads/thumbs/$img_name"); break;
        }

    }

}