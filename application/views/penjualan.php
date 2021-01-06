<style>
.table tr td {
	vertical-align:top !important;
}
.table td, .table th {
	padding:0.4rem !important;
}
</style>
<section class="content">
            <header class="content__title">
               <h1>Penjualan</h1>
               <div class="actions">
                  <button class="btn btn-primary font-btn" onclick="tambah()">Tambah</button>
               </div>
            </header>
            <div class="card">
               <div class="card-body">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#">Sedang Dikemas</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan/proses">Proses</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan/selesai">Selesai</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan/batal">Batal</a>
                    </li>
				</ul>
			   <br>
			   
				<form class="form-inline" action="" method="post">
                     <div class="form-group mb-4 mr-sm-4">
						<select class="form-control" name="admin_id">
						<option value="0">Semua Penjual</option>
						<?php foreach ($user as $ku) { ?>
							<option <?php if($ku->id_admin == $admin_id) { echo 'selected'; } ?> value="<?php echo $ku->id_admin;?>"><?php echo $ku->nama_admin;?></option>
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
                  <div class="table-responsive">
                     <table class="table table-bordered" id="datatables">
                        <thead>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Penjual</th>
								 <th>Sku</th>
								 <th>Qty</th>
								 <th>Penerima</th>
								 <th>Alamat</th>
								 <th>No Telp</th>
								 <th>Marketplace</th>
								 <th>Harga</th>
								 <th>Ongkir</th>
								 <th>Biaya Admin</th>
								 <th>Total</th>
								 <th>Keterangan</th>
								 <th></th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Penjual</th>
								 <th>Sku</th>
								 <th>Qty</th>
								 <th>Penerima</th>
								 <th>Alamat</th>
								 <th>No Telp</th>
								 <th>Marketplace</th>
								 <th>Harga</th>
								 <th>Ongkir</th>
								 <th>Biaya Admin</th>
								 <th>Total</th>
								 <th>Keterangan</th>
								 <th></th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1;
								$arr_harga = array();
								$arr_total = array();
                                 foreach ($penjualan as $k) { 
								 $arr_harga[] = $k->total_harga;
								 $arr_total[] = $k->total_harga + $k->ongkir;
								 ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td>Pembelian <?php echo date("j M Y", strtotime($k->tgl_penjualan));?>
								 <div class="collapse mt-2 expand<?php echo $no;?>">
									Proses <?php echo date("j M Y", strtotime($k->tgl_proses));?><br>
									Selesai <?php echo date("j M Y", strtotime($k->tgl_selesai));?>
								</div>
								 </td>
								 <td><?php echo $k->nama_admin;?></td>
								 <td>
									<?php foreach($penjualan_paket as $kp) {
										if($kp->penjualan_id == $k->id_penjualan) {
										echo '<div class="border p-1">';
										if($kp->paket_id == 0) {
											echo "<b>Ecer</b><br><br>";
										} else {
											foreach ($paket as $kpaket) {
												if($kpaket->id_paket == $kp->paket_id) {
													echo "<b>".$kpaket->kode_paket.'</b><br><br>';
												}
											}
										}
										echo '<div class="collapse mt-2 expand'.$no.'">';
										foreach ($produk as $kpro) {
											if($kpro->penjualan_paket_id == $kp->id_penjualan_paket) {
												echo $kpro->kode_produk."<br><hr>";
											}
										}
										echo '</div></div><br>';
										}
									} ?>
								 </td>
								 <td>
									<?php foreach($penjualan_paket as $kp) {
										if($kp->penjualan_id == $k->id_penjualan) {
										echo '<div class="border p-1">';
										echo $kp->qty_paket."<br><br>";
										echo '<div class="collapse mt-2 expand'.$no.'">';
										foreach ($produk as $kpro) {
											if($kpro->penjualan_paket_id == $kp->id_penjualan_paket) {
												echo $kpro->qty."<br><hr>";
											}
										}
										echo '</div></div><br>';
										}
									} ?>
								 </td>
								 <td><?php echo $k->nama_penerima;?></td>
								 <td><?php echo $k->alamat_penerima;?></td>
								 <td><?php echo $k->telp_penerima;?></td>
								 <td><?php echo $k->nama_market;?></td>
								 <td><?php echo number_format($k->total_harga,0,",",".");?></td>
								 <td><?php echo number_format($k->ongkir,0,",",".");?></td>
								 <td><?php echo number_format($k->biaya_admin,0,",",".");?></td>
								 <td><b><?php echo number_format($k->total_harga+$k->ongkir,0,",",".");?></b></td>
								 <td><?php echo $k->ket;?></td>
                                 <td class="td-actions text-right">
									<a class="btn btn-warning mb-2" href="<?php echo base_url();?>penjualan/invoice/<?php echo $k->id_penjualan;?>" target="_blank">Invoice</a>
									<button class="btn btn-primary mb-2" type="button" data-toggle="collapse" data-target=".expand<?php echo $no;?>" aria-expanded="false" aria-controls="expand<?php echo $no;?>">Detail</button>
									<button type="button" onclick="kirim(<?php echo $k->id_penjualan;?>)" rel="tooltip" class="btn btn-info btn-round mb-2" data-original-title="" title="">Resi</button>
									<button type="button" rel="tooltip" class="btn btn-danger btn-round mb-2" data-original-title="" title="" onclick="hapus(<?php echo $k->id_penjualan;?>)">Batal</button>
                                 </td>
                              </tr>
                              <?php $no++; } ?>
                           </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <footer class="footer hidden-xs-down">
               <p>© Mellydia's Team <?php echo date("Y");?>.</p>
            </footer>
         </section>

<script>
var table;
var simpan;
var simpan_alt;
var loadsub = 1;
function columnToLetter(column) {
	var temp, letter = '';
	while (column > 0) {
		temp = (column - 1) % 15;
		letter = String.fromCharCode(temp + 65) + letter;
		column = (column - temp - 1) / 15;
	}
	return letter;
}

function remove_tags(html) {
	html = html.replace(/<br>/g, "$br$");
	html = html.replace(/(?:\r\n|\r|\n)/g, '$n$');
	var tmp = document.createElement("DIV");
	tmp.innerHTML = html;
	html = tmp.textContent || tmp.innerText;

	html = html.replace(/\$br\$/g, "<br>");
	html = html.replace(/\$n\$/g, "<br>");

	return html;
}
$(document).ready(function () {
	setTimeout(function () {
		table = $("#datatables").DataTable({
			sDom: '<"dataTables__top"lfB>rt<"dataTables__bottom"ip><"clear">',
			buttons: [{
				extend: 'excelHtml5',
				text: 'Excel',
				title: "Export Data",
				exportOptions: {
					columns: ':not(:last-child)',
					format: {
						body: function (data, row, column, node) {

							//need to change double quotes to single
							data = data.replace(/"/g, "'");

							// replace p with br
							data = data.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, '<br>');

							// replace div with br
							data = data.replace(/<div[^>]*>/g, '').replace(/<\/div>/g, '<br>');

							data = remove_tags(data);


							//split at each new line
							splitData = data.split('<br>');

							//remove empty string
							splitData = splitData.filter(function (v) {
								return v !== ''
							});

							data = '';
							for (i = 0; i < splitData.length; i++) {
								//add escaped double quotes around each line
								data += '\"' + splitData[i] + '\"';
								//if its not the last line add CHAR(13)
								if (i + 1 < splitData.length) {
									data += ', CHAR(10), ';
								}
							}

							//Add concat function
							data = 'CONCATENATE(' + data + ')';
							return data;

						}
					}
				},
				customize: function (xlsx) {

					var sSh = xlsx.xl['styles.xml'];

					var styleSheet = sSh.childNodes[0];

					cellXfs = styleSheet.childNodes[5];

					// Using this instead of "" (required for Excel 2007+, not for 2003)
					var ns = "http://schemas.openxmlformats.org/spreadsheetml/2006/main";

					// Create a custom style
					var lastStyleNum = $('cellXfs xf', sSh).length - 1;
					var wrappedTopIndex = lastStyleNum + 1;
					var newStyle = document.createElementNS(ns, "xf");
					// Customize style
					newStyle.setAttribute("numFmtId", 0);
					newStyle.setAttribute("fontId", 0);
					newStyle.setAttribute("fillId", 0);
					newStyle.setAttribute("borderId", 0);
					newStyle.setAttribute("applyFont", 1);
					newStyle.setAttribute("applyFill", 1);
					newStyle.setAttribute("applyBorder", 1);
					newStyle.setAttribute("xfId", 0);
					// Alignment (optional)
					var align = document.createElementNS(ns, "alignment");
					align.setAttribute("vertical", "top");
					align.setAttribute("wrapText", 1);
					newStyle.appendChild(align);
					// Append the style next to the other ones
					cellXfs.appendChild(newStyle);


					var sheet = xlsx.xl.worksheets['sheet1.xml'];

					var firstExcelRow = 3;

					table.rows({
						order: 'applied',
						search: 'applied'
					}).every(function (rowIdx, tableLoop, rowLoop) {

						var node = this.node();

						var num_colonne = $(node).find("td").length;

						// the cell with biggest number of line inside it determine the height of entire row
						var maxCountLinesRow = 1;


						for (var indexCol = 1; indexCol <= num_colonne; indexCol++) {

							var letterExcel = columnToLetter(indexCol);

							$('c[r=' + letterExcel + (firstExcelRow + rowLoop) + ']', sheet).each(function (e) {


								// how many lines are present in this cell?
								var countLines = ($('is t', this).text().match(/\"/g) || []).length / 2;

								if (countLines > maxCountLinesRow) {
									maxCountLinesRow = countLines;
								}

								if ($('is t', this).text()) {
									//wrap text top vertical top
									$(this).attr('s', wrappedTopIndex);

									//change the type to `str` which is a formula
									$(this).attr('t', 'str');
									//append the concat formula
									$(this).append('<f>' + $('is t', this).text() + '</f>');
									//remove the inlineStr
									$('is', this).remove();
								}

							});

							$('row:nth-child(' + (firstExcelRow + rowLoop) + ')', sheet).attr('ht', maxCountLinesRow * 18);
							$('row:nth-child(' + (firstExcelRow + rowLoop) + ')', sheet).attr('customHeight', 1);

						}

					});


				}

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
		
		$(".xform-lg").on("submit", (function (b) {
			b.preventDefault();
			if(loadsub == 1) {
			$(this).find(':submit').attr('disabled','disabled');
			loadsub = 0;
			$(".input-mask").unmask();
			var a;
			if (simpan == "tambah") {
				a = "<?php echo base_url();?>penjualan/add"
			} else {
				a = "<?php echo base_url();?>penjualan/update"
			}
			$.ajax({
				url: a,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (c) {
					$("#modal-lg").modal("hide");
					//swal("Sukses!", "", "success");
					location.reload();
					loadsub = 1;
				},
				error: function (c, e, d) {
					swal("Error", "", "error")
				}
			});
			}
			return false
		}));
		
		$(".xform").on("submit", (function (b) {
			b.preventDefault();
			$(".input-mask").unmask();
			var a;
			if(simpan_alt == "hapus") {
				a = "<?php echo base_url();?>penjualan/update_delete";
			} else {
				a = "<?php echo base_url();?>penjualan/update_ongkir";
			}
			$.ajax({
				url: a,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (c) {
					$("#modal-lg").modal("hide");
					//swal("Sukses!", "", "success");
					location.reload();
				},
				error: function (c, e, d) {
					swal("Error", "", "error")
				}
			});
			return false
		}));
		
    }, 1500)
});

function tambah() {
	simpan = "tambah";
	$(".form")[0].reset();
	$("#modal-lg").modal("show");
	$("#modalbody-lg").load("<?php echo base_url();?>penjualan/modal/", function (a) {
		$("#modalbody-lg").html(a)
	})
}

function ganti(a) {
	simpan = "update";
	$(".form")[0].reset();
	$("#modal-lg").modal("show");
	$("#modalbody-lg").load("<?php echo base_url();?>penjualan/edit/" + a, function (b) {
		$("#modalbody-lg").html(b)
	})
}

function kirim(a) {
	simpan_alt = "ongkir";
	$(".form")[0].reset();
	$("#myModal").modal("show");
	$("#modalbody").load("<?php echo base_url();?>penjualan/ongkir/" + a, function (b) {
		$("#modalbody").html(b);
	})
}

function hapus(a) {
	simpan_alt = "hapus";
	$(".form")[0].reset();
	$("#myModal").modal("show");
	$("#modalbody").load("<?php echo base_url();?>penjualan/hapus/" + a, function (b) {
		$("#modalbody").html(b);
	})
}
</script>
