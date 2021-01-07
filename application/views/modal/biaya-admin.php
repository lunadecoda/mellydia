<input name="id_penjualan" type="hidden" value="<?php echo $penjualan->id_penjualan;?>">
<input class="form-control" name="status" value="<?php echo $penjualan->status;?>" type="text"  required>
<div class="form-group">
	<label>Biaya Admin</label><br>
    <input class="form-control input-mask ongkir" name="biaya_admin" value="<?php echo $penjualan->biaya_admin;?>" type="text" placeholder="" required>
</div>
<!-- <div class="form-group">
	<label>Nama Penerima</label><br>
	<input class="form-control" name="nama_penerima" value="<?php echo $penjualan->nama_penerima;?>" type="text" placeholder="Nama Penerima" required>
</div>
<div class="form-group">
	<label>Alamat Penerima</label><br>
	<textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima" required><?php echo $penjualan->alamat_penerima;?></textarea>
</div>
<div class="form-group">
	<label>Telp Penerima</label><br>
	<input class="form-control" name="telp_penerima" value="<?php echo $penjualan->telp_penerima;?>" type="text" placeholder="Telp Penerima" required>
</div>
<div class="form-group">
	<label>Ongkir</label><br>
    <input class="form-control input-mask ongkir" name="ongkir" value="<?php echo $penjualan->ongkir;?>" type="text" placeholder="15000" required>
</div>
<div class="form-group">
	<label>Jasa Pengirim</label><br>
    <input class="form-control" name="kurir" type="text" value="<?php echo $penjualan->kurir;?>" placeholder="Jasa Pengirim (JNE/Pos)" required>
</div>
<div class="form-group">
	<label>No Resi</label><br>
    <input class="form-control" name="resi" type="text" value="<?php echo $penjualan->resi;?>" placeholder="No Resi" required>
</div>
<div class="form-group">
	<label>No Resi</label><br>
    <input class="form-control" name="tgl_proses" type="date" value="<?php echo $penjualan->tgl_proses;?>" placeholder="No Resi" required>
</div>
<div class="form-group">
    <label>Total Berat <small>(satuan gram)</small></label><br>
	<input class="form-control input-mask" name="berat" type="text" value="<?php echo $penjualan->total_berat;?>" placeholder="Berat" required>
</div>
<div class="form-group">
	<label>Total Harga</label><br>
	<input class="form-control harga-asli" type="hidden" value="<?php echo $penjualan->total_harga;?>">
    <input class="form-control input-mask ongkirtotal" type="text" value="<?php echo $penjualan->total_harga+$penjualan->ongkir;?>" disabled>
</div> -->
