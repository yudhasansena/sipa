<div class="panel">
  <div class="panel-heading" style="background: #275555ff; color: honeydew;">
    <h2 align="center" style="margin-top: 10px;">FORM ISIAN<br><b>Dokumen</b> </h2>
    <!-- <hr> -->
  </div>
  <div class="panel-body">

    <? echo form_open_multipart('Web') ?>
    <div class="form-group" style="padding-bottom:30px;">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Dokumen <span class="text-danger">*</span></label>
      <div class="col-sm-9 prepend-icon">
        <input type="file" name="berkas" id="berkas" accept="pdf" class="form-control bg-blue" placeholder="Nama Sekolah/Universitas/Lembaga" maxlength="100" data-parsley-group="block4" data-radio="iradio_square-blue" data-parsley-errors-container='div[id="error-berkas"]' required>
        <i class="fa fa-university" style="margin-left:15px;"></i>
        <div id="error-berkas" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
      </div>
    </div>

  </div>




</div>
</div>

<div class="col-md-12">
  <div>