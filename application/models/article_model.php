<?php

	class Article_model extends CI_model

	{

		public function getArticlebyId ($id)

		{ //根据传入的$id查询一篇文章返回

			$articlegot=$this->db->from('article')
				->where('articleid',$id)
				->get();

			return $articlegot->result(); //返回结果是一个对象

		}
/*
		public function changeback ($id, $cbget)

		{ //配合article控制器的cf方法对数据库进行一次修改，使用了AR方法，挺好用

			$bool=$this->db->where ('articleid', $id)
				->update('article', $cbget);

			return $bool;

		}

*/
		public function searchArticlebyKey($key, $startwith, $limit=20)

		{ //根据传入的$key从article数据表中查询符合条件的数据，$startwith是传入偏移量，返回记录按articleid倒序排列

			$total=$this->db->from('article')
				->select('title, articleid')
				->where('deleted !=', 1)
				->like('title', $key)
				->get();
			//这一次是查询符合条件的记录总数并记录

			$total_rows=$this->db->affected_rows();

			$articlemore=$this->db->from('article')
				->select('title, articleid, poster, content, defaultpic, updatetime')
				->order_by('articleid','DESC')
				->where('deleted !=', 1)
				->like('title', $key)
				->limit($limit, $startwith)
				->get();
			//这一次是查询20条记录

			$res['total_rows']=$total_rows;

			$res['data']=$articlemore->result();

			return $res;

		}

		public function getArticlebyClass($classid, $startwith=0, $section=10)
		
		{ //根据文章的classid(类别号)获取相关类别的全部文章，返回结果按articleid倒序排列
		  //$classid是类别号，$section是一节文章数量（用于分页），默认10，$startwith是分页的偏移量，默认0
		  
			if ($classid == 0)

			{ //如果传入$classid为0，则设定范围是取所有文章，按articleid倒序排列返回

				$data = $this->db->from('article')
							->select('articleid, title, deleted')
							->order_by('articleid', 'DESC')
							->limit($section, $startwith)
							->get();

				return $data->result();

			}

			$parrentid=$this->db->from('articleclass')
						->where('classid', $classid)
						->get();
			//获取传入$classid对应的记录

			$getparrentid=$parrentid->result();

			if ($getparrentid[0]->parrentid == 0) 

			{ //如果记录的父ID=0，表明这是一条根节点，准备调取整个根节点对应的所有子节点的数据并返回

				$totalrecords=$this->db->from('article')
								->select('article.articleid, article.classid, article.title, articleclass.parrentid, article.updatetime, article.hits, articleclass.classid')
								->join('articleclass', 'article.classid = articleclass.classid', 'left')
								->where('articleclass.parrentid', $classid)
								->where('deleted !=', 1)
								->order_by('article.articleid', 'DESC')
								->get();

				$data['total_rows'] = $this->db->affected_rows();
				//查询到的记录总条数

				$articlefound=$this->db->from('article')
								->select('article.articleid, article.classid, article.title, articleclass.parrentid, article.content, article.updatetime, article.defaultpic, article.hits, articleclass.classid')
								->join('articleclass', 'article.classid = articleclass.classid', 'left')
								->where('articleclass.parrentid', $classid)
								->where('deleted !=', 1)
								->limit($section, $startwith)
								->order_by('article.articleid', 'DESC')
								->get();

				$data['data'] = $articlefound->result();

				$parrent=$this->db->from('articleclass')
							->select('classname, classid, parrentid')
							->where('classid', $classid)
							->get();
				
				$parrentname=$parrent->result();

				$children=$this->db->from('articleclass')
							->select('classname, classid, parrentid')
							->order_by('classid', "ASC")
							->where('parrentid', $classid)
							->get();

				$childrenname=$children->result();

				$navlink='<p>当前位置： <a href="'.base_url('article/category/').$parrentname[0]->classid.'">'.$parrentname[0]->classname.'</a> >';

				foreach ($childrenname as $row)

				{

					$navlink .='  <a href="'.base_url('article/category/').$row->classid.'">'.$row->classname.'</a>';

				}

				$navlink .= '</p>';

				$data['navlink'] = $navlink;

				return $data;

			}

			else

			{

				$articlefound=$this->db->from('article')
					->select('title, articleid, updatetime, hits')
					->where('classid', $classid)
					->where('deleted !=', 1)
					->order_by('articleid', 'DESC')
					->get();

				$data['total_rows']=$this->db->affected_rows();
				//查询到的记录总条数

				$articlefound=$this->db->from('article')
					->select('title, articleid, content, defaultpic, updatetime, hits')
					->where('classid', $classid)
					->where('deleted !=', 1)
					->limit($section, $startwith)
					->order_by('articleid', 'DESC')
					->get();
					
				$data['data']=$articlefound->result();
				//查询到的记录数据

				$children=$this->db->from('articleclass')
								->select('classname, classid, parrentid')
								->where('classid', $classid)
								->get();

				$childrenname=$children->result();
				//该classid对应的记录数据，用于下面的navlink生成链接

				$parrent=$this->db->from('articleclass')
								->select('classname, classid')
								->where('classid', $childrenname[0]->parrentid)
								->get();

				$parrentname=$parrent->result();
				//该classid对应的parrent的记录数据，用于下面的navlink生成链接

				$data['navlink']='<p>当前位置： <a href="'.base_url('article/category/').$parrentname[0]->classid.'">'.$parrentname[0]->classname.'</a> > '.'<a href="'.base_url('article/category/').$childrenname[0]->classid.'">'.$childrenname[0]->classname.'</a></p>';
				//显示在导航栏下方的快速链接，显示格式为 根节点名称 > 子节点名称，均为超链接可以点击

				return $data;

			}

		}

		public function getCategorybyParrentid ($parrentid=0)

		{ //根据传入的$parrentid来调取子category，不传参默认调取根节点数据

			$categorylist = $this->db->from('articleclass')
				->select('classid, classname')
				->where('parrentid', $parrentid)
				->order_by('classid', 'ASC')
				->get();

			return $categorylist->result();

		}

		public function getParrentidbyChild ($childid)

		{ //根据传入的$childid来查其父id

			$parrent = $this->db->from('articleclass')
						->select('classid, classname, parrentid')
						->where('classid', $childid)
						->limit(1)
						->get();

			return $parrent->result();

		}

	}

?>