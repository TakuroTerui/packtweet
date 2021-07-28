<?php

class Register extends CI_Controller
{
		public function __construct()
		{
				parent::__construct();
				$this->load->model('register_model');
				$this->load->library('form_validation');
				$this->load->library('session');
				$this->load->helper('url');
		}

		public function index()
		{
			if ($this->session->userdata('logged_in') !== TRUE) {
					$this->load->view('common/header');
					$this->load->view('users/register');
			} else {
					// 仮置きURL
					redirect('/');
			}
		}

		public function register()
		{
				$this->form_validation->set_rules('name', 'ユーザ名', 'required|max_length[40]', [
					'required' => '%sは必須です。',
					'max_length' => '{param}文字以内で入力してください。',
				]);

				$this->form_validation->set_rules('email', 'メールアドレス', 'required|max_length[255]|valid_email|is_unique[users.email]', [
					'required' => '%sは必須です。',
					'max_length' => '{param}文字以内で入力してください。',
					'valid_email' => '%sの形式が誤っております。',
					'is_unique' => '既に登録されている%sです。',
				]);

				$this->form_validation->set_rules('password', 'パスワード', 'required|min_length[8]|max_length[16]', [
					'required' => '%sは必須です。',
					'min_length' => '{param}文字以上で入力してください。',
					'max_length' => '{param}文字以内で入力してください。',
				]);

				$this->form_validation->set_rules('password_confirmation', '確認用パスワード', 'required|matches[password]', [
					'required' => '%sは必須です。',
					'matches' => '{param}と一致しておりません。',
				]);

				if (!$this->form_validation->run()) {
						return $this->index();
				}

				$request = [
					'name' => $this->input->post('name', TRUE),
					'email' => $this->input->post('email', TRUE),
					'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
				];

				$request['user_id'] = $this->register_model->register($request);
				$request['logged_in'] = TRUE;
				$this->session->set_userdata($request);
				redirect('/');
		}
}
