<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama Paket</label><br>
    <input class="form-control" name="nama_paket" type="text" placeholder="Nama Paket" required>
</div>
<div class="form-group">
	<label>Produk</label><br>
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id[]" multiple>
		<?php foreach ($produk as $k) { ?>
		<option value="<?php echo $k->id_produk.'-'.$k->harga_jual;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
	<label>Total Harga</label><br>
    <input class="form-control totalharga" name="total_harga_paket" type="text" placeholder="Total Harga">
</div>
<?php } else { ?>
<input type="hidden" name="id_paket" value="<?php echo $paket->id_paket;?>">
<div class="form-group">
	<label>Nama Paket</label><br>
    <input class="form-control" value="<?php echo $paket->nama_paket;?>" name="nama_paket" type="text" placeholder="Nama Paket" required>
</div>
<div class="form-group">
	<label>Produk</label><br>
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="produk_id[]" multiple>
		<?php $arr_harga = array();
		foreach ($produk as $k) { ?>
		<option <?php foreach($paket_produk as $kp){ if($kp->produk_id == $k->id_produk) { $arr_harga[] = $k->harga_jual; echo 'selected'; } } ?> value="<?php echo $k->id_produk.'-'.$k->harga_jual;?>"><?php echo $k->nama_produk;?></option>
		<?php } ?>
	</select>
</div>
<div class="form-group">
	<label>Total Harga</label><br>
    <input class="form-control totalharga" value="<?php echo $paket->total_harga_paket;?>" name="total_harga_paket" type="text" placeholder="Total Harga">
</div>
<?php } ?>
<script>
$("select.select2").select2({
	dropdownAutoWidth: !0,
	width: "100%",
	dropdownParent: $("#myModal")
})
$('.select2').on('change', function (e) {
	$(".totalharga").unmask();
	var xlect = $(this).val();
	var xjum = [];
	var xnum = 1;
	//console.log(xlect);
	if(xlect.length == 0) {
		$(".totalharga").val(0);
	} else {
		$.each( xlect, function( key, value ) {
			var res = value.split("-");
			xjum.push(res[1]);
			if(xlect.length == xnum) {
				var total=0;
				for(var i in xjum) { total = parseInt(total) + parseInt(xjum[i]); }
				//var hit = 15/100 * total;
				//var cekhit = total-hit;
				cekhit = total;
				$(".totalharga").val(cekhit);
			}
		xnum++; });
	}
	$(".totalharga").mask('000.000.000.000.000', {reverse: true});
});
$(".totalharga").mask('000.000.000.000.000', {reverse: true});
</script>
