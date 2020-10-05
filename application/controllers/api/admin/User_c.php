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

class User_c extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('user_m');
    }

    
    public function cek_login_post()
    {
        $post = $this->input->post(null, true);
        $query = $this->user_m->login($post);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $params = array(
                'userid' => $row->user_id,
                'level' => $row->level
            );
            $this->session->set_userdata($params);
            $this->response([
                'status' => true,
                'pesan' => 'Login Berhasil'
            ],  REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Login Gagal! Username atau Password yang Anda Masukkan Salah'
            ], 502);
        }
    }

    public function auth_login_user_post()
    {
        $post = $this->input->post(null, true);
        $query = $this->user_m->cek_login($post);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $params = array(
                'userid' => $row->user_id,
                'level' => $row->level
            );
            $this->session->set_userdata($params);
            $this->response([
                'status' => true,
                'pesan' => 'Login Berhasil'
            ],  REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Login Gagal! Username atau Password yang Anda Masukkan Salah'
            ], 502);
        }
    }
    
    
    
    // GET DATA
    public function get_user_get()
    {
        $id = $this->get('user_id');
        if ($id == null) {
            $data = $this->user_m->get()->result_array();
        } else {
            $data = $this->user_m->get($id)->result_array();
        }
        
        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // END GET DATA

    // POST DATA

    public function add_user_post()
    {
        $post = $this->input->post(null, TRUE);
        $this->user_m->user_post($post);

        if ($this->db->affected_rows() > 0) {
            $this->response([
                'status' => true,
                'pesan' => 'Registrasi Berhasil'
            ],  REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'Registrasi Gagal'
            ], 502);
        }
    }

    // END POST DATA

    // EDIT DATA

    public function edit_user_put()
    {
        $id = $this->put('user_id');

        $data = [
            'username' => $this->put('username'),
            'password' => sha1($this->put('password')),
            'no_telp' => $this->put('no_telp'),
            'id_desa' => $this->put('id_desa'),
            'id_upt' => $this->put('id_upt'),
            'id_opd' => $this->put('id_opd'),

        ];

        if ($this->user_m->user_edit($data, $id) > 0) {
            $this->response([
                'status' => true,
                'pesan' => 'User Berhasil Di Update'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'error' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // END EDIT DATA


    // DELETE DATA

    public function hapus_user_delete()
    {
        $id = $this->delete('user_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'pesan' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            if ($this->user_m->user_delete($id) > 0) {
                $this->response([
                    'status' => true,
                    'user_id' => $id,
                    'pesan' => 'User Berhasil Dihapus',
                    // 'pesan' => 'User "'.$id.'" Berhasil Dihapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'error' => 'User Tidak Ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // END DELETE DATA
}
