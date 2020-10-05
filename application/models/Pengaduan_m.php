<?php

class Pengaduan_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('detail_pengaduan.*,
        upt.nama_upt as join_nama_upt,
        upt.latitude as join_latitude_upt,
        upt.longitude as join_longitude_upt,
        desa.desa as join_nama_desa,
        desa.latitude as join_latitude_desa,
        desa.longitude as join_longitude_desa,
        opd.nama_opd as join_nama_opd,
        opd.latitude as join_latitude_opd,
        opd.longitude as join_longitude_opd,
        ');
        $this->db->from('detail_pengaduan');
        $this->db->join('upt', 'upt.id_upt = detail_pengaduan.id_upt');
        $this->db->join('desa', 'desa.id_desa = detail_pengaduan.id_desa');
        $this->db->join('opd', 'opd.id_opd = detail_pengaduan.id_opd');
        if ($id != null) {
            $this->db->where('id_pengaduan', $id);
        }
        $this->db->order_by('id_pengaduan', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function get_status($id = null)
    {
        $this->db->select('detail_pengaduan.*,
        upt.nama_upt as join_nama_upt,
        upt.latitude as join_latitude_upt,
        upt.longitude as join_longitude_upt,
        desa.desa as join_nama_desa,
        desa.latitude as join_latitude_desa,
        desa.longitude as join_longitude_desa,
        opd.nama_opd as join_nama_opd,
        opd.latitude as join_latitude_opd,
        opd.longitude as join_longitude_opd,
        ');
        $this->db->from('detail_pengaduan');
        $this->db->join('upt', 'upt.id_upt = detail_pengaduan.id_upt');
        $this->db->join('desa', 'desa.id_desa = detail_pengaduan.id_desa');
        $this->db->join('opd', 'opd.id_opd = detail_pengaduan.id_opd');
        $this->db->where('status = "belum diatasi"');
        if ($id != null) {
            $this->db->where('id_pengaduan', $id);
        }
        $this->db->order_by('id_pengaduan', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function get_status_selesai($id = null)
    {
        $this->db->select('detail_pengaduan.*,
        upt.nama_upt as join_nama_upt,
        upt.latitude as join_latitude_upt,
        upt.longitude as join_longitude_upt,
        desa.desa as join_nama_desa,
        desa.latitude as join_latitude_desa,
        desa.longitude as join_longitude_desa,
        opd.nama_opd as join_nama_opd,
        opd.latitude as join_latitude_opd,
        opd.longitude as join_longitude_opd,
        ');
        $this->db->from('detail_pengaduan');
        $this->db->join('upt', 'upt.id_upt = detail_pengaduan.id_upt');
        $this->db->join('desa', 'desa.id_desa = detail_pengaduan.id_desa');
        $this->db->join('opd', 'opd.id_opd = detail_pengaduan.id_opd');
        $this->db->where('status = "selesai diatasi"');
        if ($id != null) {
            $this->db->where('id_pengaduan', $id);
        }
        $this->db->order_by('id_pengaduan', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function addPengaduan($post)
    {
        $params = [
            'user_id' => $post['user_id'],
            'id_desa' => $post['id_desa'],
            'id_upt' => $post['id_upt'],
            'id_opd' => $post['id_opd'],
            'nama_pelapor' => $post['nama_pelapor'],
            'tgl_aduan' => $post['tgl_aduan'],
            'isi_aduan' => $post['isi_aduan'],
            'gambar' => $post['gambar'],
        ];

        $this->db->insert('detail_pengaduan', $params);
    }

    public function pengaduan_edit($data, $id)
    {
        $this->db->update('detail_pengaduan', $data, ['id_pengaduan' => $id]);
        return $this->db->affected_rows();
    }

    public function pengaduan_delete($id)
    {
        $this->db->delete('detail_pengaduan', ['id_pengaduan' => $id]);
        return $this->db->affected_rows();
    }
}
