<link rel="stylesheet" href="<?= asset_url();?>css/jquery.orgchart.css">
<style media="screen">
#chart-container {
position: relative;
height: 420px;
border: 1px solid #aaa;
margin: 0.5rem;
overflow: auto;
text-align: center;
}
.orgchart{
  background-image: initial;
}
.orgchart .node .title {
    width: 200px;
    height: initial;
    white-space: initial;
}
.orgchart .node .content {
    height: initial;
    white-space: initial;
    width: 200px;
}
</style>
<div class="card border">
  <div class="card-header">
    <h4 class="card-title">STRUKTUR JABATAN</h4>
  </div>
  <div class="card-body">
    <div id="chart-container"></div>
  </div>
</div>

<script src="<?= base_url();?>assets/js/jquery.mockjax.min.js"></script>
<script src="<?= base_url();?>assets/js/jquery.orgchart.js"></script>
<script type="text/javascript">
    $(function() {

      $('#chart-container').orgchart({
        'data' : '<?= site_url('jabatan/struktur/'.$satker->KODE_SATUAN_KERJA)?>',
        'nodeContent': 'title'
      });

    });
  </script>
