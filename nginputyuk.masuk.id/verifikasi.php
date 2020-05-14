<?php
$start_time = microtime(true); 
require 'vendor/autoload.php';

use GuzzleHttp\Client;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$node1 = curl_exec($curl);
$node1=json_decode($node1, true);
$node1=$node1['data'];

curl_setopt($curl, CURLOPT_URL, 'http://node2bc.nginputyuk.masuk.id/index.php/api/example/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$node2 = curl_exec($curl);
$node2=json_decode($node2, true);
$node2=$node2['data'];

curl_setopt($curl, CURLOPT_URL, 'http://node3bc.nginputyuk.masuk.id/index.php/api/example/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$node3 = curl_exec($curl);
$node3=json_decode($node3, true);
$node3=$node3['data'];

function cekHash($jmlData,$node)
{
    $i = 1;
    while ($i<=($jmlData-1))
    {
        if($i<($jmlData-1))
        {
            $tmp=$node[$i];
            $data ="{$tmp['id']}{$tmp['tanggal']}{$tmp['uraian']}{$tmp['tipe']}{$tmp['nominal']}{$tmp['saldo']}{$tmp['prevhash']}{$tmp['nonce']}";
            $tmpHash=md5($data);
            $tmpNext =  $node[($i+1)]['prevhash'];
            if($tmpHash==$tmpNext)
            {
                
            }
            else
            {
                return FALSE;
                break;
            }
        }
        if ($i==($jmlData-1))
        {
            $tmp=$node[$i-1];
            $data ="{$tmp['id']}{$tmp['tanggal']}{$tmp['uraian']}{$tmp['tipe']}{$tmp['nominal']}{$tmp['saldo']}{$tmp['prevhash']}{$tmp['nonce']}";
            $tmpHash=md5($data);
            $tmp=$node[$i];
            $data ="{$tmp['id']}{$tmp['tanggal']}{$tmp['uraian']}{$tmp['tipe']}{$tmp['nominal']}{$tmp['saldo']}{$tmp['prevhash']}{$tmp['nonce']}";
            $tmpHash1=md5($data);
            $tmpPrev = $node[($i-1)]['currhash'];
            $tmpCurr = $node[($i)]['prevhash'];
            if(($tmpPrev!=$tmpCurr)|($tmpHash!=$tmpPrev)|($tmpHash1!=$node[$i]['currhash']))
            {
                return FALSE;
                break;
            }
            else
            {
    
            }
        }
        $i++;
    }
    return TRUE;
}

function restoreBlock($data,$url)
{
    $blok = [
        'id' => $data['id'],
        'tanggal' => $data['tanggal'],
        'uraian' => $data['uraian'],
        'tipe' => $data['tipe'],
        'nominal' => $data['nominal'],
        'saldo'=>$data['saldo'],
        'prevhash'=>$data['prevhash'],
        'currhash'=>$data['currhash'],
        'nonce'=>$data['nonce']
    ];
    $client =new Client();
    $response = $client->request('POST', $url,[
        'form_params'=> $blok
    ]);
}

function insertVerifikasi($url,$jmlBlock,$statusblockchain,$saldoAkhir)
{
    $verifikasi=[
        'saldo'=> $saldoAkhir,
        'jmlblock'=> $jmlBlock,
        'status'=> $statusblockchain
    ];
    $client =new Client();
    $response = $client->request('POST', $url,[
        'form_params'=> $verifikasi
    ]);
}

$jmlData1 = count($node1);
$jmlData2 = count($node2);
$jmlData3 = count($node3);

$stat1= cekHash($jmlData1,$node1);
$stat2= cekHash($jmlData2,$node2);
$stat3= cekHash($jmlData3,$node3);

$statSama1=$node1===$node2;
$statSama2=$node1===$node3;
$statSama3=$node2===$node3;



if((($stat1==FALSE)||($statSama1==0)||($statSama2==0))&&(($stat2==TRUE)&&($stat3==TRUE)&&($statSama3==1)))
{
    $statusblockchain = "Node 1 Tidak Valid";
    //truncate node 1 ganti isinya dengan isi node 2
    $client =new Client();
    $response = $client->request('DELETE', 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://node2bc.nginputyuk.masuk.id/index.php/api/example/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    $data=json_decode($data, true);
    $data=$data['data'];
    
    //menganti isi node 1 dengan node 2
    $url = "http://node1bc.nginputyuk.masuk.id/index.php/api/example/create";
    $i=0;
    $jml=count($data);
    while ($i<$jml)
    {
        $tmp=$data[$i];
        restoreBlock($tmp,$url);
        $i++;
    }

    $jmlBlock = count($node2);
    $saldoAkhir = $node2[$jmlBlock-1]['saldo'];
    $url = "http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi";
    insertVerifikasi($url,$jmlBlock,$statusblockchain,$saldoAkhir);
}
elseif ((($stat2==FALSE)||($statSama1==0)||($statSama3==0))&&(($stat1==TRUE)&&($stat3==TRUE)&&($statSama2==1)))
{
    $statusblockchain = "Node 2 Tidak Valid";
    //truncate node 2 ganti isinya dengan isi node 3
    $client =new Client();
    $response = $client->request('DELETE', 'http://node2bc.nginputyuk.masuk.id/index.php/api/example/');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://node3bc.nginputyuk.masuk.id/index.php/api/example/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    $data=json_decode($data, true);
    $data=$data['data'];
    
    //menganti isi node 2 dengan node 3
    $url = "http://node2bc.nginputyuk.masuk.id/index.php/api/example/create";
    $i=0;
    $jml=count($data);
    while ($i<$jml)
    {
        $tmp=$data[$i];
        restoreBlock($tmp,$url);
        $i++;
    }

    $jmlBlock = count($node3);
    $saldoAkhir = $node3[$jmlBlock-1]['saldo'];
    $url = "http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi";
    insertVerifikasi($url,$jmlBlock,$statusblockchain,$saldoAkhir);
}
elseif ((($stat3==FALSE)||($statSama2==0)||($statSama3==0))&&(($stat1==TRUE)&&($stat2==TRUE)&&($statSama1==1)))
{
    $statusblockchain = "Node 3 Tidak Valid";
    //truncate node 3 ganti isinya dengan isi node 1
    $client =new Client();
    $response = $client->request('DELETE', 'http://node3bc.nginputyuk.masuk.id/index.php/api/example/');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://node1bc.nginputyuk.masuk.id/index.php/api/example/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    $data=json_decode($data, true);
    $data=$data['data'];
    
    //menganti isi node 3 dengan node 1
    $url = "http://node3bc.nginputyuk.masuk.id/index.php/api/example/create";
    $i=0;
    $jml=count($data);
    while ($i<$jml)
    {
        $tmp=$data[$i];
        restoreBlock($tmp,$url);
        $i++;
    }

    $jmlBlock = count($node1);
    $saldoAkhir = $node1[$jmlBlock-1]['saldo'];
    $url = "http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi";
    insertVerifikasi($url,$jmlBlock,$statusblockchain,$saldoAkhir);
}


$jmlBlock = count($node1);
$statusblockchain = "Aman";
$saldoAkhir = $node1[$jmlBlock-1]['saldo'];
$url = "http://datapool.nginputyuk.masuk.id/index.php/api/example/verifikasi";
insertVerifikasi($url,$jmlBlock,$statusblockchain,$saldoAkhir);

