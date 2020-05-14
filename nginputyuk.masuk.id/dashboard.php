<?php
include '/home/nginputy/verifikasi.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$datablock = curl_exec($curl);
$datablock=json_decode($datablock, true);
$datablock=$datablock['data'];

curl_setopt($curl, CURLOPT_URL, 'http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$verifikasi = curl_exec($curl);
$verifikasi=json_decode($verifikasi, true);
$verifikasi=$verifikasi['data'];
$jml=count($verifikasi)-1;
$saldo=$verifikasi[$jml]['saldo'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nginput Yuk | Dashboard</title>
    <link rel="icon" href="assets/calculators.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body >
    <header>
        <nav class="navbar navbar-dark bg-dark ">
        <div class="container col-md-1 text-center">
            <a class="navbar-brand" href="index.php">
                <img src="assets/calculators.png" width="30" height="30" class="d-inline-block align-top" alt=""><br>
                Nginput Yuk
            </a>
    </header>
    <div class="container">
        <div class="row mt-2">
            <div class="col md-6 text-center">
                <div class="card">
                    <h4 class="card-header text-center">SALDO</h4>
                    <div class="card-body">
                        <h5 class="card-title text-center">RP <?php echo number_format($saldo,0,",","."); ?></h5>
                        <p class="card-text text-center">Terkahir update </p>
                        <p class="card-text text-center"><?php echo $verifikasi[$jml]['waktu'];; ?></p>
                        <a href="validasi.php" class="btn btn-dark">VALIDASI</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="card text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Input Pemasukan</h5>
                        <p class="card-text">Ayo input pemasukanmu.</p>
                        <a href="pemasukan.php" class="btn btn-dark">Pemasukan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Input Pengeluaran</h5>
                        <p class="card-text">Ayo input Pengeluaran.</p>
                        <a href="pengeluaran.php" class="btn btn-dark">Pengeluaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <h3 class="text-center">DATA TRANSAKSI</h3>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">TANGGAL</th>
                        <th class="text-center" scope="col">URAIAN</th>
                        <th class="text-center" scope="col">TIPE</th>
                        <th class="text-center" scope="col">NOMINAL</th>
                        <th class="text-center" scope="col">SALDO AKHIR</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach($datablock as $i) { ?>
                        <tr>
                            <td class="text-center"><?= $i['tanggal'] ?></td>
                            <td class="text-center"><?= $i['uraian'] ?></td>
                            <td class="text-center"><?= $i['tipe'] ?></td>
                            <td class="text-center">Rp <?= number_format($i['nominal'],0,",","."); ?></td>
                            <td class="text-center">Rp <?= number_format($i['saldo'],0,",","."); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            

        </div>
    </div>

</body>
</html>