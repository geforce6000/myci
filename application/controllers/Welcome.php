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

		$this->load->model('Nav_model', 'nav');
		//调用Nav_model模型，起别名nav

		$navdata=$this->nav->nav();
		//取得全部导航条所用的数据，是一个多维数组
		//$navdata['parrent']是一个6元素的数组，内容是6条显示在导航条上的主要项目

		foreach ($navdata['parrent'] as $row)
		{
//			echo $navdata[$row->classid][0]->classname;
			$data['children'][$row->classid]=$navdata[$row->classid];
//			echo $data['children'][$row->classid][0]->classname."<br/>";
		}

		$data['parrent']=$navdata['parrent'];

//		echo $data['parrent'][0]->classid;
//		echo $data/*[$data['parrent'][0]->classid]*/['1'][0]->classname;

		$data['article']=$query->result_array();

		$this->load->helper('url');

		$this->load->view('header',$data);

		$this->load->view('nav');

		$this->load->view('welcome_message');

		$this->load->view('footer');

	}

}

