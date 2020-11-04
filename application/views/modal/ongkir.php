<input name="id_penjualan" type="hidden" value="<?php echo $penjualan->id_penjualan;?>">
<div class="form-group">
	<input class="form-control" name="nama_penerima" value="<?php echo $penjualan->nama_penerima;?>" type="text" placeholder="Nama Penerima" required>
</div>
<div class="form-group">
	<textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima" required><?php echo $penjualan->alamat_penerima;?></textarea>
</div>
<div class="form-group">
	<input class="form-control" name="telp_penerima" value="<?php echo $penjualan->telp_penerima;?>" type="text" placeholder="Telp Penerima" required>
</div>
<div class="form-group">
	<label>Ongkir</label><br>
    <input class="form-control input-mask ongkir" name="ongkir" value="<?php echo $penjualan->ongkir;?>" type="text" placeholder="15000" required>
</div>
<div class="form-group">
    <input class="form-control" name="kurir" type="text" value="<?php echo $penjualan->kurir;?>" placeholder="Jasa Pengirim (JNE/Pos)" required>
</div>
<div class="form-group">
    <input class="form-control" name="resi" type="text" value="<?php echo $penjualan->resi;?>" placeholder="No Resi" required>
</div>
<div class="form-group">
    <label>Total Berat <small>(satuan gram)</small></label><br>
	<input class="form-control input-mask" name="berat" type="text" value="<?php echo $penjualan->total_berat;?>" placeholder="Berat" required>
</div>
<div class="form-group">
	<input class="form-control harga-asli" type="hidden" value="<?php echo $penjualan->total_harga;?>">
    <input class="form-control input-mask ongkirtotal" type="text" value="<?php echo $penjualan->total_harga+$penjualan->ongkir;?>" disabled>
</div>
<script>
$(".input-mask").mask('000.000.000.000.000', {reverse: true});
$(document).on('change keydown paste input','.ongkir', function (e) {
	var a = $(".harga-asli").val();
	var b = $(this).val();
	b = b.replace(".","");
	var c = parseInt(a) + parseInt(b);
	$(".ongkirtotal").val(c);
});
</script>