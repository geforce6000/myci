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

			$keyword = $this->input->post('forsearching'); //接收来自header.php搜索框的数据

			$this->load->model('Article_model', 'article'); //载入Article_model模型，起别名article

			$data=$this->article->getmorearticle($keyword); //调用Article_model的getmorearticle方法，把接收的数据$keyword传过去，用$data接收查询到的数据，$data是一个对象

			if($this->db->affected_rows()==0) {

				$res['found']=false; //affected_rows()==0 表示没有查询到数据
			
			}

			else

			{

				$res['found']=true;

				$res['data']=$data; //查询到数据后把数据附加到$res数组中

			}

			$this->load->view('header');

			$this->load->view('articlefound',$res); //把数据传递给视图articlefound

			$this->load->view('footer');


		}
	}
?>
