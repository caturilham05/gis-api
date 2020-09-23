<?php
class User_m extends CI_Model
{

    // API GET MODEL
    public function get($id = null)
    {
        $this->db->select('user.*,
                            upt.nama_upt as join_nama_upt,
                            desa.desa as join_nama_desa,
                            opd.nama_opd as join_nama_opd,
        ');
        $this->db->from('user');
        $this->db->join('upt', 'upt.id_upt = user.id_upt');
        $this->db->join('desa', 'desa.id_desa = user.id_desa');
        $this->db->join('opd', 'opd.id_opd = user.id_opd');

        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    //END API GET MODEL

    // API POST MODEL

    public function user_post($post)
    {
        $params = [
            'id_desa' => $post['join_desa'],
            'id_upt' => $post['join_upt'],
            'id_opd' => $post['join_opd'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'no_telp' => $post['no_telp'],
        ];

        $this->db->insert('user', $params);
    }

    // END API POST MODEL

    // EDIT API MODEL
    public function user_edit($data, $id)
    {
        $this->db->update('user', $data, ['user_id' => $id]);
        return $this->db->affected_rows();
    }
    // END EDIT API MODEL

    // DELETE API MODEL

    public function user_delete($id)
    {
        $this->db->delete('user', ['user_id' => $id]);
        return $this->db->affected_rows();
    }

    // END DELETE API MODEL
}
