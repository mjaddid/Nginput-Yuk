<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$verifikasi = curl_exec($curl);
$verifikasi=json_decode($verifikasi, true);
$verifikasi=$verifikasi['data'];
$jml=count($verifikasi)-1;
$status=$verifikasi[$jml]['status'];
$waktu=$verifikasi[$jml]['waktu'];
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nginput Yuk | Validasi</title>
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
    </header><br>
        
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="dashboard.php" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col md-6 text-center">
                <div class="card">
                    <h4 class="card-header text-center">STATUS</h4>
                    <div class="card-body">
                        
                        <?php if($status=="Aman"): ?>
                            <h5 class="card-title text-center text-success"><?= $status;?></h5>
                        <?php else: ?>
                                <h5 class="card-title text-center text-danger"><?= $status;?></h5>
                        <?php endif ?>
                        <p class="card-text text-center"><?= $waktu?></p>
                        <button onclick="<?php include '/home/nginputy/verifikasi.php' ?>history.go(0)" class="btn btn-dark">CEK</button>
                        
                    </div>
                </div>
            </div>
        </div>
       
    </div>
        
    <div class="row">
        <div class="container">
            <h3 class="text-center">DATA VALIDASI</h3>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">TIMESTAMP</th>
                        <th class="text-center" scope="col">SALDO</th>
                        <th class="text-center" scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                        $i = $jml;
                        while($i>=0) { 
                    ?>
                        <tr>
                            <td class="text-center"><?= $verifikasi[$i]['waktu'] ?></td>
                            <td class="text-center">Rp <?= number_format($verifikasi[$i]['saldo'],0,",","."); ?></td>
                            <td class="text-center"><?= $verifikasi[$i]['status'] ?></td>
                        </tr>
                    <?php $i--;} ?>
                </tbody>
            </table>
            

        </div>
    </div>

</body>
</html>