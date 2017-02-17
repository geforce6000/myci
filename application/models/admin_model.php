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

			return $data;
			
		}

	}

?>
