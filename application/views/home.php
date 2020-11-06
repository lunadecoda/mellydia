<section class="content">
                <header class="content__title">
                    <h1>Dashboard</h1>
                    <small>Selamat Datang</small>
                </header>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Statistik Penjualan Anda Bulan Ini</h4>
                                <canvas id="line-chart"></canvas>
                            </div>
                        </div>
                    </div>
					
					<div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Stok Barang kurang dari <?php foreach($stok as $k) { echo $k->batas; }?></h4>
								<?php if($habis != NULL) { ?>
								<table class="table table-sm table-striped">
								<thead>
								<tr>
									<td>Produk</td>
									<td>Stok</td>
								</tr>
								</thead>
								<?php foreach ($habis as $k) { ?>
								<tbody>
								<tr>
									<td><?php echo $k->nama_produk;?></td>
									<td><?php echo $k->stok;?></td>
								</tr>
								<?php } ?>
								</tbody>
								</table>
								<?php } else { echo '-'; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer hidden-xs-down">
                    <p>© Mellydia's Team <?php echo date("Y");?>.</p>
                </footer>
            </section>
	<script>
	$(document).ready(function () {
	setTimeout(function() {
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
