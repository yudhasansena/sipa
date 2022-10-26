<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Model_web extends CI_Model
{

	function web_utama()
	{
		return $this->db->get_where('tbl_web', "id_web='1'")->row();
	}

	function pendaftaran($menu = '', $data = '')
	{


		switch ($menu) {
			case 'daftar':
				$berkas = $_FILES['berkas'];
				if ($berkas = '') {
				} else {
					$config['upload_path'] = 'files';
					$config['allowed_types'] = 'doc|pdf';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('berkas')) {
						echo "";
					} else {
						$upload = $this->upload->data();
					}
				}



				$data = (object) $data;
				$data = array(
					'no_pendaftaran'	=> $data->post('nis'),
					'password'			=> $data->post('nisn'),
					'nisn'				=> $data->post('nisn'),
					'nik'				=> $data->post('nik'),
					'nama_lengkap'		=> $data->post('nama_lengkap'),
					'jk'				=> $data->post('jk'),
					'tempat_lahir'		=> $data->post('tempat_lahir'),
					'tgl_lahir'			=> $data->post('tgl_lahir') . "-" . $data->post('bln_lahir') . "-" . $data->post('thn_lahir'),
					'agama'				=> $data->post('agama'),
					'hobi'				=> $data->post('hobi'),
					'cita'				=> $data->post('cita'),
					'no_hp_siswa'		=> $data->post('no_hp_siswa'),
					'jenis_tinggal'		=> $data->post('jenis_tinggal'),
					'alamat_siswa'		=> $data->post('alamat_siswa'),
					'desa'				=> $data->post('desa'),
					'kec'				=> $data->post('kec'),
					'kab'				=> $data->post('kab'),
					'prov'				=> $data->post('prov'),
					'kode_pos'			=> $data->post('kode_pos'),
					'jarak'				=> $data->post('jarak'),


					'nama_sekolah'		=> $data->post('nama_sekolah'),
					'jenjang_sekolah'	=> $data->post('jenjang_sekolah'),
					'status_sekolah'	=> $data->post('status_sekolah'),
					'npsn_sekolah'		=> $data->post('npsn_sekolah'),
					'lokasi_sekolah'	=> $data->post('lokasi_sekolah'),


					'tgl_siswa'			=> date('Y-m-d H:i:s'),
					'berkas'			=> $upload
				);
				return $this->db->insert('tbl_siswa', $data);
				break;

			case 'id_baru':
				$no_max = $this->db->select_max('no_pendaftaran', 'kode')->get('tbl_siswa')->row();
				$no_max = $no_max->kode;
				$no_max = (int) substr($no_max, 6) + 1;
				return date('Y-') . sprintf("%06s", time());
				break;

			case 'status_ppdb':
				return $this->db->get_where('tbl_web', "id_web='1'")->row();
				break;

			case 'v_pdd':
				return $this->db->order_by('id_pdd', 'ASC')->get('tbl_pdd')->result();
				break;

			case 'berkas':
				return $upload = $this->upload->data('berkas');
				break;


			default:
				# code...
				break;
		}
	}

	function auth($menu = '', $data = '')
	{
		switch ($menu) {
			case 'cek-masuk':
				$query = $this->db->where("no_pendaftaran", $data['username'])->where("password", $data['password'])->get('tbl_siswa');
				return array(
					'res'	=> $query->row(),
					'sum'	=> $query->num_rows()
				);
				break;

			default:
				# code...
				break;
		}
	}
}
