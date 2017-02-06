<?php

	class Article_model extends CI_model

	{

		public function getarticlebyid ($id)

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
		public function searchbykey($key, $startwith)

		{ //根据传入的$key从article数据表中查询符合条件的数据，$startwith是传入偏移量，返回记录按articleid倒序排列

			$total=$this->db->from('article')
				->select('title, articleid')
				->like('title', $key)
				->get();
			//这一次是查询符合条件的记录总数并记录

			$total_rows=$this->db->affected_rows();

			$articlemore=$this->db->from('article')
				->select('title, articleid, poster, updatetime')
				->order_by('articleid','DESC')
				->like('title', $key)
				->limit(20, $startwith)
				->get();
			//这一次是查询20条记录

			$res['total_rows']=$total_rows;

			$res['data']=$articlemore->result();

			return $res;

		}

		public function getarticlebyclass($classid, $startwith=0, $section=10)
		
		{ //根据文章的classid(类别号)获取相关类别的全部文章，返回结果按articleid倒序排列
		  //$classid是类别号，$section是一节文章数量（用于分页），默认10，$startwith是分页的偏移量，默认0

			$parrentid=$this->db->from('articleclass')
						->where('classid', $classid)
						->get();
			//获取传入$classid对应的记录

			$getparrentid=$parrentid->result();

			if ($getparrentid[0]->parrentid == 0) 

			{ //如果记录的父ID=0，表明这是一条根节点，准备调取整个根节点对应的所有子节点的数据并返回

				$totalrecords=$this->db->from('article')
								->select('article.articleid, article.classid, article.title, articleclass.parrentid, article.content, article.updatetime, article.hits, articleclass.classid')
								->join('articleclass', 'article.classid = articleclass.classid', 'left')
								->where('articleclass.parrentid', $classid)
								->order_by('article.articleid', 'DESC')
								->get();

				$data['total_rows'] = $this->db->affected_rows();
				//查询到的记录总条数

				$articlefound=$this->db->from('article')
								->select('article.articleid, article.classid, article.title, articleclass.parrentid, article.content, article.updatetime, article.hits, articleclass.classid')
								->join('articleclass', 'article.classid = articleclass.classid', 'left')
								->where('articleclass.parrentid', $classid)
								->limit($section, $startwith)
								->order_by('article.articleid', 'DESC')
								->get();
/*
				$sql = "SELECT article.articleid, article.classid, article.title, articleclass.parrentid FROM article LEFT JOIN articleclass ON article.classid = articleclass.classid WHERE articleclass.parrentid = $classid ORDER BY article.articleid DESC";

				$articlefound = $this->db->query($sql);
				//这一段是上面的AR连续方法查询数据之后，视图始终回报无数据，所使用的原始SQL语句来进行查询，因为使用AR连续查询构造类有一个问题，
				//看不到输出给数据库的SQL语句哪里出错了
				//之前使用这条SQL语句直接在MYSQL里面可以得出正确结果，但是在视图中始终无数据显示
				//最终发现是这个if语句段里面根本没有return $data;
				//所以这条SQL语句和上面的AR方法都是正确的，为了保持一贯性，还是使用AR方法，但这一段仍然保留
*/

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

				$navlink='<p><a href="'.base_url('article/category/').$parrentname[0]->classid.'">'.$parrentname[0]->classname.'</a> >';

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
					->select('title, articleid, content, updatetime, hits')
					->where('classid', $classid)
					->order_by('articleid', 'DESC')
					->get();

				$data['total_rows']=$this->db->affected_rows();
				//查询到的记录总条数

				$articlefound=$this->db->from('article')
					->select('title, articleid, content, updatetime, hits')
					->where('classid', $classid)
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

				$data['navlink']='<p><a href="'.base_url('article/category/').$parrentname[0]->classid.'">'.$parrentname[0]->classname.'</a> > '.'<a href="'.base_url('article/category/').$childrenname[0]->classid.'">'.$childrenname[0]->classname.'</a></p>';
				//显示在导航栏下方的快速链接，显示格式为 根节点名称 > 子节点名称，均为超链接可以点击

				return $data;

			}

		}

	}

?>