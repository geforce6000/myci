<?php
	
	class Article extends CI_Controller

	{

		public function id() 

		{ //根据articleid调取一条记录并返回给article视图显示

			$this->load->model('Article_model','article'); //调用模型，Article_model是article_model.php中的类名，后面的article是调用后形成的别名，方便控制器使用

			$data=$this->article->getarticlebyid($this->uri->segment(3)); //调用模型中的getonearticle方法，传递一个参数，返回结果是一个对象，不是数组

			$this->load->model('Nav_model', 'nav');
			//调用Nav_model模型，起别名nav

			$res=$this->nav->nav();

			if($this->db->affected_rows()==0) {

				$res['found']=false; //affected_rows()==0 表示没有查询到数据
			
			}

			else

			{

				$res['found']=true;

				$res['data']=$data[0]; //把查询到的数据传到$res数组中

			}

			$this->load->helper('url');

			$this->load->view('header');

			$this->load->view('nav',$res);

			$this->load->view('article'); //把数据传递给视图

			$this->load->view('footer');
		
	
		}
/*
		public function cf()

		{ //用于一次性数据转换，将原来数据库中的UploadFiles文件夹前加一个\，不可再用了

			$this->load->model('Article_model','article');

			$wa=$this->db->get('article'); //获取整个article表

			foreach ($wa->result() as $row)

			{

				$cbdata['content']=str_replace("UploadFiles","\UploadFiles",$row->content);

				$cbdata['defaultpic']=str_replace("UploadFiles","\UploadFiles",$row->defaultpic);

				$cbdata['uploadfiles']=str_replace("UploadFiles","\UploadFiles",$row->uploadfiles);

				echo $this->article->changeback($row->articleid, $cbdata);
				
			}

		}

*/
		public function search ()

		{ //根据搜索关键字查询记录返回articlefound视图，每20条视图做一次分页

			$this->load->model('Article_model', 'article'); //载入Article_model模型，起别名article

			$this->load->helper('url');

			$this->load->model('Nav_model', 'nav');
			//调用Nav_model模型，起别名nav

			$res=$this->nav->nav();

			if(($this->input->post('forsearching') == NULL) and ($this->uri->segment(4) == NULL))

			{

			//如果$this->input->post('forsearching')和$this->uri->segment(4)均为NULL值，
			//表明搜索框没有输入内容，segment(4)段也不存在，避免了不输入内容就点击搜索按钮导致搜索出全部文章
			//从而导致分类页的混乱

				$res['found']=false;

				$this->load->view('header');

				$this->load->view('nav',$res);

				$this->load->view('articlefound'); //把数据传递给视图articlefound

				$this->load->view('footer');

			}

			else

				{

					if ($this->input->post('forsearching') !== NULL)

				{

					$keyword = $this->input->post('forsearching'); //接收来自header.php搜索框的数据

				}

				else

				{

					$keyword = urldecode($this->uri->segment(3));
					//从第二页开始，post方式已经没有值了($this->input->post('forsearching') == NULL)，
					//只能放在url第3段来传递搜索关键字，中文的话会有乱码，所以用urldecode()来解码

				}

				$startwith=intval($this->uri->segment(4));

				$data=$this->article->searchbykey($keyword, $startwith); 
				//调用Article_model的searchbykey方法，把接收的数据$keyword和$startwith(搜索偏移位置)传过去，
				//用$data接收查询到的数据，$data是一个对象

				$this->load->library('pagination');//载入分页类

				$config['base_url'] = site_url('article/search/').$keyword.'/';
				//生成分页类的url，其中这个$keyword来源有两个途径，一个是首次在搜索框中输入的，就是上面的$this->input->post('forsearching')，
				//来自header表单提交的数据，第二个途径是分页到第2页时，$this->input->post('forsearching')的数据为NULL，
				//所以设置在$this->uri->segment(3)上，作为url方式的传值，类似传统的GET方式
				
				$config['first_url'] = site_url('article/search/').$keyword.'/0';
				//定义第1页强制从article/search/$keyword/0开始，避免从第2页回到第1页时因为segment(4)消失导致的搜索失败

				$config['total_rows'] = $data['found'];
				//model中进行了两次查询，第一次查询全部的总数用于设定分页时的总数项

				$config['per_page'] = 20;
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

				$res['links'] = $this->pagination->create_links();
				//把生成的links放到传递数组中

				$res['keyword'] = $keyword;

				if($this->db->affected_rows()==0) {

					$res['found']=false;
					//没有查到数据
				
				}

				else

				{

					$res['found']=true; //有查到数据

					$res['datascale']=$data['found']; //整个表中符合条件的记录总数

					$res['startwith']=$startwith; //本页20条记录起始位置

					$res['endwith']=$startwith+$this->db->affected_rows(); //本页记录的终点位置

					$res['data']=$data['data']; //查询到数据后把数据附加到$res数组中

				}

				$this->load->view('header');

				$this->load->view('nav',$res);

				$this->load->view('articlefound'); //把数据传递给视图articlefound

				$this->load->view('footer');

			}

		}

		public function category ()

		{ //根据文章的classid来显示相关分类的文章，还没做分页

			$this->load->helper('url');

			$this->load->model('Article_model', 'article'); //调用Article_model模型，用article做别名

			$this->load->model('Nav_model', 'nav');
			//调用Nav_model模型，起别名nav

			$res=$this->nav->nav();
			//获取导航条数据

			$articleclass=$this->uri->segment(3);

			$data=$this->article->getarticlebyclass($articleclass); //调用Article_model模型中的getarticlebyclass方法

			if($data['found']==0) 

			{

				$res['found']=false; //affected_rows()==0 表示没有查询到数据
			
			}

			else

			{

				$res['found']=true;

				$res['data']=$data['data']; //查询到数据后把数据附加到$res数组中

				$res['navlink']=$data['navlink'];

			}

			$this->load->view('header');

			$this->load->view('nav',$res);

			$this->load->view('articlebyclass'); 

			$this->load->view('footer');

		}
/*
		public function cg ()

		{ //临时用于改写部分文章的classid，将article中原classid=segment(3)的改为segment(4)

			$oldid=$this->uri->segment(3);

			$newid=$this->uri->segment(4);
			
			echo "oldid: $oldid<br/>";
			
			echo "newid: $newid<br/>";
			
			$data = array('classid' => $newid);

			$this->db->where('classid', $oldid);
			
			$this->db->update('article', $data);
			
			echo 'affected_rows: '.$this->db->affected_rows();
		
		}
*/
	}

?>
