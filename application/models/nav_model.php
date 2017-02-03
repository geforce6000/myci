<?php

	class Nav_model extends CI_model

	{

		public function nav ()

		{ //获取articleclsss表中的数据，生成data数组并返回，用于制作导航条

			$parrent = $this->db->select('classid, classname')
							->where('parrentid',0)
							->order_by('classid')
							->get('articleclass');

			$data['parrent']=$parrent->result();
			//这一元素用于生成导航条主项目

			foreach ($data['parrent'] as $row)

			{
/*
				echo "$row->classid<br/>";
			
				echo "$row->classname<br/>";
*/			
				$child[$row->classid] = $this->db->select('parrentid, classid, classname')
											->where('parrentid', $row->classid)
											->order_by('classid')
											->get('articleclass');

				$data[$row->classid]=$child[$row->classid]->result();
				//这组元素用于生成导航条每个主项目的子条目，配对ID是子条目的parrentid和主项目的classid
/*			
				foreach ($data[$row->classid] as $cid) 

				{

					echo "-->$cid->classid<br/>";
			
					echo "-->$cid->classname<br/>";

				}
*/								
			}

			return $data;

		}

	}
