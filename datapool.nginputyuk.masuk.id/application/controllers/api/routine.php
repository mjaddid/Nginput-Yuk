<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class routine extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('datapool_model');
    }

    public function getPending()
    {
        $data =$this->datapool_model->getPending();
    }

    public function mining()
    {
        $id = $this->get('id');
        $data =$this->datapool_model->getData($id);
        $data=$data['data'];
        $nonce=0;
        $datalengkap = $data['tanggal']+$data['uraian']+$data['tipe']+$data['nominal']+$nonce;
        $tmpHash = md5($datalengkap);
        
        while(substr($tmpHash,0,3)!="111")
        {
            $nonce=$nonce+1;
            $datalengkap = $data['tanggal']+$data['uraian']+$data['tipe']+$data['nominal']+$nonce;
            $tmpHash = md5($datalengkap);
        }
    }

}