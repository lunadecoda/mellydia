<?php if($cek == 0) { ?>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
	<label>Tanggal</label><br>
    <input class="form-control" name="tgl" type="date" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal" required>
</div>
<div class="form-group">
	<label>Paket/Produk</label><br>
    <select class="select2 xtra" data-placeholder="Pilih Produk" name="set_produk">
		<option value="0" disabled selected>Pilih Paket/Produk</option>
		<?php foreach ($paket as $k) { ?>
		<option value="p-<?php echo $k->id_paket;?>"><?php echo $k->nama_paket;?></option>
		<?php } ?>
		<option disabled>------------</option>
		<?php foreach ($produk as $k) { ?>
		<option <?php if($k->stok <= 0) {echo ' disabled ';} ?> value="b-<?php echo $k->id_produk;?>"><?php echo $k->nama_produk." - stok ".$k->stok;?></option>
		<?php } ?>
	</select>
</div>
<div class="isi-pro"></div>
<div class="form-group">
	<label>Total Berat <small>(satuan gram)</small></label><br>
    <input class="form-control berat-total" value="0" name="total_berat" type="text" placeholder="Total Berat" required>
</div>
<div class="form-group">
	<label>Diskon <small>(dihitung dalam bentuk %)</small></label><br>
    <input class="form-control diskon" name="diskon" value="0" type="number" placeholder="Diskon">
</div>
<div class="form-group">
	<label>Total Harga <small>(sudah termasuk pajak 10%)</small></label><br>
    <input class="form-control harga-total" value="0" name="harga_total" type="text" placeholder="Harga Total" required>
</div>
</div>
<div class="col-sm-6">
	<div class="form-group">
		<label>Customer</label><br>
		<select class="select2 cust" data-placeholder="Pilih Customer" name="member_id">
			<option value="0">Customer Baru</option>
			<option disabled>------------</option>
			<?php foreach ($member as $k) { ?>
			<option value="<?php echo $k->id_member;?>"><?php echo $k->nama_member;?></option>
			<?php } ?>
		</select>
	</div>
	<div class="set-customer">
	<div class="form-group">
		<label>Nama Penerima</label><br>
		<input class="form-control" name="nama_penerima" type="text" placeholder="Nama Penerima" required>
	</div>
	<div class="form-group">
		<label>Alamat Penerima</label><br>
		<textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima" required></textarea>
	</div>
	<div class="form-group">
		<label>Telp Penerima</label><br>
		<input class="form-control" name="telp_penerima" type="text" placeholder="Telp Penerima" required>
	</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6">
			<label>Sales</label><br>
			<select class="select2" data-placeholder="Pilih Sales" name="admin_id">
				<?php foreach ($user as $k) { ?>
				<option <?php if($k->id_admin == $user_id){ echo 'selected'; } ?> value="<?php echo $k->id_admin;?>"><?php echo $k->nama_admin;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group col-sm-6">
			<label>Marketplace</label><br>
			<select class="select2" data-placeholder="Pilih Marketplace" name="sumber_id">
				<?php foreach ($market as $k) { ?>
				<option value="<?php echo $k->id_sumber;?>"><?php echo $k->nama_market;?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>

<?php } else { ?>
<input type="hidden" name="id_pembelian" value="<?php echo $penjualan->id_pembelian;?>">

<?php } ?>
<script>
$("select.select2").select2({
	dropdownAutoWidth: !0,
	width: "100%",
	dropdownParent: $(".modal")
})
$(".cust").on("change keydown paste input", function() {
	var a = $(".cust").val();
	$.get("<?php echo base_url();?>penjualan/set_customer/" + a, function (b) {
		$(".set-customer").html(b);
	})
})
$(".xtra").on("change keydown paste input", function() {
	var a = $(".xtra").val();
	$.get("<?php echo base_url();?>penjualan/set_produk/" + a, function (b) {
		$(".isi-pro").append(b);
		hitung();
		$(".xtra").val("0");
		$(".xtra").select2("destroy").select2({
			dropdownAutoWidth: !0,
			width: "100%",
			dropdownParent: $(".modal")
		});
		//$('.xtra').trigger('change');
	})
})
$(document).on('change keydown paste input','.set-pro,.diskon', function (e) {
	hitung();
});
$(document).on('change keydown paste input','.qty', function (e) {
	var id = $(this).attr('id');
	var a = $("."+id).val();
	var b = $(this).val();
	var c = a * b;
	var res = id.split("-");
	$(".harga-"+res[1]).val(c);
	
	var d = $(".berat-asli-"+res[1]).val();
	var e = b * d;
	$(".berat-"+res[1]).val(e);
	hitung();
});
$(document).on('change keydown paste input','.qtypro', function (e) {
	var id = $(this).attr('id');
	var res = id.split("-");
	var a = $(".qty-"+res[1]+res[0]).val();
	var b = $(this).val();
	var c = a * b;
	$(".harga-"+res[1]+res[0]).val(c);
	
	var d = $(".berat-asli-"+res[1]+res[0]).val();
	var e = b * d;
	$(".berat-"+res[1]+res[0]).val(e);
	
	var awal = 0;
	var xnum=1;
	$("."+res[1]+" .harga_paket").each(function(i,obj) {
		var xhit = $(this).val();
		xhit = xhit.replace(".","");
		//console.log($("."+res[1]+" .harga_paket").length);
		awal = parseInt(xhit) + awal;
		if(xnum == $("."+res[1]+" .harga_paket").length) {
			var hit = 15/100 * awal;
			var cekhit = awal-hit;
			$(".total-paket-"+res[1]).val(cekhit); 
		}
	xnum++;})
	
	var awal_berat = 0;
	var xnum=1;
	$("."+res[1]+" .berat").each(function(i,obj) {
		var xhit = $(this).val();
		xhit = xhit.replace(".","");
		awal_berat = parseInt(xhit) + awal_berat;
		if(xnum == $("."+res[1]+" .berat").length) {
			$(".berat-paket-"+res[1]).val(awal_berat); 
		}
	xnum++;})
	
	hitung();
});
function hapus_produk(id) {
	$("."+id).remove();
	hitung();
}
function hitung() {
	var awal = 0;
	var xnum=1;
	$(".input-mask").unmask();
	$(".harga").each(function(i,obj) {
		var xhit = $(this).val();
		xhit = xhit.replace(".","");
		//console.log(xhit);
		awal = parseInt(xhit) + awal;
		if(xnum == $(".harga").length) { 
			var disk = parseInt($(".diskon").val());
			if(disk > 0) {
				var hit = disk/100 * awal;
				awal = awal-hit;
			}
			var pajak = 10/100 * awal;
			awal = awal+pajak;
			$(".harga-total").val(awal); 
		}
	xnum++; })
	
	var awal_berat = 0;
	var xnum=1;
	$(".berat").each(function(i,obj) {
		var xhit = $(this).val();
		xhit = xhit.replace(".","");
		//console.log(xhit);
		awal_berat = parseInt(xhit) + awal_berat;
		if(xnum == $(".berat").length) {
			$(".berat-total").val(awal_berat); 
		}
	xnum++; })
	
	$(".input-mask").mask('000.000.000.000.000', {reverse: true});
}
$(".input-mask").mask('000.000.000.000.000', {reverse: true});
</script>