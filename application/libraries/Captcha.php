<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha{
	
	private $optn;
	
	public function __construct($option = null){

		$this->optn = ($option != null) ? $option : array(
			'word'          => '',
			'img_path'      => 'assets/img/captcha/',
			'img_url'       => base_url() .'assets/img/captcha/',
			'font_path'     => 'assets/fonts/Articula.ttf',
			'img_width'     => '250',
			'img_height'    => 80,
			'expiration'    => 7200,
			'word_length'   => 6,
			'font_size'     => 30,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(0, 0, 0),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
	}
	
	public function generate(){
		$captcha = create_captcha($this->optn);
		$captcha['image_url'] = $this->optn['img_url'].$captcha['filename'];
		return $captcha;
	} 
}