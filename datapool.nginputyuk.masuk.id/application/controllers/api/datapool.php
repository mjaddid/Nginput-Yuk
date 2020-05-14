<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class datapool extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('datapool_model');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id == null){
            $data =$this->datapool_model->getData();
        }
        else{
            $data =$this->datapool_model->getData($id);
        }
        
        if($data)
        {
            $this->response([
                'status' =>true,
                'data' => $data
            ],REST_Controller::HTTP_OK); 
        }
        else{
            $this->response([
                'status' =>false,
                'message'=>'id not found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }

    
    public function index_post()
    {
        $data=[
            'tanggal'=> $this->post('tanggal'),
            'uraian'=> $this->post('uraian'),
            'tipe'=> $this->post('tipe'),
            'nominal'=> $this->post('nominal'),
            'status'=> $this->post('status')
        ];

        if ($this->datapool_model->createData($data)>0)
        {
            $this->response([
                'status' =>true,
                'message'=> 'data was created'
            ],REST_Controller::HTTP_CREATED);
        }
        else
        {
            $this->response([
                'status' =>false,
                'message'=>'failed created data'
            ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function pending_get()
    {
        $data =$this->datapool_model->getPending();
        if($data)
        {
            $this->response([
                'status' =>true,
                'data' => $data
            ],REST_Controller::HTTP_OK); 
        }
        else{
            $this->response([
                'status' =>false,
                'message'=>'id not found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        $id =$this->put('id');
        $data=[
            'tanggal'=> $this->put('tanggal'),
            'uraian'=> $this->put('uraian'),
            'tipe'=> $this->put('tipe'),
            'nominal'=> $this->put('nominal'),
            'status'=> $this->put('status')
        ];
        if ($this->datapool_model->updateData($data, $id)>0)
        {
            $this->response([
                'status' =>true,
                'message'=> 'Data was updated'
            ],REST_Controller::HTTP_NO_CONTENT);
        }
        else
        {
            $this->response([
                'status' =>false,
                'message'=>'failed updated data'
            ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }


}