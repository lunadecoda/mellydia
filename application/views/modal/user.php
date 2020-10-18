<?php if($cek == 0) { ?>
<div class="form-group">
    <input class="form-control" name="nama_admin" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
    <input class="form-control" name="email_admin" type="email" placeholder="Email" required>
</div>
<div class="form-group">
    <input class="form-control" name="password" type="password" placeholder="*****" required>
</div>
<div class="form-group">
    <?php foreach ($akses as $k) { ?>
		<label>
		<input type="checkbox" name="akses_id[]" value="<?php echo $k->id_akses;?>"><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_akses;?>
		</label>
	<?php } ?>
</div>
<?php } else { ?>
<input type="hidden" name="id_admin" value="<?php echo $user->id_admin;?>">
<div class="form-group">
    <input class="form-control" value="<?php echo $user->nama_admin;?>" name="nama_admin" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
    <input class="form-control" value="<?php echo $user->email_admin;?>" name="email_admin" type="email" placeholder="Email" required>
</div>
<div class="form-group">
    <input class="form-control" name="password" type="password" placeholder="*****">
</div>
<div class="form-group">
    <?php foreach ($akses as $k) { ?>
		<label>
		<input type="checkbox" name="akses_id[]" <?php foreach ($akses_admin as $v){ if($v->akses_id == $k->id_akses) { echo 'checked'; } } ?> value="<?php echo $k->id_akses;?>"><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_akses;?>
		</label>
	<?php } ?>
</div>
<?php } ?>
