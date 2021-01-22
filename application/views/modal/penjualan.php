<?php if($cek == 0) { ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Tanggal</label><br>
            <input class="form-control" name="tgl" type="date" value="<?php echo date("Y-m-d");?>" placeholder="Tanggal"
                required>
        </div>
        <div class="form-group">
            <label>Paket/Produk</label><br>
            <div class="row">
                <div class="col-10 produk-paket">
                    <select class="select2 xtra" data-placeholder="Pilih Produk" name="set_produk">
                        <option value="0" disabled selected>Pilih Paket/Produk</option>
                        <?php foreach ($paket as $k) { ?>
                        <option value="p-<?php echo $k->id_paket;?>"><?php echo $k->nama_paket;?></option>
                        <?php } ?>
                        <option disabled>------------</option>
                        <?php foreach ($produk as $k) { ?>
                        <option <?php if($k->stok <= 0) {echo ' disabled ';} ?> value="b-<?php echo $k->id_produk;?>">
                            <?php echo $k->nama_produk." - stok ".$k->stok;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-1">
                    <i class="zmdi zmdi-plus zmdi-hc-fw" onclick="open_produk();"
                        style="font-size:130%;margin-top:10px;cursor:pointer;"></i>
                </div>
            </div>
        </div>
        <div class="isi-pro"></div>
        <div class="form-group">
            <label>Total Berat <small>(satuan gram)</small></label><br>
            <input class="form-control berat-total" value="0" name="total_berat" type="text" placeholder="Total Berat"
                required>
        </div>
        <div class="form-group">
            <label>Diskon <small>(dihitung dalam bentuk %)</small></label><br>
            <input class="form-control diskon" name="diskon" value="0" type="text" placeholder="Diskon">
        </div>
        <div class="form-group">
            <label>Total Harga</label><br>
            <input class="form-control harga-total" value="0" name="harga_total" type="text" placeholder="Harga Total"
                required>
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
                    <option <?php if($k->id_admin == $user_id){ echo 'selected'; } ?>
                        value="<?php echo $k->id_admin;?>"><?php echo $k->nama_admin;?></option>
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
        <div class="form-group">
            <label>Keterangan (optional)</label><br>
            <select class="form-control" name="ket">
                <option value="">Pilih</option>
                <option value="Sampel Promo">Sampel Promo</option>
                <option value="Ganti Produk">Ganti Produk</option>
            </select>
        </div>
    </div>

    <?php } else if($cek=1){ ?>

    <input type="hidden" name="id_penjualan" value="<?php echo $penjualan->id_penjualan;?>">
    <input type="hidden" name="id_member" value="<?php echo $penjualan->member_id;?>">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal</label><br>
                <input class="form-control" name="tgl" type="date" value="<?php echo $penjualan->tgl_penjualan;?>"
                    placeholder="Tanggal" required>
            </div>
            <div>
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
            <div class="isi-pro"></div>
            <div class="form-group">
                <label>Total Berat <small>(satuan gram)</small></label><br>
                <input class="form-control berat-total" value="<?php echo $penjualan->total_berat ?>" name="total_berat"
                    type="text" placeholder="Total Berat" required>
            </div>
            <div class="form-group">
                <label>Diskon <small>(dihitung dalam bentuk %)</small></label><br>
                <input class="form-control diskon" name="diskon" value="<?php echo $penjualan->diskon ?>" readonly
                    type="text" placeholder="Diskon">
            </div>
            <div class="form-group">
                <label>Total Harga</label><br>
                <input class="form-control harga-total" value="<?php echo $penjualan->total_harga ?>" readonly
                    name="harga_total" type="text" placeholder="Harga Total" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Customer</label><br>
                <div class="form-group">
                    <label>Nama Penerima</label><br>
                    <input class="form-control" name="nama_penerima" type="text" placeholder="Nama Penerima" required
                        value="<?php echo $penjualan->nama_penerima ?>">
                </div>
                <div class="form-group">
                    <label>Alamat Penerima</label>
                    <textarea class="form-control" name="alamat_penerima" placeholder="Alamat Penerima"
                        required><?php echo $penjualan->alamat_penerima ?></textarea>
                </div>
                <div class="form-group">
                    <label>Telp Penerima</label><br>
                    <input class="form-control" name="telp_penerima" type="text" placeholder="Telp Penerima"
                        value="<?php echo $penjualan->telp_penerima ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Sales</label><br>
                    <select class="select2" data-placeholder="Pilih Sales" name="admin_id">
                        <?php foreach ($user as $k) { ?>
                        <option value="<?php echo $penjualan->admin_id ?>" selected><?php echo $penjualan->nama_admin ?>
                        </option>
                        <option <?php if($k->id_admin == $user_id){ echo 'selected'; } ?>
                            value="<?php echo $k->id_admin;?>"><?php echo $k->nama_admin;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Marketplace</label><br>
                    <select class="select2" data-placeholder="Pilih Marketplace" name="sumber_id">
                        <option value="<?php echo $penjualan->sumber_id ?>" selected>
                            <?php echo $penjualan->nama_market ?></option>
                        <?php foreach ($market as $k) { ?>
                        <option value="<?php echo $k->id_sumber;?>"><?php echo $k->nama_market;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan (optional)</label>
                    <select class="form-control" name="ket">
                        <option value="<?php echo $penjualan->ket ?>"><?php echo $penjualan->ket ?></option>
                        <option value="Sampel Promo">Sampel Promo</option>
                        <option value="Ganti Produk">Ganti Produk</option>
                    </select>
                </div>
            </div>
            <?php } ?>
            <script>
            $("select.select2").select2({
                dropdownAutoWidth: !0,
                width: "100%",
                dropdownParent: $(".modal")
            })
            $(".cust").on("change keydown paste input", function() {
                var a = $(".cust").val();
                $.get("<?php echo base_url();?>penjualan/set_customer/" + a, function(b) {
                    $(".set-customer").html(b);
                })
            })
            $(".xtra").on("change keydown paste input", function() {
                var a = $(".xtra").val();
                $.get("<?php echo base_url();?>penjualan/set_produk/" + a, function(b) {
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
            $(document).on('change keydown paste input', '.set-pro,.diskon', function(e) {
                hitung();
            });
            $(document).on('change keydown paste input', '.qty', function(e) {
                var id = $(this).attr('id');
                var a = $("." + id).val();
                var b = $(this).val();
                var c = a * b;
                var res = id.split("-");
                $(".harga-" + res[1]).val(c);

                var d = $(".berat-asli-" + res[1]).val();
                var e = b * d;
                $(".berat-" + res[1]).val(e);
                hitung();
            });
            $(document).on('change keydown paste input', '.qtypro', function(e) {
                var id = $(this).attr('id');
                var res = id.split("-");
                var a = $(".qty-" + res[1] + res[0]).val();
                var b = $(this).val();
                var c = a * b;
                $(".harga-" + res[1] + res[0]).val(c);

                var d = $(".berat-asli-" + res[1] + res[0]).val();
                var e = b * d;
                $(".berat-" + res[1] + res[0]).val(e);

                var awal = 0;
                var xnum = 1;
                $("." + res[1] + " .harga_paket").each(function(i, obj) {
                    var xhit = $(this).val();
                    xhit = xhit.replace(".", "");
                    awal = parseInt(xhit) + awal;
                    if (xnum == $("." + res[1] + " .harga_paket").length) {
                        cekhit = awal;
                        $(".total-paket-" + res[1]).val(cekhit);
                    }
                    xnum++;
                })

                var awal_berat = 0;
                var xnum = 1;
                $("." + res[1] + " .berat").each(function(i, obj) {
                    var xhit = $(this).val();
                    xhit = xhit.replace(".", "");
                    awal_berat = parseInt(xhit) + awal_berat;
                    if (xnum == $("." + res[1] + " .berat").length) {
                        $(".berat-paket-" + res[1]).val(awal_berat);
                    }
                    xnum++;
                })

                hitung();
            });
            $(document).on('change keydown paste input', '.qty-paket', function(e) {
                var id = $(this).attr('id');
                var res = id.split("-");
                var isi = $(this).val();
                $(".qty-paket-isi-" + res[res.length - 1]).val(isi);
                $(".qty-paket-isi-" + res[res.length - 1]).trigger('change');

                if ($(".qty-paket-isi-" + res[res.length - 1]).length == $(".qty-paket-isi-" + res[res.length -
                        1])
                    .length) {
                    var x = $(".harga-paket-awal-" + res[res.length - 1]).val();
                    $(".total-paket-" + res[res.length - 1]).val(x * isi);
                    hitung();
                }

            })
            $(document).on('change keydown paste input', '.harga', function(e) {
                hitung();
            })

            function hapus_produk(id) {
                $("." + id).remove();
                $(".qtypro").trigger('change');
                hitung();
            }

            function hitung() {
                var awal = 0;
                var xnum = 1;
                $(".input-mask").unmask();
                if ($(".harga").length == 0) {
                    $(".harga-total").val(0);
                } else {
                    $(".harga").each(function(i, obj) {
                        var xhit = $(this).val();
                        xhit = xhit.replace(".", "");
                        //console.log(xhit);
                        awal = parseInt(xhit) + awal;
                        if (xnum == $(".harga").length) {
                            var disk = parseInt($(".diskon").val());
                            if (disk > 0) {
                                var hit = disk / 100 * awal;
                                awal = awal - hit;
                            }
                            console.log(awal);
                            /*var pajak = 10/100 * awal;
                            awal = awal+pajak;*/
                            $(".harga-total").val(awal);
                        }
                        xnum++;
                    })
                }

                var awal_berat = 0;
                var xnum = 1;
                if ($(".berat").length == 0) {
                    $(".berat-total").val(0);
                } else {
                    $(".berat").each(function(i, obj) {
                        var xhit = $(this).val();
                        xhit = xhit.replace(".", "");
                        //console.log(xhit);
                        awal_berat = parseInt(xhit) + awal_berat;
                        if (xnum == $(".berat").length) {
                            $(".berat-total").val(awal_berat);
                        }
                        xnum++;
                    })
                }

                $(".input-mask").mask('000.000.000.000.000', {
                    reverse: true
                });
            }

            function open_produk() {
                $('.produk-paket .select2').select2('open');
            }
            $(".input-mask").mask('000.000.000.000.000', {
                reverse: true
            });
            </script>