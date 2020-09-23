<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

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

 class Data_all_c extends REST_Controller
 {
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('data_all_m');
    }

    public function desa_get(){
        $id = $this->get('id_desa');
        if ($id == null) {
            $data = $this->data_all_m->get_desa()->result_array();
        } else {
            $data = $this->data_all_m->get_desa($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data Desa Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function upt_get(){
        $id = $this->get('id_upt');
        if ($id == null) {
            $data = $this->data_all_m->get_upt()->result_array();
        } else {
            $data = $this->data_all_m->get_upt($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data upt Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function opd_get(){
        $id = $this->get('id_opd');
        if ($id == null) {
            $data = $this->data_all_m->get_opd()->result_array();
        } else {
            $data = $this->data_all_m->get_opd($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data opd Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 }
 