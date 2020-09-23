<?php

class Data_all_m extends CI_Model
{

    // GET API
    public function get_desa($id = null)
    {
        if ($id == null) {
            return $this->db->get('desa');
        } else {
            return $this->db->get_where('desa', ['id_desa' => $id]);
        }
    }
    public function get_upt($id = null)
    {
        if ($id == null) {
            return $this->db->get('upt');
        } else {
            return $this->db->get_where('upt', ['id_upt' => $id]);
        }
    }
    public function get_opd($id = null)
    {
        if ($id == null) {
            return $this->db->get('opd');
        } else {
            return $this->db->get_where('opd', ['id_opd' => $id]);
        }
    }

    
    // END GET API
}
