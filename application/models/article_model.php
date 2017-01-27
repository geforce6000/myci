<?php

	class Article_model extends CI_model

	{

		public function getonearticle ($id)

		{ //根据传入的$id进行文章查询

			$articlegot=$this->db->from('article')
				->where('articleid',$id)
				->get();

		return $articlegot->result(); //返回结果是一个对象

		}

/*		public function changeback ($id, $cbget) { 配合article控制器的cf方法对数据库进行一次修改，使用了AR方法，挺好用

			$bool=$this->db->where ('articleid', $id)
				->update('article', $cbget);

			return $bool;

		}
*/

		public function getmorearticle($key, $startwith)

		{

			$allfound=$this->db->from('article')
				->select('title, articleid')
				->like('title', $key)
				->get();
			//这一次是查询符合条件的记录总数并记录

			$allfound=$this->db->affected_rows();

			$articlemore=$this->db->from('article')
				->select('title, articleid')
				->like('title', $key)
				->limit(20, $startwith)
				->get();
			//这一次是查询20条记录

			$res['found']=$allfound;

			$res['data']=$articlemore->result();

			return $res;

		}

	}

?>