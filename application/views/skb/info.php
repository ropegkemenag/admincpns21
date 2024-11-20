<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Info Satuan Kerja</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <!-- <a href="<?= site_url('admin/peserta/export/cpns');?>" target="_blank" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Download XLS</a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <form class="" action="" method="post">
            <div class="form-group row">
                <label for="kontak" class="col-sm-4 col-form-label">Kontak Satuan Kerja</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $satker->kontak;?>" placeholder="Call Center Untuk Peserta">
                </div>
            </div>
            <div class="form-group row">
                <label for="informasi" class="col-sm-4 col-form-label">Informasi Untuk Peserta</label>
                <div class="col-sm-8">
                  <textarea name="informasi" id="editor" cols="5"><?= $satker->informasi;?></textarea>
                </div>
            </div>
            <div class="form-group row mt-5">
              <label for="informasi" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#editor').summernote({
      height: 200
    });
  });

</script>
