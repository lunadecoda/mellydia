<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Minimal Stock</label><br>
    <input class="form-control" name="batas" type="text" placeholder="100" required>
</div>
<?php } else { ?>
<input type="hidden" name="id" value="<?php echo $stok->id;?>">
<div class="form-group">
	<label>Minimal Stock</label><br>
    <input class="form-control" value="<?php echo $stok->batas;?>" name="batas" type="text" placeholder="100" required>
</div>
<?php } ?>