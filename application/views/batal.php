<section class="content">
            <header class="content__title">
               <h1>Pemabatalan Penjualan</h1>
               <div class="actions">
                  <button class="btn btn-primary font-btn" onclick="tambah()">Tambah</button>
               </div>
            </header>
            <div class="card">
               <div class="card-body">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan">Sedang Dikemas</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan/proses">Proses</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>penjualan/selesai">Selesai</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link active" href="#">Batal</a>
                    </li>
				</ul>
			   <br>
				<form class="form-inline" action="" method="post">
                     <div class="form-group mb-4 mr-sm-4">
						<select class="form-control" name="admin_id">
						<?php foreach ($user as $ku) { ?>
							<option <?php if($ku->id_admin == $admin_id) { echo 'selected'; } ?>><?php echo $ku->nama_admin;?></option>
						<?php } ?>
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
								 <th>Harga</th>
								 <th>Penerima</th>
								 <th>Marketplace</th>
                                 <th>Pemabatalan</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Harga</th>
								 <th>Penerima</th>
								 <th>Marketplace</th>
                                 <th>Pemabatalan</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1;
                                 foreach ($penjualan as $k) { ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td>
								 <?php echo date("j M Y", strtotime($k->tgl_penjualan));?>
								</td>
								 <td><div class="collapse mt-2 expand<?php echo $no;?>">
									<?php foreach($penjualan_paket as $kp) {
										if($kp->penjualan_id == $k->id_penjualan) {
										echo '<div class="border p-1">';
										if($kp->paket_id == 0) {
											echo "<b>Ecer</b><br><br>";
										} else {
											foreach ($paket as $kpaket) {
												if($kpaket->id_paket == $kp->paket_id) {
													echo "<b>".$kpaket->nama_paket.'</b><br><br>';
												}
											}
										}
										foreach ($produk as $kpro) {
											if($kpro->penjualan_paket_id == $kp->id_penjualan_paket) {
												echo $kpro->nama_produk."<br>".$kpro->qty." qty ".number_format($kpro->harga,0,",",".")."<hr>";
											}
										}
										echo 'Total '.number_format($kp->harga_paket,0,",",".");
										echo '</div><br>';
										}
									} ?>
									
								</div><b><?php echo number_format($k->total_harga,0,",",".");?></b>
								 </td>
								 <td><?php echo $k->nama_penerima;?><br>
								 <div class="collapse mt-2 expand<?php echo $no;?>">
									<?php echo $k->alamat_penerima."<br>".$k->telp_penerima; ?>
								</div>
								 </td>
								 <td><?php echo $k->nama_market;?></td>
								 <td><?php echo $k->ket;?></td>
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
			loadsub = 0;
			$(".input-mask").unmask()
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
</script>
