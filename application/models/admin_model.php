<?php

	class Admin_model extends CI_model

	{

		public function login ($username, $userpw)

		{ //根据传入的$username和$userpw到user表中进行搜索相符的记录

			$query=$this->db->from('Administrator')
				->select('username, level')
				->where('username', $username)
				->where('userpw', $userpw)
                ->where('passed', 1)
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

                $tablestr .= "<td width=\"90px\"><input name=\"articleid\" class=\"$row->id articleid\" id=\"$row->id\" onchange=\"aid(this.value, id)\" type=\"text\" value=\"$row->articleid\"></td>";

                $tablestr .= "<td width=\"390px\"><input type=\"text\" class=\"$row->id title\" id=\"".$row->id."title\" value=\"$row->title\"></td>";

                $tablestr .= "<td width=\"200px\"><img name=\"articlepic\" class=\"$row->id pic\" id=\"$row->id.pic\" src=\"".site_url($row->imagefile)."\" id=\"".site_url($row->id)."\"></td>";

                $tablestr .= "<td width=\"50px\"><input name=\"articpic\" onmouseover=\"mouseonbutton(this.id)\" class=\"$row->id btn\" id=\"$row->id.btn\" type=\"button\" data-reveal-id=\"postwithimg\" value=\"提交图片\"></td></tr>";

            }

            $tablestr .= "</table>";

            return $tablestr;
			
		}

		public function slideboxforwelcome ()

        {
            $query = $this->db->get('slidebox');

            $data = $query->result();

            return $data;
        }

		public function postwithimg($data)

        {
            $this->db->where('id', $data['id'])
                ->update('slidebox', $data);

            redirect('/admin/slidebox/');
        }

		public function user()

        {
            $query = $this->db->get('administrator');

            $data = $query->result();

            $tablestr = "<table><tr><th>序号</th><th>用户名</th><th>邮箱</th><th>电话号码</th><th>用户等级</th><th>启用</th><th>管理</th></tr>";

            foreach ($data as $row)
            {
                $tablestr .= "<tr><td width=\"20px\">$row->userid</td>";

                $tablestr .= "<td width=\"150px\"><input name=\"username\" class=\"$row->userid username\" id=\"$row->userid\" type=\"text\" value=\"$row->username\"></td>";

                $tablestr .= "<td width=\"190px\"><input type=\"text\" class=\"$row->userid email\" id=\"".$row->userid."email\" value=\"$row->email\"></td>";

                $tablestr .= "<td width=\"150px\"><input type=\"text\" class=\"$row->userid phone\" id=\"".$row->userid."phone\" value=\"$row->phone\"></td>";

                $tablestr .= "<td width=\"90px\"><input type=\"text\" class=\"$row->userid level\" id=\"".$row->userid."level\" value=\"$row->level\"></td>";

                $tablestr .= "<td><input type=\"checkbox\" name=\"passed\" class=\"$row->userid passed\" onchange=\"passed(this.value)\"";

                if ($row->passed) {

                    $tablestr .= "checked = \"checked\"";

                }

                $tablestr .= "value=\"$row->userid\"></td>";

                $tablestr .= "<td width=\"100px\"><input name=\"newpassword\" class=\"$row->userid btn\" id=\"$row->userid.btn\" type=\"button\" data-reveal-id=\"newpassword\" value=\"重设密码\"></td></tr>";

            }

            $tablestr .= "</table>";

            return $tablestr;
        }

        public function adminpass($userid)

        {
            $admindata = $this->db->from('administrator')
                ->where('userid', $userid)
                ->get();

            $data = $admindata->result();

            $user = $data[0];

            $user->passed = !$user->passed;

            $this->db->where('userid', $userid)
                ->replace('administrator', $user);

        }

        public function newuser($data)
        {
            $this->db->insert('administrator', $data);
        }

	}

?>
