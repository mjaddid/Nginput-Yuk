<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Example extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
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
    
    public function verifikasi_post()
    {
        $data=[
            'saldo'=> $this->post('saldo'),
            'jmlblock'=> $this->post('jmlblock'),
            'status'=> $this->post('status')
        ];

        if ($this->datapool_model->createDataVerifikasi($data)>0)
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

    public function verifikasi_get()
    {
        
        $data =$this->datapool_model->getDataVerifikasi();
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

}
