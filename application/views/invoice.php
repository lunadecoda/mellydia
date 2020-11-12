<style>
@media print {
	.invoice {
		transform: scale(.3);
		transform-origin: top left;
	}
	.main .header, .main .sidebar{
		display:none;
	}
	body, .content__inner {
		min-width: unset !important;
		max-width: unset !important;
	}
	.invoice, .content {
		padding:0 !important;
		margin:0 !important;
	}
	.invoice {
		position:absolute !important;
		top:0;
		left:0;
	}
	@page {
		margin: 0.5cm;
		size: 15cm 10.5cm;
	}
}
</style>
<section class="content printableArea">
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Invoice</h1>
                    </header>

                    <div class="invoice">
                        <div class="row invoice__address" style="margin-bottom: 1.5rem !important;">
                            <div class="col-6">
                                <div class="text-right">
                                    <p>Dikirim Oleh:</p>

                                    <h4>Mellydia Cosmetic</h4>

                                    <address>
                                    Perumahan Bumi Citra Fajar, Sekawan Ayu F No.55b-55c, Bulusidokare, Sidoarjo Sub-Distrcit, Sidoarjo Regency, East Java 61234
                                    </address>

                                    0895-3671-70228<br/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="text-left">
                                    <p>Penerima</p>

                                    <h4><?php echo $penjualan->nama_penerima;?></h4>

                                    <address>
                                        <?php echo $penjualan->alamat_penerima;?>
                                    </address>

                                    <?php echo $penjualan->telp_penerima;?><br/>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center invoice__attrs" style="margin-bottom: 1.5rem !important;">
                            <div class="col-3">
                                <div class="invoice__attrs__item">
                                    <small>Tanggal</small>
                                    <h4><?php echo date("j M Y", strtotime($penjualan->tgl_penjualan));?></h4>
                                </div>
                            </div>
							<?php if($penjualan->resi != NULL) { ?>
								<div class="col-3">
                                <div class="invoice__attrs__item">
                                    <small>No Resi</small>
                                    <h4><?php echo $penjualan->resi;?></h4>
                                </div>
                            </div>
							<?php } ?>
							<div class="col-3">
                                <div class="invoice__attrs__item">
                                    <small>Grand Total</small>
                                    <h4><?php echo number_format($penjualan->total_harga+$penjualan->ongkir,0,",",".");?></h4>
                                </div>
                            </div>
                        </div>


                        <table class="table table-bordered invoice__table">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>Produk</th>
									<th>Berat</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($penjualan_paket as $kp) {
										echo '<tr><td style="width: 50%">';
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
												echo $kpro->nama_produk."<br>";
											}
										}
										echo '</td>';
										echo "<td>".number_format($kp->berat_paket,0,",",".")." gram</td>";
										echo '</tr>';
								} ?>
                            </tbody>
                        </table>
                    </div>

                    <button class="btn btn-danger btn--action " data-ma-action="print"><i class="zmdi zmdi-print"></i></button>
                </div>

                <footer class="footer hidden-xs-down">
				   <p>© Mellydia's Team <?php echo date("Y");?>.</p>
				</footer>
            </section>
