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

	//	$sql="select * from article where classid like ('64')";

	//	$query=$this->db->query($sql);

		$query=$this->db->from('article')
			->select('articleid, title, content, updatetime')
			->order_by('articleid', 'DESC')
			->limit(1)
			->get();

		$data['article']=$query->result_array();

		$data['summary']=$this->db->affected_rows();

		$this->load->view('header');

		$this->load->view('welcome_message',$data);

		$this->load->view('footer');

	}
}

