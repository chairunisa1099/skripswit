 <!-- Info boxes -->
 <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Produk</span>
              <span class="info-box-number"><?php echo $this->dashboard_model->total_produk()->total; ?><small> produk</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Customer</span>
        <span class="info-box-number"><?php echo $this->dashboard_model->total_pelanggan()->total; ?><small> orang</small></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Transaksi</span>
        <span class="info-box-number"><?php echo $this->dashboard_model->total_header_transaksi()->total; ?><small> transaksi</small></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Nilai Transaksi</span>
        <span class="info-box-number">Rp <?php echo number_format($this->dashboard_model->total_transaksi()->total) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  </div>
