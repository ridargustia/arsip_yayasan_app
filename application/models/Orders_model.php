<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{
    public $table = 'orders';
    public $id    = 'id_order';
    public $order = 'DESC';

    function get_all()
    {
        $this->db->select('orders.id_order, orders.name, orders.is_paid, arsip.arsip_name, divisi.divisi_name, cabang.cabang_name, instansi.instansi_name, orders.created_by as created_by_orders');

        $this->db->join('instansi', 'orders.instansi_id = instansi.id_instansi', 'left');
        $this->db->join('cabang', 'orders.cabang_id = cabang.id_cabang', 'left');
        $this->db->join('divisi', 'orders.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('arsip', 'orders.arsip_id = arsip.id_arsip', 'left');

        $this->db->where('orders.is_delete', '0');

        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    function get_all_by_instansi()
    {
        $this->db->select('orders.id_order, orders.name, orders.is_paid, arsip.arsip_name, divisi.divisi_name, cabang.cabang_name, instansi.instansi_name, orders.created_by as created_by_orders');

        $this->db->join('instansi', 'orders.instansi_id = instansi.id_instansi', 'left');
        $this->db->join('cabang', 'orders.cabang_id = cabang.id_cabang', 'left');
        $this->db->join('divisi', 'orders.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('arsip', 'orders.arsip_id = arsip.id_arsip', 'left');

        $this->db->where('orders.is_delete', '0');
        $this->db->where('orders.instansi_id', $this->session->instansi_id);

        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    function get_all_by_cabang()
    {
        $this->db->select('orders.id_order, orders.name, orders.is_paid, arsip.arsip_name, divisi.divisi_name, cabang.cabang_name, instansi.instansi_name, orders.created_by as created_by_orders');

        $this->db->join('instansi', 'orders.instansi_id = instansi.id_instansi', 'left');
        $this->db->join('cabang', 'orders.cabang_id = cabang.id_cabang', 'left');
        $this->db->join('divisi', 'orders.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('arsip', 'orders.arsip_id = arsip.id_arsip', 'left');

        $this->db->where('orders.is_delete', '0');
        $this->db->where('orders.instansi_id', $this->session->instansi_id);
        $this->db->where('orders.cabang_id', $this->session->cabang_id);

        $this->db->order_by($this->id, $this->order);

        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function soft_delete($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
