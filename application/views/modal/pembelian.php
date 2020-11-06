<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Tanggal</label><br>
    <input class="form-control" name="tgl" type="date" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal" required>
</div>
<div class="form-group">
	<label>Produk</label><br>
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id">
		<?php foreach ($produk as $k) { ?>
		<option value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
	<label>Quantity</label><br>
    <input class="form-control qty" name="qty" type="text" placeholder="Qty">
</div>
<div class="form-group">
	<label>Harga Satuan</label><br>
    <input class="form-control satuan input-mask" name="harga_satuan" type="text" placeholder="Harga Satuan">
</div>
<div class="form-group">
	<label>Total Harga</label><br>
    <input class="form-control total input-mask" name="total_harga" type="text" placeholder="Total arga">
</div>
<?php } else { ?>
<input type="hidden" name="id_pembelian" value="<?php echo $pembelian->id_pembelian;?>">
<input type="hidden" name="qty_lama" value="<?php echo $pembelian->qty;?>">
<div class="form-group">
	<label>Tanggal</label><br>
    <input class="form-control" value="<?php echo $pembelian->tgl;?>" name="tgl" type="date" placeholder="Tanggal" required>
</div>
<div class="form-group">
	<label>Produk</label><br>
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id">
		<?php foreach ($produk as $k) { ?>
		<option <?php if($pembelian->produk_id == $k->id_produk) { echo 'selected'; } ?> value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
	<label>Quantity</label><br>
    <input class="form-control qty" value="<?php echo $pembelian->qty;?>" name="qty" type="text" placeholder="Qty">
</div>
<div class="form-group">
	<label>Harga Satuan</label><br>
    <input class="form-control satuan input-mask" value="<?php echo $pembelian->harga_satuan;?>" name="harga_satuan" type="text" placeholder="Harga Satuan">
</div>
<div class="form-group">
	<label>Total Harga</label><br>
    <input class="form-control total input-mask" value="<?php echo $pembelian->total_harga;?>" name="total_harga" type="text" placeholder="Total arga">
</div>
<?php } ?>
<script>
$("select.select2").select2({
	dropdownAutoWidth: !0,
	width: "100%",
	dropdownParent: $("#myModal")
})
$(".satuan").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval * qty;
		$(".total").val(xhit);
	}
	$(".input-mask").mask('000.000.000.000.000', {reverse: true});
})

$(".total").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval / qty;
		$(".satuan").val(xhit);
	}
	$(".input-mask").mask('000.000.000.000.000', {reverse: true});
})
$(".qty").on("change keydown paste input", function() {
	$(".input-mask").unmask();
	var satuan = $(".satuan").val();
	if(satuan > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval * satuan;
		$(".total").val(xhit);
	}
	$(".input-mask").mask('000.000.000.000.000', {reverse: true});
})
$(".input-mask").mask('000.000.000.000.000', {reverse: true});
</script>
