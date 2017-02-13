<?php

	class Admin extends CI_Controller

	{

		public function login()

		{ //本方法用于验证管理员身份
		  //接收来自导航条(application/view/nav.php)中"后台入口"模态框的数据
		  //检查数据是否存在于user表中，如果存在，根据用户等级显示相应的页面
		  //如果不存在，提示错误信息

			$this->load->model('Admin_model','admin');

			$data=$this->admin->login($this->input->post('username'),md5($this->input->post('userpw')));

			if($data['found'] == 1) //==1表示查到一条记录，表明该用户存在且用户名和密码均正确

			{

				$this->load->model('Article_model', 'article');

				$res['parrentcategory'] = $this->article->getCategorybyParrentid();
				//调取articleclass根节点数据
				
				$res['childrencategory'] = $this->article->getCategorybyParrentid(1);

				//$res['articlelist'] = $this->article->getArticleforAdmin(2,0);
				
				$res['articlelist'] = $this->article->getArticleforAdmin(2);
				//只传一个0表示不分类别调取所有文章，倒序排列，数量10篇

				$res['adminname'] = $data[0]->name;
				//管理员名字

				if ($data[0]->level == 0)
				//level==0表明是超级管理员，具备全部权限
				//目前考虑权限包括1修改所有用户信息，2发布、修改、删除、置顶文章，3审核普通管理员发的文，4修改文章分类表->会间接影响导航条

				{

					//$this->session->set_userdata('adminname', $data[0]->name);

					$this->session->set_userdata('parrentcategory', 1);
					//这个值是表示parrentcategory列表项的值，用于翻页

					$this->session->set_userdata('childrencategory', 2);
					//同上一行

					$this->session->set_userdata('startwith', 0);
					//设定翻页时的偏移量，初始值为0

					$this->load->view('adminheader', $res);

					$this->load->view('adminarticle');

					$this->load->view('footer');

				}

				else //普通管理员，只具备部分权限（目前考虑只有1修改自己的信息，2发文，3删除自己发出但未审核的文，2和3做到一个页面里）

				{ //将来替换成管理员视图

					echo "欢迎你，管理员 ".$data[0]->name;
				
				}

			}

			else

			{ //没有查到相应数据，显示错误信息

				echo "无效的用户名/密码！";

			}

		}

	}
?>