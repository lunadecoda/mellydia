<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Jenis Pengeluaran</label><br>
    <input class="form-control" name="jenis_pengeluaran" type="text" placeholder="click here" required>
</div>
<div class="form-group">
	<label>Tanggal Pengeluaran</label><br>
    <input class="form-control" name="tanggal_pengeluaran" type="date" placeholder="click here" value="<?php echo date("Y-m-d");?>" required>
</div>
<div class="form-group">
	<label>Qty</label><br>
	<input class="form-control qty" name="qty" type="text" placeholder="click here" required>
</div>
<div class="form-group">
	<label>Harga Satuan</label><br>
	<input class="form-control satuan input-mask" name="harga_satuan" type="text" placeholder="click here" required>
</div>
<div class="form-group">
	<label>Total Pengeluaran</label><br>
	<input class="form-control total input-mask" name="total_pengeluaran" type="text" placeholder="click here" required>
</div>
<?php } else { ?>
<input type="hidden" name="id_pengeluaran" value="<?php echo $pengeluaran->id_pengeluaran;?>">
<div class="form-group">
	<label>Jenis Pengeluaran</label><br>
    <input class="form-control" value="<?php echo $pengeluaran->jenis_pengeluaran;?>" name="jenis_pengeluaran" type="text" placeholder="click here" required>
</div>
<div class="form-group">
	<label>Tanggal Pengeluaran</label><br>
    <input class="form-control" value="<?php echo $pengeluaran->tanggal_pengeluaran;?>" name="tanggal_pengeluaran" type="text" placeholder="click here" readonly>
</div>
<div class="form-group">
	<label>Qty</label><br>
	<input class="form-control qty" name="qty" type="text" value="<?php echo $pengeluaran->qty;?>" required>
</div>
<div class="form-group">
	<label>Harga Satuan</label><br>
	<input class="form-control satuan input-mask" name="harga_satuan" type="text" value="<?php echo $pengeluaran->harga_satuan;?>" required>
</div>
<div class="form-group">
	<label>Total Pengeluaran</label><br>
	<input class="form-control total input-mask" name="total_pengeluaran" type="text" value="<?php echo $pengeluaran->total_pengeluaran;?>" required>
</div>
<?php } ?>
<script>
$(".satuan").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		// xval = xval.replace(".","");
		var xhit = xval * qty;
		$(".total").val(xhit);
	}
	// $(".input-mask").mask('000.000.000.000.000', {reverse: true});
})

$(".total").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		// xval = xval.replace(".","");
		var xhit = xval / qty;
		$(".satuan").val(xhit);
	}
	// $(".input-mask").mask('000.000.000.000.000', {reverse: true});
})
$(".qty").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var satuan = $(".satuan").val();
	if(satuan > 0) {
		var xval = $(this).val();
		// xval = xval.replace(".","");
		var xhit = xval * satuan;
		$(".total").val(xhit);
	}
	// $(".input-mask").mask('000.000.000.000.000', {reverse: true});
})
// $(".input-mask").mask('000.000.000.000.000', {reverse: true});
</script>
