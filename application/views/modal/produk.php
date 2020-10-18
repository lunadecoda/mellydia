<?php if($cek == 0) { ?>
<div class="form-group">
    <input class="form-control" name="nama_produk" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
    <input class="form-control input-mask" name="harga_jual" type="text" placeholder="Harga Jual" required>
</div>
<div class="form-group">
    <input class="form-control" name="stok" type="text" placeholder="Stok" required>
</div>
<div class="form-group">
    <input class="form-control" name="berat" type="text" placeholder="Berat (g)" required>
</div>
<div class="form-group">
    <?php foreach ($kategori as $k) { ?>
		<label>
		<input type="checkbox" name="kategori_id[]" value="<?php echo $k->id_kategori;?>"><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_kategori;?>
		</label>
	<?php } ?>
</div>

<?php } else { ?>
<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk;?>">
<div class="form-group">
    <input class="form-control" value="<?php echo $produk->nama_produk;?>" name="nama_produk" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
    <input class="form-control input-mask" value="<?php echo $produk->harga_jual;?>" name="harga_jual" type="text" placeholder="Harga Jual" required>
</div>
<div class="form-group">
    <input class="form-control" value="<?php echo $produk->berat;?>" name="berat" type="text" placeholder="Berat" required>
</div>
<div class="form-group">
    <?php foreach ($kategori as $k) { ?>
		<label>
		<input type="checkbox" name="kategori_id[]" value="<?php echo $k->id_kategori;?>" <?php foreach ($produk_kategori as $v){ if($v->kategori_id == $k->id_kategori) { echo 'checked'; } } ?>><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_kategori;?>
		</label>
	<?php } ?>
</div>
<?php } ?>
<script>
$('.input-mask').mask('000.000.000.000.000', {reverse: true});
</script>