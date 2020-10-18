<?php if($cek == 0) { ?>
<div class="form-group">
      <input class="form-control" name="nama_kategori" type="text" placeholder="Nama Kategori" required>
</div>
<?php } else { ?>
<input type="hidden" name="id_kategori" value="<?php echo $kategori->id_kategori;?>">
<div class="form-group">
      <input value="<?php echo $kategori->nama_kategori;?>" class="form-control" name="nama_kategori" type="text" placeholder="Nama Kategori" required>
</div>
<?php } ?>
