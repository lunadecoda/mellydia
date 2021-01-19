<input name="id_penjualan" type="hidden" value="<?php echo $penjualan->id_penjualan;?>">
<input name="ongkir" type="hidden" value="<?php echo $penjualan->ongkir;?>">
<input name="total_harga" type="hidden" value="<?php echo $penjualan->total_harga;?>">
<!-- <input class="form-control" name="status" value="<?php echo $penjualan->status;?>" type="text"  required> -->
<div class="form-group">
	<label>Biaya Admin</label><br>
    <input class="form-control input-mask ongkir" name="biaya_admin" value="<?php echo $penjualan->biaya_admin;?>" type="text" placeholder="" required>
</div>