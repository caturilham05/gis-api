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
class Pengaduan_c extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('pengaduan_m');
    }

    // GET DATA

    // GET Pengaduan Status
    public function pengaduanAll_get()
    {
        $id = $this->get('id_pengaduan');
        if ($id == null) {
            $data = $this->pengaduan_m->get()->result_array();
        } else {
            $data = $this->pengaduan_m->get($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data Pengaduan Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function status_get()
    {
        $id = $this->get('id_pengaduan');
        if ($id == null) {
            $data = $this->pengaduan_m->get_status()->result_array();
        } else {
            $data = $this->pengaduan_m->get_status($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data Pengaduan Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function statusSelesai_get()
    {
        $id = $this->get('id_pengaduan');
        if ($id == null) {
            $data = $this->pengaduan_m->get_status_selesai()->result_array();
        } else {
            $data = $this->pengaduan_m->get_status_selesai($id)->result_array();
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Data Pengaduan Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // END GET DATA

    // POST DATA

    public function addPengaduan_post()
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = 5120;
        $config['file_name']      = 'pengaduan-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, true);

            if (@$_FILES['gambar']['name'] != null) {
                if ($this->upload->do_upload('gambar')) {
                    $post['gambar'] = $this->upload->data('file_name');
                    $this->pengaduan_m->addPengaduan($post);

                    if ($this->db->affected_rows() == 1) {
                        $this->response([
                            'status' => true,
                            'pesan' => 'Pengaduan Berhasil Disimpan'
                        ],  REST_Controller::HTTP_OK);
                    }else{
                        $this->response([
                            'status' => false,
                            'error' => 'Pengaduan Gagal Disimpan'
                        ], 502);
                    }
                } else {
                    $err = $this->upload->display_errors();
                    $this->response([
                        'status' => false,
                        'error' => $err
                    ], 502);
                }
            } else {
                $post['gambar'] = null;
                $this->pengaduan_m->addPengaduan($post);
                if ($this->db->affected_rows() > 0) {
                    $this->response([
                        'status' => true,
                        'pesan' => 'Pengaduan Berhasil Disimpan'
                    ],  REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'error' => 'Pengaduan Gagal Disimpan'
                    ], 502);
                }
            }
        }

    // END POST DATA
}
