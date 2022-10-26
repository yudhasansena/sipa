<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <fieldset>
        <legend>Data Pendaftar</legend>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <?php $this->load->view('web/step/6'); ?>
          </div>
        </div>
        <div class="col-lg-12"></div>
      </fieldset>


      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->

    <script type="text/javascript">
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/verifikasi/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
    </script>