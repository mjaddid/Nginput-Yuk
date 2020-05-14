<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client =new Client();
if( isset($_POST["tambah"]) )
{
    $data = [
        "tanggal" => htmlspecialchars($_POST["tanggal"]),
        "uraian" => htmlspecialchars($_POST["uraian"]),
        "nominal" => htmlspecialchars($_POST["nominal"]),
        "tipe" => "K",
        "status" => "Menunggu"
    ];

    $response = $client->request('POST', 'http://datapool.nginputyuk.masuk.id/index.php/api/example/',[
        'form_params'=> $data
    ]);
    $status= $response->getStatusCode();
    if($status==201)
    {
        echo"
        <script>
            alert('Data Berhasil Ditambahkan ke Datapool')
        </script>";
    }
    else
    {
        echo"
        <script>
            alert('Data Gagal Ditambahkan ke Datapool')
        </script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nginput Yuk | Pengeluaran</title>
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
            <div class="col-md-8 text-center">
                <div class="h3 r">INPUT PENGELUARAN</div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4"> </div>
            <div class="col-md-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group" >
                        <label>Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Uraian</label>
                        <input type="text" class="form-control" id="uraian" name="uraian" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" required>
                    </div>
                    <div class="text-center">

                        <button type="submit" class="btn btn-dark" name="tambah">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

</body>
</html>