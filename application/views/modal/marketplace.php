<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama Market</label><br>
      <input class="form-control" name="nama_market" type="text" placeholder="Nama Market" required>
</div>
<?php } else { ?>
<input type="hidden" name="id_kategori" value="<?php echo $marketplace->id_market;?>">
<div class="form-group">
	<label>Nama Market</label><br>
      <input value="<?php echo $marketplace->nama_market;?>" class="form-control" name="nama_market" type="text" placeholder="Nama Market" required>
</div>
<?php } ?>
