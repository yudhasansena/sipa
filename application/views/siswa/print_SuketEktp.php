<?php
require('assets/phpfpdf/fpdf.php');
include 'koneksi.php';

class PDF extends FPDF
{
  function Header()
  {
    //logo
    $this->Image('assets/logo/sumut.png', 45, 7, 27);

    //geser kanan 35 mm
    $this->Cell(75);
    //judul
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(30, 7, 'DINAS PENDIDIKAN', 0, 1, 'L');
    $this->Cell(60);
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(30, 7, 'PROVINSI SUMATERA UTARA', 0, 1, 'L');

    $this->Cell(55);
    $this->SetFont('Arial', 'i', 10);
    $this->Cell(30, 7, 'Jl.Talaga Bodas No.35  Tel/Fax 022-7310219 Medan-40262', 0, 1, 'L');
    //garis bawah double
    $this->Cell(185, 1, '', 'B', 1, 'L');
    $this->Cell(185, 1, '', 'B', 0, 'L');

    //line break 5mm
    $this->Ln(5);
  }
}
//instance objek dan memberikan pengaturan halaman pdf
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

if (isset($_GET['id'])) {

  $id = ($_GET['id']);


  $query = "SELECT * FROM tb_permohonanktp as p JOIN tb_penduduk as d ON p.nik=d.nik where no_permohonanKtp='$id'";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("query error:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
  }
  $data = mysqli_fetch_assoc($result);

  $fo = $data['foto'];
  $tglRekam = $data['tglRekam'];




  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(180, 7, ' SURAT KETERANGAN ', 0, 1, 'C');
  $pdf->Cell(60);
  $pdf->Cell(60, 0, '', 'B', 1, 'C');
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(180, 7, 'Nomor: ' . $data['no_permohonanKtp'] . '/' . $tglRekam, 0, 1, 'C');
  $pdf->Ln(3);
  //memberikan space kebawah agar tidak rapat
  $pdf->Cell(180, 8, ' Yang bertanda tangan dibawah ini menerangkan bahwa penduduk : ', 0, 1, 'L');

  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'NIK/NISN', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['nik'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Nama Lengkap', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['nama'], 0, 1);
  $pdf->Cell(10, 8, 'Alamat  ', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['alamat'], 0, 1);
  //=====Baris==================


  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Nama Instansi', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['namao'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Alamat Instansi', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['alo'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Jabatan Pemohon', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['jabo'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Jenis Permohonan  ', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['jenisPermohonan'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Deskripsi Pemohon', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['deskrip'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Tanggal Penyerahan Berkas  ', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['tgl_penyerahanBerkas'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Tanggal Kegiatan', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['tglRekam'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Nominal Dana Yang Diterima', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['nominal'], 0, 1);
  //=====Baris==================

  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Status', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['status'], 0, 1);
  //=====Baris==================
  $pdf->SetFont('Arial', '', '11');
  $pdf->Cell(10, 8, 'Tanggal Pengambilan', 0, 0);
  $pdf->Cell(42);
  $pdf->Cell(5, 8, ' : ', 0, 0);
  $pdf->Cell(10, 8, $data['tgl_pengambilan'], 0, 1);
  //=====Baris==================

  $pdf->Ln(3);
  $pdf->Cell(180, 5, 'Data tersebut diatas benar-benar sudah melakukan Permohonan Dana  dan data yang', 0, 1, 'L');
  $pdf->Cell(180, 4, 'bersangkutan telah terdata dalam Database Dinas Pendidikan Provinsi Sumatera Utara.', 0, 1, 'L');
  $pdf->Ln(4);
  $pdf->Cell(180, 4, 'Demikian Surat Keterangan ini kami buat sebagai  BUKTI Pembayaran dipergunakan untuk kepentingan', 0, 1, 'L');
  $pdf->Cell(180, 4, 'Kegiatan, pencairan dana, pertanggung jawaban penerima Dana Pendidikan dan lain-lain, Kepada', 0, 1, 'L');
  $pdf->Cell(180, 4, 'yang berkepentingan agar menjadi maklum', 0, 1, 'L');
  $pdf->Ln(4);
  $pdf->Cell(180, 4, 'Surat Keterangan ini berlaku sampai dengan penerima tersebut diatas mendapatkan dana pendidikan.', 0, 1, 'L');

  //tanda tangan
  $tgl = date("d F Y");
  $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(140);
  $pdf->Cell(30, 5, 'Medan, ' . $tgl, 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 9);

  $pdf->Cell(30, 7, 'Yang Bersangkutan,', 0, 0, 'L');
  $pdf->Cell(110);
  $pdf->Cell(30, 7, 'Kepala Dinas Pendidikan', 0, 1, 'C');
  $pdf->Cell(141);
  $pdf->Cell(30, 7, 'Provinsi Sumatera Utara,', 0, 1, 'C');
  $pdf->Ln(15);
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(30, 4, $data['nama'], 0, 0, 'C');
  $pdf->Cell(110);
  $pdf->Cell(30, 4, 'TB.Agus Mulyadi', 0, 1, 'C');
  $pdf->Cell(135);
  $pdf->Cell(38, 0.5, '', 'B', 1, 'L');
  $pdf->Cell(140);
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(30, 4, 'NIP.19600131189738838', 0, 1, 'C');

  $pdf->Output();
}
