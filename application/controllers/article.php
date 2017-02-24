<?php
	
	class Article extends CI_Controller

	{

		public function id() 

		{ //根据articleid调取一条记录并返回给article视图显示

			$this->load->model('Article_model','article'); //调用模型，Article_model是article_model.php中的类名，后面的article是调用后形成的别名，方便控制器使用

			$data=$this->article->getArticlebyId($this->uri->segment(3)); //调用模型中的getArticlebyId方法，传递一个参数，返回结果是一个对象，不是数组

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
			
			$this->load->view('header');

			$this->load->view('nav',$res);

			$this->load->view('articlebyid'); //把数据传递给视图

			$this->load->view('footer');
		
	
		}

		public function cf()

		{ //用于一次性数据转换，将原来数据库中的UploadFiles文件夹前加一个\，不可再用了

			$this->load->model('Article_model','article');

			$wa=$this->db->get('article'); //获取整个article表

			foreach ($wa->result() as $row)

			{

				$cbdata['content']=str_replace("\UploadFiles","\jjkjzz\UploadFiles",$row->content);

				$cbdata['defaultpic']=str_replace("\UploadFiles","\jjkjzz\UploadFiles",$row->defaultpic);

				$cbdata['uploadfiles']=str_replace("\UploadFiles","\jjkjzz\UploadFiles",$row->uploadfiles);

				echo $this->article->changeback($row->articleid, $cbdata);
				
			}

		}


		public function search ()

		{ //根据搜索关键字查询记录返回articlefound视图，每20条视图做一次分页

			$this->load->model('Article_model', 'article'); //载入Article_model模型，起别名article

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

				$data=$this->article->searchArticlebyKey($keyword, $startwith); 
				//调用Article_model的searchbykey方法，把接收的数据$keyword和$startwith(搜索偏移位置)传过去，
				//用$data接收查询到的数据，$data是一个对象
				
				$this->load->model('My_model', 'pagi');
				//把分页类的配置代码做成一个分页模型，便于重复调用

				$paginationinfo = array(
						'url' => 'article/search/',
						'keyword' => $keyword,
						'per_page' => 20,
						'total_rows' => $data['total_rows']);
				//配置分页类所需要的4个参数，做成数组供分页模型使用

				$res['links'] = $this->pagi->mypagination($paginationinfo);
				//调用分页模型中的mypagination方法，把数组做为参数传递，返回值是一个适配fundation前端框架的字符串，直接在页面中echo即可

				$res['keyword'] = $keyword;

				if($this->db->affected_rows()==0)

				{

					$res['found']=false;
					//没有查到数据
			
				}

				else

				{

					$res['found']=true; //有查到数据

					$res['datascale']=$data['total_rows']; //整个表中符合条件的记录总数

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

		{ //根据文章的classid来显示相关分类的文章，一页20篇，带分页

			$this->load->model('Article_model', 'article'); //调用Article_model模型，用article做别名

			$this->load->model('Nav_model', 'nav');
			//调用Nav_model模型，起别名nav

			$res=$this->nav->nav();
			//获取导航条数据

			$articleclass=$this->uri->segment(3);

			if ($this->uri->segment(4) == NULL)

			{

				$startwith=0;

			}

			else

			{

				$startwith=intval($this->uri->segment(4));

			}

			$data=$this->article->getArticlebyClass($articleclass, $startwith, 20); //调用Article_model模型中的getarticlebyclass方法

			$this->load->model('My_model', 'pagi');

			$paginationinfo = array(
					'url' => 'article/category/',
					'keyword' => $articleclass,
					'per_page' => 20,
					'total_rows' => $data['total_rows']);
			//配置分页类所需要的4个参数			

			$res['links'] = $this->pagi->mypagination($paginationinfo);
			//调用分页类

			if($data['total_rows']==0) 

			{

				$res['found']=false; //$data['total_rows']==0 表示没有查询到数据
			
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

		public function email()

		{ //邮件类测试成功，不过如果要用的话，需要申请一个新的工作邮箱，现在这个用的是自己邮箱
		  //如果将来要用，也可以像分页类那样做成自己的模型方法来调用，估计需要传递的参数包括
		  //发件人，收件人，主题，内容这4项
			
			$this->load->library('email');

			$config['protocol'] = 'smtp';

			$config['smtp_host'] = 'ssl://smtp.qq.com';

			$config['smtp_user'] = 'geforce6000@qq.com'; 
			//一般是发件邮箱

			$config['smtp_pass'] = 'mrhecziuqwavbhab';
			//去QQ邮箱设置开启smtp后，QQ邮箱会给一个16位的第三方客户端密码填在这里
			
			$config['smtp_port'] = 465;
			
			$config['smtp_timeout'] = 30;
			
			$config['mailtype'] = 'text';
			
			$config['charset'] = 'utf-8';
			
			$config['wordwrap'] = TRUE;
			
			$this->email->initialize($config);
			
			$this->email->set_newline("\r\n");
			
			$config['crlf'] = "\r\n";
			
			$this->email->from('geforce6000@qq.com', '杨威利'); 
			//填在邮件里的发件人邮箱和发件人名字
			
			$this->email->to('geforce6000@qq.com'); 
			//收件人邮箱

			$this->email->subject('Email Test'); 
			//邮件主题
			
			$this->email->message('Testing the email class.'); 
			//邮件内容
			
			$this->email->send(); 
			//发送！
			
			return $this->email->print_debugger();

		}
*/

		public function showChildCategory ()

		{ //根据post进来的ID做为父ID，查询到该ID对应的全部子ID返回

			$parrentcategory = $this->input->post('id');

			$this->load->model('Article_model', 'article');

			$data = $this->article->getCategorybyParrentid($parrentcategory);

			$this->session->set_userdata('parrentcategory', $parrentcategory);

			foreach ($data as $row)

			{

				echo "<option value=\"".$row->classid."\">".$row->classname."</option>";

			}

		}

		public function showArticleinTable ()

		{ //根据POST进来的ID作为classid，查询相关文章10篇显示在table中

			$childrencategory = $this->input->post('id');

			$this->load->model('Article_model', 'article');

			$data = $this->article->getArticleforAdmin($childrencategory);

			$this->session->set_userdata('childrencategory', $childrencategory);

			echo $data;

		}

		public function articleEdit ()

		{ //根据segment(3)传入的ID编号来编辑一篇文章，或者在segment(3)为NULL的情况下新建一篇文章

			//$this->load->helper('url');

			$this->load->model('Article_model','article'); 
			//调用模型，Article_model是article_model.php中的类名，后面的article是调用后形成的别名，方便控制器使用
			
			if ($this->uri->segment(3) <> NUll)

			{ //segment(3)不为NULL，表示编辑已存在的文章

				$data=$this->article->getArticlebyId($this->uri->segment(3)); 
				//调用模型中的getonearticle方法，传递一个参数，返回结果是一个对象，不是数组
				//$this->uri->segment(3)是传入的文章articleid

				$res['data']=$data[0]; 

				$parrentid=$this->article->getParrentidbyChild($res['data']->classid);
				//获取文章class的父classid
				
				$res['parrentid']=$parrentid[0]->parrentid;

				$res['parrentcategory']=$this->article->getCategorybyParrentid();
				
				$res['childrencategory']=$this->article->getCategorybyParrentid($res['parrentid']);

				$this->load->view('articleedit', $res);

			}

			else

			{ //新建一篇文章

				$data = new StdClass;

				$data->title = "";

				$data->author = "";

				$data->content = "";

				$data->classid = 2;

				$data->articleid = 0;

				$res['data']=$data;
				
				$res['parrentid']=0;

				$res['parrentcategory']=$this->article->getCategorybyParrentid();
				
				$res['childrencategory']=$this->article->getCategorybyParrentid(1);

				$this->load->view('articleedit', $res);
			
			}

		}

		public function articlePost ()

		{ //从articleedit页点击提交按钮后，由本方法在数据库中更新已有文章或插入一条新记录

			if ($this->input->post('articleid') == 0)

			{ //新文章

				$res['id'] = 0;

			}

			else

			{ //已有文章

				$res['id'] = $this->input->post('articleid');

			}

			preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$this->input->post('content1'),$match);

			if(!empty($match[0]))
			{
				$defaultpic = $match[1][0];
                $includepic = ($match[1][0])?(1):(0);
                $uploadfiles = implode('|',$match[1]);
			}
			else
			{
				$defaultpic = "";
                $includepic = "";
                $uploadfiles ="";
			}
			$data = array (
					'title' => $this->input->post('articletitle'),
					'author' => $this->input->post('author'),
					'classid' => $this->input->post('childrencategory'),
					'content' => $this->input->post('content1'),
					'poster' => $this->session->admin,
					'updatetime' => date('Y-m-d H:m:s'),
					'defaultpic' => $defaultpic,
					'includepic' => $includepic,
					'uploadfiles' => $uploadfiles
				);

			$res['data'] = $data;

			$this->load->model('Article_model','article');

			$this->article->articlePost($res);

		}

		public function pageup ()

		{ //上翻页，如果 startwith > 0 的情况下才翻，翻的时候startwith-10

			$this->load->model('Article_model', 'article');	

			if ($this->session->startwith > 0 )

			{

				$this->session->set_userdata('startwith', $this->session->startwith-10);
			
			}

			$data = $this->article->getArticleforAdmin($this->session->childrencategory, $this->session->startwith);

			echo $data;

		}

		public function pagedown ()

		{ //下翻页，如果 sum - startwith > 10 才翻，翻的时候startwith+10


			$this->load->model('Article_model', 'article');

			$recordleft = $this->session->sum - $this->session->startwith;

			if ($recordleft > 10 )

			{

				$this->session->set_userdata('startwith', $this->session->startwith+10);

			}

			$data = $this->article->getArticleforAdmin($this->session->childrencategory, $this->session->startwith);

			echo $data;

		}

		public function articlepassed()

		{
			$articleid = $this->input->post('id');

			$this->load->model('Article_model', 'article');

			$this->article->articlepassed($articleid);

		}

		public function articledeleted()

		{
			$articleid = $this->input->post('id');

			$this->load->model('Article_model', 'article');

			$this->article->articledeleted($articleid);

		}
	}

?>
