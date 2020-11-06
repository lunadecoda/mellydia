<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama Produk</label><br>
    <input class="form-control" name="nama_produk" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Harga Beli</label><br>
    <input class="form-control input-mask" name="harga_beli" type="text" placeholder="Harga Beli" required>
</div>
<div class="form-group">
	<label>Harga Jual</label><br>
    <input class="form-control input-mask" name="harga_jual" type="text" placeholder="Harga Jual" required>
</div>
<div class="form-group">
	<label>Stok</label><br>
    <input class="form-control" name="stok" type="text" placeholder="Stok" required>
</div>
<div class="form-group">
	<label>Berat <small>dalam bentuk gram</small></label><br>
    <input class="form-control" name="berat" type="text" placeholder="Berat (g)" required>
</div>
<div class="form-group">
	<label>Kode Produk</label><br>
    <input class="form-control" name="nama_produk" type="text" placeholder="Kode" required>
</div>
<div class="form-group">
	<label>Kategori</label><br>
    <?php foreach ($kategori as $k) { ?>
		<label>
		<input type="checkbox" name="kategori_id[]" value="<?php echo $k->id_kategori;?>"><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_kategori;?>
		</label>
	<?php } ?>
</div>

<?php } else { ?>
<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk;?>">
<div class="form-group">
	<label>Nama Produk</label><br>
    <input class="form-control" value="<?php echo $produk->nama_produk;?>" name="nama_produk" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Harga Beli</label><br>
    <input class="form-control input-mask" name="harga_beli" value="<?php echo $produk->harga_beli;?>" type="text" placeholder="Harga Beli" required>
</div>
<div class="form-group">
	<label>Harga Jual</label><br>
    <input class="form-control input-mask" value="<?php echo $produk->harga_jual;?>" name="harga_jual" type="text" placeholder="Harga Jual" required>
</div>
<div class="form-group">
	<label>Stok</label><br>
    <input class="form-control" name="stok" value="<?php echo $produk->stok;?>" type="text" placeholder="Stok" required>
</div>
<div class="form-group">
    <label>Berat <small>dalam bentuk gram</small></label><br>
	<input class="form-control" value="<?php echo $produk->berat;?>" name="berat" type="text" placeholder="Berat" required>
</div>
<div class="form-group">
	<label>Kode Produk</label><br>
    <input class="form-control" name="nama_produk" value="<?php echo $produk->kode_produk;?>" type="text" placeholder="Kode" required>
</div>
<div class="form-group">
	<label>Kategori</label><br>
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