<?php
defined('BASEPATH') or exit('No direct script access allowed');
$user = $this->db->get('tbl_siswa')->row_array();
?>
<div class="panel">
  <div class="panel-heading" style="background: #275555ff; color: honeydew;">
    <h2 align="center" style="margin-top: 10px;">FORM ISIAN<br><b>DATA SEKOLAH ASAL</b> </h2>
    <!-- <hr> -->
  </div>
  <div class="panel-body">

    <div class="form-group" style="padding-bottom:30px;">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Nama Lengkap <span class="text-danger">*</span></label>
      <div class="col-sm-9 prepend-icon">
        <input type="file" name="berkas" class="form-control bg-blue" placeholder="berkas" maxlength="100" data-parsley-group="block1" data-radio="iradio_square-blue" data-parsley-errors-container='div[id="error-nama_lengkap"]' required>
        <i class="fa fa-user" style="margin-left:15px;"></i>
        <div id="error-nama_lengkap" style=" background:#FFBABA; color: #D8000C; width:auto; padding-left:10px; font-size: 10px;"></div>
        <div id="pesan_komentar">*Upload Berkas Anda</div>
        <left><a href="<?php echo base_url("index.php/siswa/upload"); ?>" class="btn btn-danger">UPLOAD DATA</a>

          </center>



      </div>
    </div>
  </div>
</div>


<div class="col-md-12">
  <div>