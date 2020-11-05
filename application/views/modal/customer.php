<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" name="nama_member" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Telp</label><br>
    <input class="form-control" name="telp_member" type="text" placeholder="Telp" required>
</div>
<div class="form-group">
	<label>Alamat</label><br>
    <textarea class="form-control" placeholder="Alamat" name="alamat_member"></textarea>
</div>
<?php } else { ?>
<input type="hidden" name="id_member" value="<?php echo $member->id_member;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $member->nama_member;?>" name="nama_member" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Telp</label><br>
    <input class="form-control" value="<?php echo $member->telp_member;?>" name="telp_member" type="text" placeholder="Telp" required>
</div>
<div class="form-group">
	<label>Alamat</label><br>
    <textarea class="form-control" placeholder="Alamat" name="alamat_member"><?php echo $member->alamat_member;?></textarea>
</div>
<?php } ?>
