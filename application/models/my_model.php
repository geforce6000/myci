<?php

	class My_model extends CI_model

	{

		public function mypagination ($data)

		{ //把CI的分页类做了一个封装，免得每次在控制器中调用都需要复制一堆初始化代码，现在只需要载入模型，调用方法时传4个参数，即可得到分页链接
            //$data['url'] = 控制器/方法名称 （URL中的第1和第2段）
            //$data['keyword'] = 关键字 （URL中第3段）
            //$data['total_rows'] = 总记录数
            //$data['per_page'] = 每页记录数

			$this->load->library('pagination');//载入分页类

			$config['base_url'] = site_url($data['url']).$data['keyword'].'/';
			
			$config['first_url'] = site_url($data['url']).$data['keyword'].'/0';

			//定义第1页强制从article/search/$keyword/0开始，避免从第2页回到第1页时因为segment(4)消失导致的搜索失败

			$config['total_rows'] = $data['total_rows'];

			$config['per_page'] = $data['per_page'];

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