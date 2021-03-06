<?php

	class Nav_model extends CI_model

	{

		public function nav ()

		{ //获取articleclsss表中的数据，生成data数组并返回，用于制作导航条
		//返回值是一个2子项的多维数组(parrent,children)
		//parrent子项是根目录项数组，每个根目录项均有一定数量的子项
		//children子项是一个多子项的多维数组，children的每一个子项也是一个数组，对应parrent中的一个项目的子条目

			$parrent = $this->db->select('classid, classname')
							->where('parrentid',0)
							->order_by('classid')
							->get('articleclass');

			$data['parrent']=$parrent->result();
			//这一元素用于生成导航条主项目

			foreach ($data['parrent'] as $row)

			{

				$child[$row->classid] = $this->db->select('parrentid, classid, classname')
											->where('parrentid', $row->classid)
											->order_by('classid')
											->get('articleclass');

				$data['children'][$row->classid]=$child[$row->classid]->result();
				//这组元素用于生成导航条每个主项目的子条目，配对ID是子条目的parrentid和主项目的classid
			
			}

			return $data;

		}

	}
