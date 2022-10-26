<?php
require('assets/phpfpdf/fpdf.php');
include 'koneksi.php';

class PDF extends FPDF
{
  function Header()
  {
    //logo
    $this->Image('assets/logo/sumut.png', 80, 7, 27);

    //geser kanan 35 mm
    $this->Cell(115);
    //judul
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(100, 7, 'DINAS PENDIDIKAN', 0, 1, 'L');
    $this->Cell(102);
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(100, 7, 'PROVINSI SUMATERA UTARA', 0, 1, 'L');

    $this->Cell(94);
    $this->SetFont('Arial', 'i', 10);
    $this->Cell(90, 7, 'Jl.Talaga Bodas No.35  Tel/Fax 022-7310219 Medan-40262', 0, 1, 'L');
    //garis bawah double
    $this->Cell(270, 1, '', 'B', 1, 'L');
    $this->Cell(270, 1, '', 'B', 0, 'L');

    //line break 5mm

    //memberikan jarak agar tidak rapat
    $this->Cell(10, 7, '', 0, 1);
  }
  function Footer()
  {

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    //page number
    $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}
//instance objek dan memberikan pengaturan halaman pdf
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', '16');
$pdf->Cell(270, 7, 'Laporan Surat Masuk', 0, 1, 'C');

//-------------Select data di database------------------------------
$no = 1;
$pdf->SetFont('Arial', 'B', '10');

$kasus = mysqli_query($koneksi, "SELECT * FROM tb_sktmpendidikan as k JOIN sekolah as p ON k.nis=p.nis ORDER BY no_sktmPendidikan ASC") or die(mysqli_error($koneksi));

while ($row = mysqli_fetch_array($kasus)) {
  $t = date('d F Y', strtotime($row['tgl_sktmPendidikan']));

  $pdf->Cell(270, 1, '', 'B', 1, 'L');
  $pdf->SetFont('Arial', '', '10');
  $pdf->Cell(20);
  $pdf->Cell(10, 8, $no++ . '.', 0);

  $pdf->Cell(40, 8, 'No Surat ', 0);
  $pdf->Cell(10, 8, ':', 0);
  $pdf->Cell(30, 8, $row['no_sktmPendidikan'], 0, 0);

  $pdf->Cell(45);
  $pdf->Cell(40, 8, 'Tanggal Terima', 0);
  $pdf->Cell(10, 8, ' :', 0);
  $pdf->Cell(30, 8, $row['tgl_sktmPendidikan'], 0, 1);
  $pdf->Cell(270, 0.5, '', 'B', 1, 'L');
  //-------------Select data di database------------------------------
  $pdf->Cell(30);
  $pdf->Cell(40, 8, 'NIS', 0);
  $pdf->Cell(10, 8, ':', 0);
  $pdf->Cell(30, 8, $row['nis'], 0, 0);

  $pdf->Cell(46);
  $pdf->Cell(40, 8, 'Jenis Surat', 0);
  $pdf->Cell(10, 8, ' :', 0);
  $pdf->Cell(30, 8, $row['jeniss'], 0, 1);

  //-------------Select data di database------------------------------

  $pdf->Cell(30);
  $pdf->Cell(39, 8, 'Nama Instansi', 0);
  $pdf->Cell(10, 8, ' :', 0);
  $pdf->Cell(30, 8, $row['nama'], 0, 0);


  //-------------Select data di database------------------------------


  $pdf->Cell(47);
  $pdf->Cell(40, 8, 'Alamat', 0);
  $pdf->Cell(10, 8, ' :', 0);
  $pdf->Cell(50, 8, $row['alamat'], 0, 1);



  $pdf->Cell(30);
  $pdf->Cell(40, 8, 'Keterangan', 0);
  $pdf->Cell(10, 8, ' :', 0);
  $pdf->MultiCell(80, 8, $row['keterangan'], 0, 1);
  //-------------Select data di database------------------------------
}
$pdf->Cell(270, 0.5, '', 'B', 1, 'L');
//tanda tangan
$tgl = date("d F Y");
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(220);
$pdf->Cell(30, 5, 'Medan, ' . $tgl, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(220);
$pdf->Cell(30, 7, 'Kepala Dinas,', 0, 1, 'C');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(220);
$pdf->Cell(30, 4, 'TB.Agus Mulyadi', 0, 1, 'C');
$pdf->Cell(220);
$pdf->Cell(38, 0.5, '', 'B', 1, 'L');
$pdf->Cell(220);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 4, 'NIP.19600131189738838', 0, 1, 'C');

$pdf->Output();
