<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://datapool.nginputyuk.masuk.id/index.php/api/example/pending');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$tmp = curl_exec($curl);
$tmp=json_decode($tmp, true);
$stat= $tmp['status'];

if ($stat==TRUE)
{
    include 'verifikasi.php';
    $tmp=$tmp['data']; 
    curl_setopt($curl, CURLOPT_URL, 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/last');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $last = curl_exec($curl);
    $last=json_decode($last, true);
    $last=$last['data'];
    
    $id = $tmp[0]['id'];
    $tanggal = $tmp[0]['tanggal'];
    $uraian = $tmp[0]['uraian'];
    $tipe = $tmp[0]['tipe'];
    $nominal = $tmp[0]['nominal'];
    $saldo = $last['saldo'];
    if($tipe=="D")
        {
            $saldo=$saldo+$nominal;
        }
    else
        {
            $saldo=$saldo-$nominal;
        }
    $prevhash = $last['currhash'];
    $nonce=0;
    
    $data ="{$id}{$tanggal}{$uraian}{$tipe}{$nominal}{$saldo}{$prevhash}{$nonce}";
    
    $tmpHash = md5($data);
    while(substr($tmpHash,0,4)!="9999")
        {
            $nonce=$nonce+1;
            $data = "{$id}{$tanggal}{$uraian}{$tipe}{$nominal}{$saldo}{$prevhash}{$nonce}";
            $tmpHash = md5($data);
        }
    
    $hasil = [
        'id' => $id,
        'tanggal' => $tanggal,
        'uraian' => $uraian,
        'tipe' => $tipe,
        'nominal' => $nominal,
        'saldo'=>$saldo,
        'prevhash'=>$prevhash,
        'currhash'=>$tmpHash,
        'nonce'=>$nonce
    ];
    
    
    $client =new Client();
    $response = $client->request('POST', 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/create',[
        'form_params'=> $hasil
    ]);

    $client =new Client();
    $response = $client->request('POST', 'http://node2bc.nginputyuk.masuk.id/index.php/api/example/create',[
        'form_params'=> $hasil
    ]);

    $client =new Client();
    $response = $client->request('POST', 'http://node3bc.nginputyuk.masuk.id/index.php/api/example/create',[
        'form_params'=> $hasil
    ]);
    
    $status="Sukses";
    
    $hasil = [
        'id' => $id,
        'tanggal'=> $tanggal,
        'uraian'=> $uraian,
        'tipe'=> $tipe,
        'nominal'=> $nominal,
        'status'=> $status
    ];
    
    $response = $client->request('PUT', 'http://datapool.nginputyuk.masuk.id/index.php/api/example/',[
        'form_params'=> $hasil
    ]);
}

