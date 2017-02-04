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

			$allfound=$this->db->from('article')
				->select('title, articleid')
				->like('title', $key)
				->get();
			//这一次是查询符合条件的记录总数并记录

			$allfound=$this->db->affected_rows();

			$articlemore=$this->db->from('article')
				->select('title, articleid')
				->order_by('articleid','DESC')
				->like('title', $key)
				->limit(20, $startwith)
				->get();
			//这一次是查询20条记录

			$res['found']=$allfound;

			$res['data']=$articlemore->result();

			return $res;

		}

		public function getarticlebyclass($classid)
		
		{ //根据文章的classid(类别号)获取相关类别的全部文章，返回结果按articleid倒序排列

			$parrentid=$this->db->from('articleclass')
						->where('classid', $classid)
						->get();
			//获取传入$classid对应的记录

			$getparrentid=$parrentid->result();

			if ($getparrentid[0]->parrentid == 0) 

			{ //如果记录的父ID==0，表明这是一条根节点，需要将$classid改成此根节点的第1子项的classid

				$classidreplace=$this->db->from('articleclass')
									->where('parrentid', $classid)
									->order_by('classid', 'ASC')
									->limit(1)
									->get();

				$newclassid=$classidreplace->result();

				$classid=$newclassid[0]->classid;

			}

			$articlefound=$this->db->from('article')
				->select('title, articleid')
				->where('classid', $classid)
				->order_by('articleid', 'DESC')
				->get();

			$data['found']=$this->db->affected_rows();
			//查询到的记录条数

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

?>