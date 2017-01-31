<?php
	
	class Article extends CI_Controller

	{

		public function id() 

		{

			$this->load->model('Article_model','article'); //调用模型，Article_model是article_model.php中的类名，后面的article是调用后形成的别名，方便控制器使用

			$data=$this->article->getonearticle($this->uri->segment(3)); //调用模型中的getonearticle方法，传递一个参数，返回结果是一个对象，不是数组

			if($this->db->affected_rows()==0) {

				$res['found']=false; //affected_rows()==0 表示没有查询到数据
			
			}

			else

			{

				$res['found']=true;

				$res['data']=$data[0]; //查询到数据后把数据附加到$res数组中

			}

			$this->load->view('header');

			$this->load->view('article',$res); //把数据传递给视图

			$this->load->view('footer');
		
	
		}

/*		public function cf() //用于一次性数据转换，将原来数据库中的UploadFiles文件夹前加一个\，不可再用了

		{

			$this->load->model('Article_model','article');

			$wa=$this->db->get('article'); //获取整个article表

			foreach ($wa->result() as $row) {

				$cbdata['content']=str_replace("UploadFiles","\UploadFiles",$row->content);

				$cbdata['defaultpic']=str_replace("UploadFiles","\UploadFiles",$row->defaultpic);

				$cbdata['uploadfiles']=str_replace("UploadFiles","\UploadFiles",$row->uploadfiles);

				echo $this->article->changeback($row->articleid, $cbdata);
				
			}

		}
*/

		public function search ()

		{

			$this->load->model('Article_model', 'article'); //载入Article_model模型，起别名article

			$this->load->helper('url');

			if ($this->input->post('forsearching') !== NULL)

			{

				$keyword = $this->input->post('forsearching'); //接收来自header.php搜索框的数据

			}

			else

			{

				$keyword= urldecode($this->uri->segment(3)); //从第二页开始，post方式已经没有值了(NULL)，只能放在url第3段来传递搜索关键字，中文的话会有乱码，所以用urldecode()来解码

			}

			$startwith=intval($this->uri->segment(4));

			$data=$this->article->getmorearticle($keyword, $startwith); //调用Article_model的getmorearticle方法，把接收的数据$keyword传过去，用$data接收查询到的数据，$data是一个对象

			$this->load->library('pagination');//载入分页类

			$config['base_url'] = site_url('article/search/').$keyword.'/'; //生成分页类的url，其中这个$keyword来源有两个途径，一个是首次在搜索框中输入的，就是上面的$this->input->post('forsearching')，来自header表单提交的数据，第二个途径是分页到第2页时，$this->input->post('forsearching')的数据为NULL，所以设置在$this->uri->segment(3)上，作为url方式的传值，类似传统的GET方式

			$config['total_rows'] = $data['found'];//model中进行了两次查询，第一次查询全部的总数用于设定分页时的总数项

			$config['per_page'] = 20; //每页20条信息

			$this->pagination->initialize($config);

			$res['links'] = $this->pagination->create_links(); //把生成的links放到传递数组中

			$res['keyword'] = $keyword;

			if($this->db->affected_rows()==0) {

				$res['found']=false; //affected_rows()==0 表示没有查询到数据
			
			}

			else

			{

				$res['found']=true;

				$res['data']=$data['data']; //查询到数据后把数据附加到$res数组中

			}

			$this->load->view('header');

			$this->load->view('articlefound',$res); //把数据传递给视图articlefound

			$this->load->view('footer');

		}

	}
?>
