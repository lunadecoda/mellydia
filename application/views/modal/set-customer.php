<?php if(isset($member)) { ?>
<div class="form-group">
	<input class="form-control" name="nama_penerima" value="<?php echo $member->nama_member;?>" type="text" placeholder="Nama Penerima" required>
</div>
<div class="form-group">
	<textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima" required><?php echo $member->alamat_member;?></textarea>
</div>
<div class="form-group">
	<input class="form-control" name="telp_penerima" value="<?php echo $member->telp_member;?>" type="text" placeholder="Telp Penerima" required>
</div>
<?php } else { ?>
<div class="form-group">
	<input class="form-control" name="nama_penerima" type="text" placeholder="Nama Penerima" required>
</div>
<div class="form-group">
	<textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima" required></textarea>
</div>
<div class="form-group">
	<input class="form-control" name="telp_penerima" type="text" placeholder="Telp Penerima" required>
</div>
<?php } ?>