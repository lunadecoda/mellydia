<?php if($cek == 1) { ?>
<input type="hidden" name="id_member" value="<?php echo $penjualan->member_id;?>">
<input type="hidden" name="id_penjualan" value="<?php echo $penjualan->id_penjualan;?>">
<input type="hidden" name="total_harga" value="<?php echo $penjualan->total_harga;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $penjualan->nama_penerima;?>" name="nama_penerima" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Telp</label><br>
    <input class="form-control" value="<?php echo $penjualan->telp_penerima;?>" name="telp_penerima" type="text" placeholder="Telp" required>
</div>
<div class="form-group">
	<label>Alamat</label><br>
    <textarea class="form-control" placeholder="Alamat" name="alamat_penerima"><?php echo $penjualan->alamat_penerima;?></textarea>
</div>
<div class="form-group">
	<label>Ongkir</label><br>
    <input class="form-control" value="<?php echo $penjualan->ongkir;?>" name="ongkir" type="text" placeholder="Ongkir" required>
</div>
<div class="form-group">
	<label>Biaya Admin</label><br>
    <input class="form-control" value="<?php echo $penjualan->biaya_admin;?>" name="biaya_admin" type="text" placeholder="Biaya Admin" required>
</div>
<?php } ?>