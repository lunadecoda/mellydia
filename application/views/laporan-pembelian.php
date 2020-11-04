<section class="content">
            <header class="content__title">
               <h1>Laporan Pembelian</h1>
            </header>
            <div class="card">
               <div class="card-body">
				<form class="form-inline" action="" method="post">
                     <div class="form-group mb-4 mr-sm-4">
                        <select class="form-control" name="produk_id">
						<option value="0">Semua Produk</option>
						<?php foreach ($produk as $ku) { ?>
							<option <?php if($ku->id_produk == $produk_id) { echo 'selected'; } ?> value="<?php echo $ku->id_produk;?>"><?php echo $ku->nama_produk;?></option>
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
								 <th>Tgl</th>
                                 <th>Produk</th>
								 <th>Qty</th>
								 <th>Harga Satuan</th>
								 <th>Harga Total</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
                                 <th>Produk</th>
								 <th>Qty</th>
								 <th>Harga Satuan</th>
								 <th>Harga Total</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1; $arr_harga = array();
                                 foreach ($pembelian as $k) { 
								 $arr_harga[] = $k->total_harga; ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td><?php echo date("j M Y", strtotime($k->tgl));?></td>
                                 <td><?php echo $k->nama_produk;?></td>
								 <td><?php echo $k->qty;?></td>
								 <td><?php echo number_format($k->harga_satuan,0,",",".");?></td>
								 <td><?php echo number_format($k->total_harga,0,",",".");?></td>
                              </tr>
                              <?php $no++; } ?>
                           </tbody>
						   <tbody>
							<tr class="bg-info text-white">
								<td colspan="4">Total</td>
								<td><?php echo number_format(array_sum($arr_harga),0,",",".");?></td>
								<td></td>
							</tr>
						   </tbody>
                     </table>
                  </div>
				  <div><h2>Grafik Jumlah Pembelian</h2>
				  <div class="flot-chart flot-line"></div>
				  <div class="flot-chart-legends flot-chart-legends--line"></div>
				  </div><br><br>
				  <div><h2>Grafik Harga Satuan</h2>
				  <div class="flot-chart flot-line-1"></div>
				  <div class="flot-chart-legends flot-chart-legends--line"></div>
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
$(document).ready(function () {
	setTimeout(function() {
		table = $("#datatables").DataTable({
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
		
		'use strict';

    // Chart Data
	var lineChartData = [
	<?php $num=0;
	foreach ($grafik_qty as $key => $value) { ?>
        {
            label: '<?php echo $key;?>',
            data: [[1,0],<?php $xnum=2; foreach ($value as $k => $v) { ?>[<?php echo $xnum;?>,<?php echo $v;?>],<?php $xnum++;} ?>],
        },
	<?php $num++; } ?>
    ];
	var lineChartData_1 = [
	<?php $num=0;
	foreach ($grafik_harga as $key => $value) { ?>
        {
            label: '<?php echo $key;?>',
            data: [[1,0],<?php $xnum=2; foreach ($value as $k => $v) { ?>[<?php echo $xnum;?>,<?php echo $v;?>],<?php $xnum++;} ?>],
        },
	<?php $num++; } ?>
    ];

    // Chart Options
    var lineChartOptions = {
        series: {
            lines: {
                show: true,
                barWidth: 0.05,
                fill: 0
            }
        },
        shadowSize: 0.1,
        grid : {
            borderWidth: 1,
            borderColor: '#edf9fc',
            show : true,
            hoverable : true,
            clickable : true
        },

        yaxis: {
            tickColor: '#edf9fc',
            tickDecimals: 0,
            font :{
                lineHeight: 13,
                style: 'normal',
                color: '#9f9f9f',
            },
            shadowSize: 0
        },

        xaxis: {
            tickColor: '#fff',
            tickDecimals: 0,
            font :{
                lineHeight: 13,
                style: 'normal',
                color: '#9f9f9f'
            },
            shadowSize: 0,
        },
        legend:{
            container: '.flot-chart-legends--line',
            backgroundOpacity: 0.5,
            noColumns: 0,
            backgroundColor: '#fff',
            lineWidth: 0,
            labelBoxBorderColor: '#fff'
        }
    };

    // Create chart
    if ($('.flot-line')[0]) {
        $.plot($('.flot-line'), lineChartData, lineChartOptions);
    }
	if ($('.flot-line-1')[0]) {
        $.plot($('.flot-line-1'), lineChartData_1, lineChartOptions);
    }
		
    }, 1500)
});
</script>