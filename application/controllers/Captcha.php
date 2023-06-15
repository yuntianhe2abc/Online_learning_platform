<?php
defined('BASEPATH') OR exit('your exit message');
class Captcha extends CI_Controller
{function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('captcha');
}
public function index()
{
    $this->load->helper('captcha');
    $vals = array(
    //'word'          => 'Randdfdom word',
    'img_path'      => './uploads/captcha/',
    'img_url'       => base_url().'uploads/captcha/',
    'font_path'     => './path/to/fonts/texb.ttf',
    'img_width'     => '150',
    'img_height'    => 30,
    'expiration'    => 7200,
    'word_length'   => 6,
    'font_size'     => 16,
    'img_id'        => 'Imageid',
    'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

    // White background and border, black text and red grid
    'colors'        => array(
            'background' => array(255, 255, 255),
            'border' => array(255, 255, 255),
            'text' => array(0, 0, 0),
            'grid' => array(255, 40, 40)
            )
    );

    $cap = create_captcha($vals);
    $image= $cap['image'];
    echo $cap['image'];
    $captchaword= $cap['word'];
    $this->session->set_userdata('captchaword',$captchaword);
    // $this->load->view('index',['captcha_image'=>$image]);
}
    
}