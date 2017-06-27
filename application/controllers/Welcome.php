<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()

	{
/*
		$query=$this->db->from('article')
			->select('articleid, title, content, updatetime')
			->order_by('articleid', 'DESC')
			->limit(1)
			->get();
*/

		$this->load->model('Nav_model', 'nav');
		//调用Nav_model模型，起别名nav

		$res=$this->nav->nav();

		$this->load->model('Article_model', 'article');

		$res['newslist']=$this->article->getarticlebyclass(97,0,3);

		$res['bulletin']=$this->article->getarticlebyclass(100,0,3);

		$res['education']=$this->article->getarticlebyclass(9,0,3);

		$res['announce']=$this->article->getarticlebyclass(2,0,3);

		$res['recruit']=$this->article->getarticlebyclass(107,0,5);

		$res['partywork']=$this->article->getarticlebyclass(82,0,5);

		$this->load->model('Admin_model', 'admin');

		$res['slidebox'] = $this->admin->slideboxforwelcome();

		$this->load->helper('url');

		//$this->load->view('header',$res);

		//$this->load->view('nav');

		//$this->load->view('welcome_message');

		//$this->load->view('footer');

		$this->load->view('homepage',$res);

	}

}

