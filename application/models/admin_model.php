<?php

	class Admin_model extends CI_model

	{

		public function login ($username, $userpw)

		{ //根据传入的$username和$userpw到user表中进行搜索相符的记录

			$query=$this->db->from('Administrator')
				->select('username, name, level')
				->where('username', $username)
				->where('userpw', $userpw)
				->get();

			$data=$query->result();

			$data['found']=$this->db->affected_rows(); //如果为0表示没搜到符合条件的用户

			return $data;

		}

		public function adminmenu ()

		{ //返回admin页左侧导航菜单

			$query = $this->db->get('adminmenu');

			$data = $query->result();

			return $data;

		}

		public function adminslidebox ()

		{

			$query = $this->db->get('slidebox');

			$data = $query->result();

            $tablestr = "<table><tr><th>序号</th><th>文章编号</th><th>文章标题</th><th>图片</th><th>上传图片</th></tr>";

            foreach ($data as $row)

            {

                $tablestr .= "<tr><td width=\"20px\">$row->id</td>";

                $tablestr .= "<td width=\"90px\"><input name=\"articleid\" id=\"$row->id.aid\" onchange=\"aid(this.value)\" type=\"text\" value=\"$row->articleid\"></td>";

                $tablestr .= "<td width=\"390px\"><input type=\"text\" id=\"$row->id.title\"\" value=\"$row->title\"></td>";

                $tablestr .= "<td width=\"200px\"><img name=\"articlepic\" id=\"$row->id.pic\" src=\"".site_url($row->imagefile)."\" id=\"".site_url($row->id)."\"></td>";

                $tablestr .= "<td width=\"50px\"><input name=\"articpic\" id=\"$row->id\"btn\" type=\"button\" value=\"上传图片\" onclick=\"changeimage(this.id)\"></td></tr>";

            }

            $tablestr .= "</table>";

            return $tablestr;
			
		}

	}

?>
