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
