<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" name="nama_admin" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Email</label><br>
    <input class="form-control" name="email_admin" type="email" placeholder="Email" required>
</div>
<div class="form-group">
	<label>Password</label><br>
    <input class="form-control" name="password" type="password" placeholder="*****" required>
</div>
<div class="form-group">
	<label>Akses</label><br>
	<?php foreach ($modul as $key) { 
	echo "<b>".$key->nama_modul.'</b><br>'; ?>
    <?php foreach ($akses as $k) {
		if($k->modul_id == $key->id_modul) { ?>
		<label>
		<input type="checkbox" name="akses_id[]" value="<?php echo $k->id_akses;?>"><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_akses;?>
		</label>
	<?php } } echo '<br><br>'; ?>
	<?php } ?>
</div>
<?php } else { ?>
<input type="hidden" name="id_admin" value="<?php echo $user->id_admin;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $user->nama_admin;?>" name="nama_admin" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Email</label><br>
    <input class="form-control" value="<?php echo $user->email_admin;?>" name="email_admin" type="email" placeholder="Email" required>
</div>
<div class="form-group">
	<label>Password</label><br>
    <input class="form-control" name="password" type="password" placeholder="*****">
</div>
<div class="form-group">
	<label>Akses</label><br>
	<?php foreach ($modul as $key) { 
	echo "<b>".$key->nama_modul.'</b><br>'; ?>
    <?php foreach ($akses as $k) {
		if($k->modul_id == $key->id_modul) { ?>
		<label>
		<input type="checkbox" name="akses_id[]" value="<?php echo $k->id_akses;?>" <?php foreach ($akses_menu as $v){ if($v->akses_id == $k->id_akses) { echo 'checked'; } } ?>><span class="checkbox-material"><span class="check"></span></span> <?php echo $k->nama_akses;?>
		</label>
	<?php } } echo '<br><br>'; ?>
	<?php } ?>
</div>
<?php } ?>