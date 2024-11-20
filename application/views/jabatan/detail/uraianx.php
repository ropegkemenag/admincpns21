<div class="card border mt-3">
  <div class="card-header">
    <h4 class="card-title">URAIAN JABATAN</h4>
  </div>
  <div class="card-body">
    <div class="row pills-stacked">
      <div class="col-md-3 col-sm-12">
        <ul class="nav nav-pills flex-column text-center text-md-left">
          <li class="nav-item">
            <a class="nav-link active" id="stacked-pill-3" data-toggle="pill" href="#vertical-pill-3" aria-expanded="true">
              3. TUGAS POKOK DAN FUNGSI JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-4" data-toggle="pill" href="#vertical-pill-4" aria-expanded="false">
              4. TUJUAN JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-5" data-toggle="pill" href="#vertical-pill-5" aria-expanded="false">
              5. URAIAN TUGAS DAN KEGIATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-6" data-toggle="pill" href="#vertical-pill-6" aria-expanded="false">
              6. BAHAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-7" data-toggle="pill" href="#vertical-pill-7" aria-expanded="false">
              7. PERALATAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-8" data-toggle="pill" href="#vertical-pill-8" aria-expanded="false">
              8. HASIL KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-9" data-toggle="pill" href="#vertical-pill-9" aria-expanded="false">
              9. WEWENANG
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-10" data-toggle="pill" href="#vertical-pill-10" aria-expanded="false">
              10. TANGGUNG JAWAB
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-11" data-toggle="pill" href="#vertical-pill-11" aria-expanded="false">
              11. DIMENSI JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-12" data-toggle="pill" href="#vertical-pill-12" aria-expanded="false">
              12. HUBUNGAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-13" data-toggle="pill" href="#vertical-pill-13" aria-expanded="false">
              13. MASALAH DAN TANTANGAN JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-14" data-toggle="pill" href="#vertical-pill-14" aria-expanded="false">
              14. RESIKO BAHAYA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-15" data-toggle="pill" href="#vertical-pill-15" aria-expanded="false">
              15. SYARAT JABATAN
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-9 col-sm-12">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="vertical-pill-3" aria-labelledby="stacked-pill-3" aria-expanded="true">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addform('tugas','TUGAS')">Tambah Tugas</button>
            <table class="table table-bordered mb-3" id="tabletugas">
              <thead>
                <tr>
                  <th width="10%">NO</th>
                  <th>URAIAN TUGAS</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addform('fungsi','FUNGSI')">Tambah Fungsi</button>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="10%">NO</th>
                  <th>FUNGSI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="vertical-pill-4" role="tabpanel" aria-labelledby="stacked-pill-4" aria-expanded="false">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addform('tujuanjabatan','TUJUAN JABATAN')">Tambah Tujuan Jabatan</button>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="10%">NO</th>
                  <th>TUJUAN JABATAN</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="vertical-pill-5" role="tabpanel" aria-labelledby="stacked-pill-5" aria-expanded="false">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addform('tugaskegiatan','Uraian Tugas dan Kegiatan')">Tambah Uraian Tugas dan Kegiatan</button>
            <table class="table table-bordered" id="tugaskegiatan">
              <thead>
                <tr>
                  <th width="10%">NO</th>
                  <th>URAIAN TUGAS DAN KEGIATAN</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade addform" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel10">Tambah Uraian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('jabatan/saveuraian');?>" method="post" id="addform">
          <div class="form-group row">
            <label for="parent" class="col-sm-4 col-form-label">INDUK</label>
            <div class="col-sm-8">
              <select class="form-control" name="parent">
                <option value="0">-Teratas-</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
              <label for="nomor" class="col-sm-4 col-form-label">NOMOR URUT</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="nomor" name="nomor" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="keterangan" class="col-sm-4 col-form-label" id="txtketerangan">URAIAN TUGAS DAN KEGIATAN</label>
              <div class="col-sm-8">
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
                <input type="hidden" name="kode_satuan_kerja" value="<?= $satker->KODE_SATUAN_KERJA;?>">
                <input type="hidden" name="uraian" id="uraian">
              </div>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> <button type="submit" class="btn btn-primary" onclick="$('#addform').submit()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#addform').ajaxForm({
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

  $('#tugaskegiatan').DataTable();
});

  function addform(type,txt) {
    $('#txtketerangan').html(txt);
    $('#uraian').val(type);
    $('.addform').modal('show');
  }
</script>
