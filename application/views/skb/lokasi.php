<div class="container-fluid site-width">
  <div class="row ">
    <div class="col-12  align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Lokasi Ujian pada Wilayah</h4></div>

        <div class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <div class="card bg-primary text-white h-100">
                            <div class="card-body text-center p-3 d-flex">
                                <div class="align-self-center text-center w-100">
                                    <h2 class="card-title font-weight-bold"><?= $jumlah->jumlah;?></h2>
                                    <span class="h4">Peserta</span>
                                </div>

                            </div>
                        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12  mt-3">
      <div class="card">
        <div class="card-header">
            <h5>Lokasi Ujian</h5>
            <span class="text-muted">Panitia Lokasi Ujian diharuskan menyediakan ruangan sesuai dengan Jumlah Ruangan yang tertera di masing-masing titik lokasi.</span>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><button type="button" class="btn btn-success float-right" onclick="addtilok()"><i class="zmdi zmdi-plus"></i>Tambah Titik Lokasi</button></li>
                </ul>
            </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Lokasi</th>
                <th>Alamat</th>
                <th>Jumlah Peserta</th>
                <th>Jumlah Ruang</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lokasi as $row) {?>
                <tr class="table-warning">
                  <td><?= $row->lokasi_titik;?></td>
                  <td></td>
                  <td><a href="<?= site_url('admin/skb/lokasi/index/'.$row->lokasi_kode);?>" class="text-danger"><?= $row->jumlah;?></a></td>
                  <td><?= $row->jumlah_ruangan;?></td>
                </tr>
                <?php
                $tiloks = $this->db->query("SELECT * FROM lokasi_titik WHERE lokasi_kode='$row->lokasi_kode'")->result();
                foreach ($tiloks as $tilok) {?>
                  <tr>
                    <td colspan="4">
                      <b><?php echo $tilok->tilok;?></b><br><br><b><?php echo $tilok->alamat;?></b><br><a href="<?php echo $tilok->maps;?>" target="_blank"><?php echo $tilok->maps;?></a><br><?php echo $tilok->kontak;?> | <?php echo $tilok->kontak_panitia;?>
                      <br><br><a href="javascript:;" onclick="detail('<?php echo $tilok->lokasi_kode;?>')">Edit</a> | <a href="<?php echo site_url('admin/skb/lokasi/delete/'.$tilok->lokasi_kode);?>" onclick="return confirm('Titik Lokasi akan dihapus?')" class="text-red">Delete</a>
                      </td>
                  </tr>
                <?php }
                if(count($tiloks) > 1){
                  ?>
                  <tr>
                    <td class="text-green"><a href="<?php echo site_url('admin/skb/lokasi/setjadwal/'.$row->lokasi_kode);?>" class="btn btn-danger">Tentukan Lokasi Peserta</a></td>
                    <td colspan="4"></td>
                  </tr>
                  <?php
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php if(isset($peserta)){ ?>
        <div class="card mt-3">
          <div class="card-header  justify-content-between align-items-center">
            <h6 class="card-title">Data Peserta Lokasi</h6>
          </div>
          <div class="card-body table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead class="text-center">
                  <tr>
                    <th>Nomor Peserta</th>
                    <th>Nama</th>
                    <th>Formasi</th>
                    <th>No HP</th>
                    <th>Satuan Kerja</th>
                    <th>Praktik Kerja (WIB)</th>
                    <th>Ruangan</th>
                    <th>Wawancara (WIB)</th>
                    <th>Ruangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($peserta as $row) {
                    ?>
                    <tr>
                      <td>'<?php echo $row->nopeserta;?></td>
                      <td><?php echo $row->nama;?></td>
                      <td><?php echo $row->formasi;?></td>
                      <td><?php echo $row->no_hp;?></td>
                      <td><?php echo $row->satker;?></td>
                      <td><?php echo $row->jadwal_praktik;?></td>
                      <td><?php echo $row->ruangan_praktik;?></td>
                      <td><?php echo $row->jadwal_wawancara;?></td>
                      <td><?php echo $row->ruangan_wawancara;?></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
            </div>
          </div>
      <?php } ?>
    </div>
  </div>
</div>

<div class="modal fade" id="addtilok" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="defaultModalLabel">Tambah Titik Lokasi</h4>
        <div id="progress"></div>
      </div>
      <div class="modal-body" id="">
        <form class="" action="<?php echo site_url('admin/skb/lokasi/add');?>" method="post" id="tambahtilok">
          <div class="form-group">
            <label for="">Lokasi Ujian</label>
            <select class="form-control" name="lokasi_kode">
              <?php foreach ($lokasi as $row) {?>
              <option value="<?php echo $row->lokasi_kode;?>"><?php echo $row->lokasi_titik;?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Titik Lokasi</label>
            <input type="text" class="form-control" name="tilok">
          </div>
          <!-- <div class="form-group">
            <label for="">Prefix Nomor Ruangan</label>
            <input type="text" class="form-control" name="prefix">
            <p class="help-block">Untuk Lokasi yang dipindahkan pada Lokasi yang sama dengan yang lainnya.</p>
            <p class="help-block">Silahkan dikosongkan jika tidak perlu</p>
            <p class="help-block">Untuk inisial nomor ruangan. Contoh Prefix A akan menjadi ABC-1, ABC-2</p>
          </div> -->
          <div class="form-group">
            <label for="">Kontak Untuk Peserta</label>
            <input type="number" class="form-control" name="kontak">
          </div>
          <div class="form-group">
            <label for="">Kontak Untuk Panitia Satker</label>
            <input type="number" class="form-control" name="kontak_panitia">
          </div>
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="">Link Google Maps (Link Share dari Google Maps)</label>
            <input type="text" class="form-control" name="maps">
          </div>
        </form>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary waves-effect" onclick="$('#tambahtilok').submit()">SIMPAN</button>
      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">BATAL</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="detaillokasi" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="defaultModalLabel">Detail Lokasi</h4>
        <div id="progress"></div>
      </div>
      <div class="modal-body" id="bodydetail">
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary waves-effect" onclick="$('#edittilok').submit()">SIMPAN</button>
      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
    </div>
  </div>
</div>
</div>

<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>assets/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    $("#btnupload").on("click", function() {
          $("#updatebulk").trigger("click");
    });

    $('#updatebulk').change(function() {
      $('#formbulk').submit();
    });

    $('.datatable').DataTable({
    dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
     responsive: true
 });
  });

  function addtilok() {
    $('#tambahtilok').trigger('reset');
    $('#addtilok').modal('show');
  }

  function detail(nik) {
    $('#bodydetail').load('<?= site_url('admin/skb/lokasi/get_detail');?>/'+nik);
    $('#detaillokasi').modal('show');
  }

</script>
