<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Detail Jabatan</h4></div>

        <div class="breadcrumb bg-transsatker align-self-center m-0 p-0">
          <a href="<?= site_url('jabatan/index/'.$satker->KODE_ATASAN)?>" class="btn btn-info"><i class="icon-arrow-left-circle"></i> Kembali</a> &nbsp; <button class="btn btn-warning" id="buttonubah"><i class="icon-pencil"></i> Ubah</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="table-responsive">
            <table class="table layout-primary bordered datasatker">
              <tr>
                <th>NAMA JABATAN</th>
                <td><?= $satker->PIMPINAN?></td>
              </tr>
              <tr>
                <th width="30%">KODE JABATAN</th>
                <td><?= $satker->KODE_SATUAN_KERJA?></td>
              </tr>
              <tr>
                <th>NAMA UNIT KERJA</th>
                <td><?= $satker->SATUAN_KERJA?></td>
              </tr>
              <tr>
                <th></th>
                <td>JPT Utama:</td>
              </tr>
              <tr>
                <th></th>
                <td>JPT Madya:</td>
              </tr>
              <tr>
                <th></th>
                <td>JPT Pratama:</td>
              </tr>
              <tr>
                <th></th>
                <td>Administrator:</td>
              </tr>
              <tr>
                <th></th>
                <td>Pengawas:</td>
              </tr>
              <tr>
                <th></th>
                <td>Pelaksana:</td>
              </tr>
              <tr>
                <th></th>
                <td>Jabatan Fungsional:</td>
              </tr>
              <tr>
                <th>IKTISAR JABATAN</th>
                <td><?= $satker->IKTISAR;?></td>
              </tr>
              <tr>
                <th>KUALIFIKASI JABATAN</th>
                <td></td>
              </tr>
              <tr>
                <th></th>
                <td>Pendidikan Formal</td>
              </tr>
              <tr>
                <th></th>
                <td>Pendidikan & Pelatihan</td>
              </tr>
              <tr>
                <th></th>
                <td>Pengalaman Kerja</td>
              </tr>
              <tr>
                <th>LOKASI</th>
                <td>
                  KAB/KOTA: <?= $satker->KAB_KOTA?><br>
                  PROVINSI: <?= $satker->PROVINSI?>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-12">
          <a href="<?= site_url('jabatan/detail/'.$satker->KODE_SATUAN_KERJA.'/uraian')?>" class="btn btn-info"><i class="icon-book-open"></i> URAIAN JABATAN</a>
          <a href="<?= site_url('jabatan/detail/'.$satker->KODE_SATUAN_KERJA.'/struktur')?>" class="btn btn-info"><i class="icon-list"></i> STRUKTUR JABATAN</a>
          <a href="<?= site_url('jabatan/detail/'.$satker->KODE_SATUAN_KERJA.'/abk')?>" class="btn btn-info"> <i class="icon-share"></i> ANALISA BEBAN KERJA (ABK)</a>
          <a href="<?= site_url('jabatan/detail/'.$satker->KODE_SATUAN_KERJA.'/evaluasi')?>" class="btn btn-info"><i class="icon-speech"></i> EVALUASI JABATAN</a>
          <a href="<?= site_url('jabatan/detail/'.$satker->KODE_SATUAN_KERJA.'/export')?>" class="btn btn-info"><i class="icon-cloud-download"></i> EXPORT</a>
          <?php if($detail){
            echo $detail;
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ubahjabatan" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel10">Ubah Data Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ubahjabatan" method="post" action="<?= site_url('jabatan/ubahjabatan');?>">
          <div class="form-group row">
              <label for="pimpinan" class="col-sm-4 col-form-label">NAMA JABATAN</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="pimpinan" name="pimpinan" value="<?= $satker->PIMPINAN?>" placeholder="Nama Jabatan">
              </div>
          </div>
          <div class="form-group row">
              <label for="satuan_kerja" class="col-sm-4 col-form-label">NAMA UNIT KERJA</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="satuan_kerja" name="satuan_kerja" value="<?= $satker->SATUAN_KERJA?>" placeholder="Nama Unit Kerja">
              </div>
          </div>
          <div class="form-group row">
            <label for="level_jabatan" class="col-sm-4 col-form-label">LEVEL JABATAN</label>
            <div class="col-sm-8">
              <select class="form-control" name="level_jabatan">
                <?php foreach ($level as $lv) {
                  $select = ($lv->KODE_LEVEL_JABATAN == $satker->LEVEL_JABATAN)?'selected':'';
                  echo '<option value="'.$lv->KODE_LEVEL_JABATAN.'" '.$select.'>'.$lv->LEVEL_JABATAN.'</option>';
                } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
              <label for="grup" class="col-sm-4 col-form-label">GROUP SATUAN KERJA</label>
              <div class="col-sm-8">
                <select class="form-control" name="grup">
                  <?php foreach ($grup as $gr) {
                    $select = ($gr->KODE_GRUP_SATUAN_KERJA == $satker->KODE_GRUP_SATUAN_KERJA)?'selected':'';
                    echo '<option value="'.$gr->KODE_GRUP_SATUAN_KERJA.'" '.$select.'>'.$gr->GRUP_SATUAN_KERJA.'</option>';
                  } ?>
                </select>
              </div>
          </div>
          <div class="form-group row">
              <label for="instansi" class="col-sm-4 col-form-label">INSTANSI</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="instansi" name="instansi" value="KEMENTERIAN AGAMA" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label for="kabkota" class="col-sm-4 col-form-label">LOKASI KAB/KOTA</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="kabkota" name="kabkota" value="<?= $satker->KAB_KOTA?>">
              </div>
          </div>
          <div class="form-group row">
              <label for="provinsi" class="col-sm-4 col-form-label">LOKASI PROVINSI</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= $satker->PROVINSI?>">
              </div>
          </div>
          <input type="hidden" name="kode_satuan_kerja" value="<?= $satker->KODE_SATUAN_KERJA?>">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> <button type="submit" class="btn btn-primary" onclick="$('#ubahjabatan').submit()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/js/jquery.form.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();

    $('#buttonubah').on('click', function(event) {
      $('.ubahjabatan').modal('show');
    });

    $('#ubahjabatan').ajaxForm({
        beforeSend: function() {
            console.log('bersiaaap');
        },
      	complete: function(xhr) {
          obj = JSON.parse(xhr.responseText);

          if(obj.status)
          {
            Swal.fire(
              'Sukses!',
              obj.message,
              'success'
            ).then(function() {
                window.location = window.location.href;
            });
          }else{
            Swal.fire(
              'Error!',
              obj.message,
              'error'
            )
          }
        }
    });
  });

</script>
