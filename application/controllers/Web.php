<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function index()
	{
		$data['web_ppdb']	 = $this->web->web_utama();
		$this->load->view('web/index', $data);
	}

	public function idbaru($value = '')
	{
		echo $this->web->pendaftaran('id_baru');
	}

	public function pendaftaran()
	{

		if ($berkas = '') {
		} else {
			$config['upload_path'] = 'files';
			$config['allowed_types'] = 'doc|pdf';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('berkas')) {
				echo "";
			} else {
				$berkas = $this->upload->data();
				print_r($berkas);
			}
		}
		$data = array(
			'id_daftar'			=> $this->web->pendaftaran('id_baru'),
			'web_ppdb'			=> $this->web->pendaftaran('status_ppdb'),
			'v_pdd'				=> $this->web->pendaftaran('v_pdd'),
			'berkas'				=> $berkas
		);

		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}
		$this->load->view('web/pendaftaran', $data);




		if (isset($_POST['btndaftar'])) {
			// var_dump($this->input->post()); exit();
			$acts = $this->web->pendaftaran('daftar', $this->input);
			// 

			$this->session->set_userdata('no_pendaftaran', $this->input->post('nis'));
			redirect('panel_siswa');
		}
	}

	public function logcs()
	{
		$data['web_ppdb']	 = $this->web->pendaftaran('status_ppdb');
		if ($data['web_ppdb']->status_ppdb == 'tutup') {
			redirect('404');
		}

		if ($this->session->userdata('no_pendaftaran') != NULL) {
			redirect('panel_siswa');
		} else {
			$this->load->view('web/index', $data);

			if (isset($_POST['btnlogin'])) {
				$send = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$auth = $this->web->auth('cek-masuk', $send);

				if ($auth['sum'] == 0) {
					$this->session->set_flashdata('msg', $this->err->wrong_auth());
					redirect('logcs');
				} else {
					$this->session->set_userdata('no_pendaftaran', $auth['res']->no_pendaftaran);
					redirect('panel_siswa');
				}
			}
		}
	}

	public function cari()
	{
		$data['siswa'] = $this->SiswaModel->view();
		$this->load->view('web/cari', $data);
	}


	function error_not_found()
	{
		$this->load->view('404_content');
	}
}
