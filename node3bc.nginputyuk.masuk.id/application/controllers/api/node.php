<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class node extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('node_model');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id == null){
            $data =$this->node_model->getBlock();
        }
        else{
            $data =$this->node_model->getBlock($id);
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

    public function last_get()
    {
        $data =$this->node_model->getLast();

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

    
    public function create_post()
    {
        $data=[
            'id'=> $this->post('id'),
            'tanggal'=> $this->post('tanggal'),
            'uraian'=> $this->post('uraian'),
            'tipe'=> $this->post('tipe'),
            'nominal'=> $this->post('nominal'),
            'saldo'=> $this->post('saldo'),
            'prevhash'=> $this->post('prevhash'),
            'currhash'=> $this->post('currhash'),
            'nonce'=> $this->post('nonce')
        ];

        if ($this->node_model->createBlock($data)>0)
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

    public function index_put()
    {
        $id =$this->put('id');
        $data=[
            'id'=> $this->post('id'),
            'tanggal'=> $this->post('tanggal'),
            'uraian'=> $this->post('uraian'),
            'tipe'=> $this->post('tipe'),
            'nominal'=> $this->post('nominal'),
            'saldo'=> $this->post('saldo'),
            'prevhash'=> $this->post('prevhash'),
            'currhash'=> $this->post('currhash'),
            'nonce'=> $this->post('nonce')
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

    public function index_delete()
    {
        $this->node_model->deleteTable();
    }
}