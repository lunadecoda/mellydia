<?php if($cek == 0) { ?>
<div class="form-group">
    <input class="form-control" name="tgl" type="date" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal" required>
</div>
<div class="form-group">
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id">
		<?php foreach ($produk as $k) { ?>
		<option value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
    <input class="form-control qty" name="qty" type="number" placeholder="Qty">
</div>
<div class="form-group">
    <input class="form-control satuan input-mask" name="harga_satuan" type="number" placeholder="Harga Satuan">
</div>
<div class="form-group">
    <input class="form-control total input-mask" name="total_harga" type="number" placeholder="Total arga">
</div>
<?php } else { ?>
<input type="hidden" name="id_pembelian" value="<?php echo $pembelian->id_pembelian;?>">
<input type="hidden" name="qty_lama" value="<?php echo $pembelian->qty;?>">
<div class="form-group">
    <input class="form-control" value="<?php echo $pembelian->tgl;?>" name="tgl" type="date" placeholder="Tanggal" required>
</div>
<div class="form-group">
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id">
		<?php foreach ($produk as $k) { ?>
		<option <?php if($pembelian->produk_id == $k->id_produk) { echo 'selected'; } ?> value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
    <input class="form-control qty" value="<?php echo $pembelian->qty;?>" name="qty" type="number" placeholder="Qty">
</div>
<div class="form-group">
    <input class="form-control satuan input-mask" value="<?php echo $pembelian->harga_satuan;?>" name="harga_satuan" type="number" placeholder="Harga Satuan">
</div>
<div class="form-group">
    <input class="form-control total input-mask" value="<?php echo $pembelian->total_harga;?>" name="total_harga" type="number" placeholder="Total arga">
</div>
<?php } ?>
<script>
$("select.select2").select2({
	dropdownAutoWidth: !0,
	width: "100%",
	dropdownParent: $("#myModal")
})
$(".satuan").on("change keydown paste input", function() {
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval * qty;
		$(".total").val(xhit);
	}
})

$(".total").on("change keydown paste input", function() {
	var qty = $(".qty").val();
	if(qty > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval / qty;
		$(".satuan").val(xhit);
	}
})
$(".qty").on("change keydown paste input", function() {
	var satuan = $(".satuan").val();
	if(satuan > 0) {
		var xval = $(this).val();
		xval = xval.replace(".","");
		var xhit = xval * satuan;
		$(".total").val(xhit);
	}
})
//$(".input-mask").mask('000.000.000.000.000', {reverse: true});
</script>