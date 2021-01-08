<section class="content">
            <header class="content__title">
               <h1>Laporan Penjualan</h1>
            </header>
            <div class="card">
               <div class="card-body">
				<form class="form-inline" action="" method="post">
                     <div class="form-group mb-4 mr-sm-4">
                        <select class="form-control" name="produk_id">
						<option value="go">Semua Produk</option>
						<?php foreach ($paket as $ku) { ?>
							<option <?php if("a-".$ku->id_paket == $produk_id) { echo 'selected'; } ?> value="<?php echo "a-".$ku->id_paket;?>"><?php echo $ku->nama_paket;?></option>
						<?php } ?>
						<option disabled>-----------</option>
						<?php foreach ($produk as $ku) { ?>
							<option <?php if("b-".$ku->id_produk == $produk_id) { echo 'selected'; } ?> value="<?php echo "b-".$ku->id_produk;?>"><?php echo $ku->nama_produk;?></option>
						<?php } ?>
						</select>
                     </div>
					 <div class="form-group mb-4 mr-sm-4">
                        <select class="form-control" name="admin_id">
						<option value="0">Semua Penjual</option>
						<?php foreach ($user as $ku) { ?>
							<option <?php if($ku->id_admin == $admin_id) { echo 'selected'; } ?> value="<?php echo $ku->id_admin;?>"><?php echo $ku->nama_admin;?></option>
						<?php } ?>
						</select>
                     </div>
					 <div class="form-group mb-4 mr-sm-4">
                        <select class="form-control" name="member_id">
						<option value="0">Semua Customer</option>
						<?php foreach ($member as $ku) { ?>
							<option <?php if($ku->id_member == $member_id) { echo 'selected'; } ?> value="<?php echo $ku->id_member;?>"><?php echo $ku->nama_member." - ".$ku->telp_member;?></option>
						<?php } ?>
						</select>
                     </div>
					 <div class="form-group mb-4 mr-sm-4">
                        <select class="form-control" name="ket">
						<option value="go">Filter Tambahan</option>
						<option value="Sampel Promo" <?php if($ket == "Sampel Promo") { echo 'selected'; } ?>>Sampel Promo</option>
						<option value="Ganti Produk" <?php if($ket == "Ganti Produk") { echo 'selected'; } ?>>Ganti Produk</option>
						</select>
                     </div>
					 <div class="form-group mb-4 mr-sm-4">
                        <input type="date" class="form-control" name="start" value="<?php echo $awal;?>">
                        <i class="form-group__bar"></i>
                     </div>
                     <div class="form-group mb-4 mr-sm-4">
                        <input type="date" class="form-control" name="end" value="<?php echo $akhir;?>">
                        <i class="form-group__bar"></i>
                     </div>
                     <button type="submit" class="btn btn-primary mb-4">Filter</button>
				</form>
				<?php if(isset($penjualan_paket)) { ?>
                <div>
					<h2>Paket Terjual</h2>
				  <div class="table-responsive">
                     <table class="table table-bordered datatables" id="datatables">
                        <thead>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Paket</th>
								 <th>Qty</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Paket</th>
								 <th>Qty</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1;
								$xnum = 0;
								$arr_qtyPaket = array();
                                 foreach ($penjualan_paket[0] as $v => $k) { 
								 foreach ($penjualan_paket[1] as $newk => $newv) {
								 	$arr_qtyPaket[] = $newv[$xnum];
								if($newv[$xnum] > 0) {
								 ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td><?php echo date("j M Y", strtotime($k));?>
								 </td>
								 <td><?php echo $newk;?></td>
								 <td><?php echo $newv[$xnum];?></td>
                              </tr>
								 <?php $no++; } } $xnum++; } ?>
                           </tbody>
                           <tbody>
                           	<?php  ?>
							<tr class="bg-info text-white">
								<td colspan="3">Total</td>
								<td><?php echo array_sum($arr_qtyPaket);?></td>
								<!-- <td>cro</td> -->
							</tr>
						   </tbody>
                     </table>
                  </div>
				  <div style="width:95%;">
				  <canvas id="line-paket"></canvas>
				  </div><br><br>
				</div>
				<hr>
				<?php } ?>
				<?php if(isset($penjualan)) { ?>
				<div>
					<h2>Produk Terjual</h2>
				  <div class="table-responsive">
                     <table class="table table-bordered datatables" id="datatables">
                        <thead>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Produk</th>
								 <th>Qty</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Produk</th>
								 <th>Qty</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1;
								$xnum = 0;
								$arr_qtyProduk = array();
                                 foreach ($penjualan[0] as $v => $k) { 
								 foreach ($penjualan[1] as $newk => $newv) {
								 	$arr_qtyProduk[] = $newv[$xnum];
								if($newv[$xnum] > 0) {
								 ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td><?php echo date("j M Y", strtotime($k));?>
								 </td>
								 <td><?php echo $newk;?></td>
								 <td><?php echo $newv[$xnum];?></td>
                              </tr>
								 <?php $no++; } } $xnum++; } ?>
                           </tbody>
                           <tbody>
                           	<?php  ?>
							<tr class="bg-info text-white">
								<td colspan="3">Total</td>
								<td><?php echo array_sum($arr_qtyProduk);?></td>
								<!-- <td>cro</td> -->
							</tr>
						   </tbody>
                     </table>
                  </div>
				  <div style="width:95%;">
				  <canvas id="line-chart"></canvas>
				  </div><br><br>
				</div>
				<?php } ?>
               </div>
            </div>
            <footer class="footer hidden-xs-down">
               <p>© Mellydia's Team <?php echo date("Y");?>.</p>
            </footer>
         </section>

<script>
var table;
var simpan;
$(document).ready(function () {
	setTimeout(function() {
		table = $(".datatables").DataTable({
			autoWidth: !1,
			responsive: !0,
			lengthMenu: [
				[15, 30, 45, -1],
				["15 Rows", "30 Rows", "45 Rows", "Everything"]
			],
			language: {
				searchPlaceholder: "Search for records..."
			},
			sDom: '<"dataTables__top"lfB>rt<"dataTables__bottom"ip><"clear">',
			buttons: [{
				extend: "excelHtml5",
				title: "Export Data",
				exportOptions: {
					format: {
						body: function(data, column, row) {
							if (typeof data === 'string' || data instanceof String) {
								data = data.replace(/<br\s*\/?>/ig, "\r\n");
							}
							data = data.replace(/<.*?>/ig, "");
							return data;
						}
					}
				},
			}, {
				extend: "print",
				title: "Print"
			}],
			initComplete: function (a, b) {
				$(this).closest(".dataTables_wrapper").find(".dataTables__top").prepend('<div class="dataTables_buttons hidden-sm-down actions"><div class="dropdown actions__item"><i data-toggle="dropdown" class="zmdi zmdi-download" /><ul class="dropdown-menu dropdown-menu-right"><a href="" class="dropdown-item" data-table-action="excel">Excel (.xlsx)</a></ul></div></div>')
			}
		}), $(".dataTables_filter input[type=search]").focus(function () {
			$(this).closest(".dataTables_filter").addClass("dataTables_filter--toggled")
		}), $(".dataTables_filter input[type=search]").blur(function () {
			$(this).closest(".dataTables_filter").removeClass("dataTables_filter--toggled")
		}), $("body").on("click", "[data-table-action]", function (a) {
			a.preventDefault();
			var b = $(this).data("table-action");
			if ("excel" === b && $(this).closest(".dataTables_wrapper").find(".buttons-excel").trigger("click"), "csv" === b && $(this).closest(".dataTables_wrapper").find(".buttons-csv").trigger("click"), "print" === b && $(this).closest(".dataTables_wrapper").find(".buttons-print").trigger("click"), "fullscreen" === b) {
				var c = $(this).closest(".card");
				c.hasClass("card--fullscreen") ? (c.removeClass("card--fullscreen"), $("body").removeClass("data-table-toggled")) : (c.addClass("card--fullscreen"), $("body").addClass("data-table-toggled"))
			}
		})
		
	<?php if(isset($penjualan_paket)) { ?>
	new Chart(document.getElementById("line-paket"), {
	  type: 'line',
	  data: {
		labels: [<?php foreach($penjualan_paket[0] as $v => $k) { echo "'".date("j M Y", strtotime($k))."',"; } ?>],
		datasets: [
		<?php foreach ($penjualan_paket[1] as $newk => $newv) { ?>
		{
			data: [<?php foreach($newv as $xnewv => $xnewk) { echo $xnewk.","; } ?>],
			label: "<?php echo $newk;?>",
			borderColor: getRandomColor(),
			fill: false
		  },
		<?php } ?>
		]
	  },
	  options: {
		title: {
		  display: true,
		  text: ''
		}
	  }
	});
	<?php } ?>
	<?php if(isset($penjualan)) { ?>
	new Chart(document.getElementById("line-chart"), {
	  type: 'line',
	  data: {
		labels: [<?php foreach($penjualan[0] as $v => $k) { echo "'".date("j M Y", strtotime($k))."',"; } ?>],
		datasets: [
		<?php foreach ($penjualan[1] as $newk => $newv) { ?>
		{
			data: [<?php foreach($newv as $xnewv => $xnewk) { echo $xnewk.","; } ?>],
			label: "<?php echo $newk;?>",
			borderColor: getRandomColor(),
			fill: false
		  },
		<?php } ?>
		]
	  },
	  options: {
		title: {
		  display: true,
		  text: ''
		}
	  }
	});
	<?php } ?>
	
		
    }, 1500)
});
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
</script>