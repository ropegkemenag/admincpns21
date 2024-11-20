<div class="card border mt-3">
  <div class="card-header">
    <h4 class="card-title">INFORMASI JABATAN</h4>
  </div>
  <div class="card-body">
    <div class="row pills-stacked">
      <div class="col-md-3 col-sm-12">
        <ul class="nav nav-pills flex-column text-center text-md-left">
          <li class="nav-item">
            <a class="nav-link active" id="stacked-pill-3" data-toggle="pill" href="#vertical-pill-3" aria-expanded="true">
              TUGAS POKOK
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-4" data-toggle="pill" href="#vertical-pill-4" aria-expanded="false">
              HASIL KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-5" data-toggle="pill" href="#vertical-pill-5" aria-expanded="false">
              BAHAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-6" data-toggle="pill" href="#vertical-pill-6" aria-expanded="false">
              PERANGKAT KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-7" data-toggle="pill" href="#vertical-pill-7" aria-expanded="false">
              TANGGUNG JAWAB
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-8" data-toggle="pill" href="#vertical-pill-8" aria-expanded="false">
              KORELASI JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-9" data-toggle="pill" href="#vertical-pill-9" aria-expanded="false">
              KONDISI LINGKUNGAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-10" data-toggle="pill" href="#vertical-pill-10" aria-expanded="false">
              KONDISI LINGKUNGAN KERJA
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-11" data-toggle="pill" href="#vertical-pill-11" aria-expanded="false">
              SYARAT JABATAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-12" data-toggle="pill" href="#vertical-pill-12" aria-expanded="false">
              PRESTASI KERJA YANG DIHARAPKAN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stacked-pill-13" data-toggle="pill" href="#vertical-pill-13" aria-expanded="false">
              KELAS JABATAN
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
                  <th>HASIL KERJA</th>
                  <th>JUMLAH HASIL</th>
                  <th>WAKTU PENYELESAIAN (JAM)</th>
                  <th>WAKTU EFEKTIF</th>
                  <th>KEBUTUHAN PEGAWAI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
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
        <h5 class="modal-title" id="myLargeModalLabel10">Tambah Tugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('jabatan/saveuraian');?>" method="post" id="addform">
          <div class="form-group row">
              <label for="uraian" class="col-sm-4 col-form-label">URAIAN TUGAS</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="uraian" name="uraian" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="hasil_kerja" class="col-sm-4 col-form-label">HASIL KERJA</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="hasil_kerja" name="hasil_kerja" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="jumlah_hasil" class="col-sm-4 col-form-label">JUMLAH HASIL</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="jumlah_hasil" name="jumlah_hasil" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="waktu_selesai" class="col-sm-4 col-form-label">WAKTU PENYELESAIAN (JAM)</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="waktu_efektif" class="col-sm-4 col-form-label">WAKTU EFEKTIF</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="waktu_efektif" name="waktu_efektif" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="kebutuhan_pegawai" class="col-sm-4 col-form-label">KEBUTUHAN PEGAWAI</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="kebutuhan_pegawai" name="kebutuhan_pegawai" required>
                  <input type="hidden" name="kode_satuan_kerja" value="<?= $satker->KODE_SATUAN_KERJA;?>">
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
    $('.addform').modal('show');
  }
</script>
