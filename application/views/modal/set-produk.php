<?php if(isset($produk_isi)) { ?>
<div class="border border-success p-2 <?php echo time();?> mb-4">
	<div class="row">
		<div class="form-group col-9">
			<label>Produk</label><br>
			<input type="hidden" name="paket_id[]" value="0-<?php echo time();?>">
			<select class="select2 set-pro" data-placeholder="Pilih Produk" name="produk_id_<?php echo time();?>[]">
				<?php foreach ($produk as $k) { ?>
				<option <?php if($produk_isi->id_produk == $k->id_produk) { echo ' selected '; } if($k->stok <= 0) {echo ' disabled ';} ?> value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk." - stok ".$k->stok;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="text-right form-group col-3"><button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="" onclick="hapus_produk('<?php echo time();?>')"><i class="zmdi zmdi-close zmdi-hc-fw"></i></button></div>
		<div class="form-group col-sm-6">
			<label>Berat <small>(satuan gram)</small></label><br>
			<input class="form-control berat-asli-<?php echo time();?>" value="<?php echo $produk_isi->berat;?>" id="berat-asli-<?php echo time();?>" type="hidden">
			<input value="<?php echo $produk_isi->berat;?>" class="berat-<?php echo time();?>" name="berat_paket[]" type="hidden">
			<input class="form-control berat berat-<?php echo time();?>" value="<?php echo $produk_isi->berat;?>" name="berat_<?php echo time();?>[]" id="berat-<?php echo time();?>" type="number" readonly>
		</div>
		<div class="form-group col-sm-6">
			<label>Qty</label><br>
			<input class="form-control qty" min="1" max="<?php echo $produk_isi->stok;?>" value="1" name="qty_<?php echo time();?>[]" id="qty-<?php echo time();?>" type="number">
		</div>
		<div class="form-group col-12">
			<label>Harga</label><br>
			<input type="hidden" name="harga_asli" value="<?php echo $produk_isi->harga_jual;?>" class="hasli qty-<?php echo time();?>">
			<input value="<?php echo $produk_isi->harga_jual;?>" class="harga-<?php echo time();?>" name="harga_paket[]" type="hidden">
			<input class="form-control input-mask harga harga-<?php echo time();?>" value="<?php echo $produk_isi->harga_jual;?>" name="harga_<?php echo time();?>[]" type="text" readonly>
		</div>
	</div>
</div>
<?php } elseif(isset($paket)) { ?>
<div class="border border-success p-2 <?php echo time();?> mb-4">
	<div class="row">
		<div class="form-group col-9">
			<label>Paket</label><br>
			<input type="hidden" name="paket_id[]" value="<?php echo $paket->id_paket;?>-<?php echo time();?>">
			<input class="form-control" value="<?php echo $paket->nama_paket;?>" name="nama_paket" type="text" disabled>
		</div>
		<div class="text-right form-group col-3"><button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="" onclick="hapus_produk('<?php echo time();?>')"><i class="zmdi zmdi-close zmdi-hc-fw"></i></button></div>
	<?php $num= 1;
	$arr_harga = array();
	$arr_berat = array();
	foreach ($paket_isi as $produk_isi) { $arr_harga[] = $produk_isi->harga_jual; $arr_berat[] = $produk_isi->berat; ?>
		<div class="form-group col-9 <?php echo time().$num;?>">
			<label>Produk</label><br>
			<select class="select2 set-pro" data-placeholder="Pilih Produk" name="produk_id_<?php echo time();?>[]">
				<?php foreach ($produk as $k) { ?>
				<option <?php if($produk_isi->id_produk == $k->id_produk) { echo ' selected '; } if($k->stok <= 0) {echo ' disabled ';} ?> value="<?php echo $k->id_produk;?>"><?php echo $k->nama_produk." - stok ".$k->stok;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="text-right form-group col-3 <?php echo time().$num;?>"><button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="" onclick="hapus_produk('<?php echo time().$num;?>')"><i class="zmdi zmdi-close zmdi-hc-fw"></i></button></div>
		<div class="form-group col-sm-6 <?php echo time().$num;?>">
			<label>Berat <small>(satuan gram)</small></label><br>
			<input class="form-control berat-asli-<?php echo time().$num;?>" value="<?php echo $produk_isi->berat;?>" id="berat-asli-<?php echo time().$num;?>" type="hidden">
			<input class="form-control berat berat-<?php echo time().$num;?>" value="<?php echo $produk_isi->berat;?>" name="berat_<?php echo time();?>[]" id="berat-<?php echo time().$num;?>" type="number" readonly>
		</div>
		<div class="form-group col-sm-6 <?php echo time().$num;?>">
			<label>Qty</label><br>
			<input class="form-control qtypro" min="1" max="<?php echo $produk_isi->stok;?>" id="<?php echo $num;?>-<?php echo time();?>" value="1" name="qty_<?php echo time();?>[]" type="number">
		</div>
		<div class="form-group col-12 <?php echo time().$num;?>">
			<label>Harga</label><br>
			<input type="hidden" name="harga_asli" value="<?php echo $produk_isi->harga_jual;?>" class="hasli qty-<?php echo time().$num;?>">
			<input class="form-control input-mask harga_paket harga-<?php echo time().$num;?>" value="<?php echo $produk_isi->harga_jual;?>" name="harga_<?php echo time();?>[]" type="text" readonly>
		</div>
		<div class="col-sm-12"><hr></div>
	<?php $num++;} ?>
	</div>
	<div class="form-group">
		<label>Berat Paket <small>(satuan gram)</small></label><br>
		<input class="form-control berat-paket input-mask berat-paket-<?php echo time();?>" value="<?php echo array_sum($arr_berat);?>" name="berat_paket[]" type="text" required>
	</div>
	<div class="form-group">
		<label>Harga Paket <small>harga total otomatis -15%</small></label><br>
		<input class="form-control harga input-mask total-paket-<?php echo time();?>" value="<?php echo array_sum($arr_harga) - (15/100 * array_sum($arr_harga));?>" name="harga_paket[]" type="text" required>
	</div>
</div>
<?php } ?>
<script>
$("select.select2").select2({
	dropdownAutoWidth: !0,
	width: "100%",
	dropdownParent: $(".modal")
})
$(".input-mask").mask('000.000.000.000.000', {reverse: true});
</script>