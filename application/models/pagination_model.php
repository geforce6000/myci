<?php

	class Pagination_model extends CI_model

	{

		public function mypagination ($data)

		{

			$this->load->library('pagination');//载入分页类

			$config['base_url'] = site_url($data['url']).$data['keyword'].'/';
			//生成分页类的url，其中这个$keyword来源有两个途径，一个是首次在搜索框中输入的，就是上面的$this->input->post('forsearching')，
			//来自header表单提交的数据，第二个途径是分页到第2页时，$this->input->post('forsearching')的数据为NULL，
			//所以设置在$this->uri->segment(3)上，作为url方式的传值，类似传统的GET方式
			
			$config['first_url'] = site_url($data['url']).$data['keyword'].'/0';
			//定义第1页强制从article/search/$keyword/0开始，避免从第2页回到第1页时因为segment(4)消失导致的搜索失败

			$config['total_rows'] = $data['total_rows'];
			//model中进行了两次查询，第一次查询全部的总数用于设定分页时的总数项

			$config['per_page'] = $data['per_page'];
			//每页20条信息

			$config['first_link'] = '首页';
			//不显示第一页标记
			
			$config['first_tag_open'] = '<li>';

			$config['first_tag_close'] = '</li>';

			$config['last_link'] = '尾页';
			//不显示最后一页标记
			
			$config['last_tag_open'] = '<li>';

			$config['last_tag_close'] = '</li>';

			$config['prev_link'] = FALSE;
			//不显示上一页标记

			$config['next_link'] = FALSE;
			//不显示下一页标记

			$config['full_tag_open'] = '<div class="pagination-centered"><ul class="pagination">';
			//加在整个分页链接前面的标记，这里加的是与Fundation5分页标记相配的html标记

			$config['full_tag_close'] = '</ul></div>';
			//加在整个分页链接最后的标记

			$config['num_tag_open'] = '<li>';
			//加在数字页码之前的标记

			$config['num_tag_close'] = '</li>';
			//加在数字页码之后的标记

			$config['cur_tag_open'] = '<li class="current"><a href="#">';
			//加在当前页码之前的标记

			$config['cur_tag_close'] = '</a></li>';
			//加在当前页码之后的标记
			
			//对分页类进行了更加详细的配置，给整个分页链接加上了<ul></ul>标记，给每一个数字链接加上了<li></li>标记
			//这样与Fundation5框架的分页功能就配合起来了

			$this->pagination->initialize($config);

			return $this->pagination->create_links();
		}

	}

?>