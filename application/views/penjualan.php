<section class="content">
            <header class="content__title">
               <h1>Penjualan</h1>
               <div class="actions">
                  <button class="btn btn-primary font-btn" onclick="tambah()"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></button>
               </div>
            </header>
            <div class="card">
               <div class="card-body">
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
								 <th>Harga Total</th>
								 <th>Penerima</th>
								 <th>Marketplace</th>
                                 <th class="text-right">Actions</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                 <th>No</th>
								 <th>Tanggal</th>
								 <th>Harga Total</th>
								 <th>Penerima</th>
								 <th>Marketplace</th>
                                 <th class="text-right">Actions</th>
                              </tr>
                           </tfoot>
                           <tbody>
                              <?php $no=1;
                                 foreach ($penjualan as $k) { ?>
                              <tr>
                                 <td><?php echo $no;?></td>
								 <td>
								 <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".expand<?php echo $no;?>" aria-expanded="false" aria-controls="expand<?php echo $no;?>"><?php echo date("j M Y", strtotime($k->tgl_penjualan));?></button>
								</td>
								 <td><?php echo number_format($k->total_harga,0,",",".");?>
								 <div class="collapse mt-2 expand<?php echo $no;?>">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                            </div>
								 </td>
								 <td><?php echo $k->nama_penerima;?></td>
								 <td><?php echo $k->nama_market;?></td>
                                 <td class="td-actions text-right">
                                    <button type="button" onclick="ganti(<?php echo $k->id_penjualan;?>)" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                       <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                    </button>
                                    &nbsp; 
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="" onclick="hapus(<?php echo $k->id_penjualan;?>)">
                                       <i class="zmdi zmdi-close zmdi-hc-fw"></i>
                                    </button>
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
				title: "Export Data"
			}, {
				extend: "csvHtml5",
				title: "Export Data"
			}, {
				extend: "print",
				title: "Print"
			}],
			initComplete: function (a, b) {
				$(this).closest(".dataTables_wrapper").find(".dataTables__top").prepend('<div class="dataTables_buttons hidden-sm-down actions"><span class="actions__item zmdi zmdi-print" data-table-action="print" /><span class="actions__item zmdi zmdi-fullscreen" data-table-action="fullscreen" /><div class="dropdown actions__item"><i data-toggle="dropdown" class="zmdi zmdi-download" /><ul class="dropdown-menu dropdown-menu-right"><a href="" class="dropdown-item" data-table-action="excel">Excel (.xlsx)</a><a href="" class="dropdown-item" data-table-action="csv">CSV (.csv)</a></ul></div></div>')
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
					//location.reload();
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
	$("#form")[0].reset();
	$("#modal-lg").modal("show");
	$("#modalbody-lg").load("<?php echo base_url();?>penjualan/modal/", function (a) {
		$("#modalbody-lg").html(a)
	})
}

function ganti(a) {
	simpan = "update";
	$("#form")[0].reset();
	$("#modal-lg").modal("show");
	$("#modalbody-lg").load("<?php echo base_url();?>penjualan/edit/" + a, function (b) {
		$("#modalbody-lg").html(b)
	})
}


function hapus(a) {
	swal({
    title: "Hapus Data?",
    text: "",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!"
 }).then(
       function () { $.ajax({
			url: "<?php echo base_url()?>penjualan/delete/" + a,
			type: "POST",
			dataType: "JSON",
			success: function (b) {
				location.reload();
				//table.ajax.reload()
			},
			error: function (b, d, c) {
				swal("Error", "", "error")
			}
		}); },
       function () { return false; });
};
</script>