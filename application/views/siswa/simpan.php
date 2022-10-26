
<?php
$koneksi = mysqli_connect("localhost","root","","ppdb_2021");
            if (isset($_POST['simpan'])) {

  
  $berkas = $_FILES['berkas']['name'];

  if ($berkas != "") {
    $ekstensi_diperbolehkan = array('pdf');
    $x = explode('.', $berkas);
    $ekstensi = strtolower(end($x));
    $file_tmp = $FILES['berkas']['temp_name'];
    $angka_acak = rand(1, 99);
    $nama_berkas = $angka_acak . '-' . $berkas;

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      move_uploaded_file($file_tmp, 'files' . $nama_berkas);

      $sql = $koneksi->query("update set tbl_siswa berkas='$nama_foto'");
    }
  };
?>
$berkas = $_FILES['berkas'];
				if ($berkas = '') {
				} else {
					$config['upload_path'] = 'files';
					$config['allowed_types'] = 'pdf';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('berkas')) {
						echo "";
						die();
					} else {
						$berkas = $this->upload->data('file_name');
					}
				}

///
        $berkas = $this->input->post('berkas');

				$berkas->move('files', $berkas);