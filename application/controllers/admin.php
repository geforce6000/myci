<?php

	class Admin extends CI_Controller

	{

		public function login()

		{

			echo "欢迎你，超级管理员 ".$this->input->post('userid');

		}

	}
?>