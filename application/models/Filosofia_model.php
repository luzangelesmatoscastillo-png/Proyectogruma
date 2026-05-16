<?php

class Filosofia_model extends CI_Model{

    public function obtener_pilares(){

        $this->db->select('
            filosofia.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('filosofia');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = filosofia.id_imagen'
        );

        $this->db->where('filosofia.tipo','pilares');

        $this->db->where('filosofia.activo',1);

        $this->db->order_by('filosofia.orden','ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function obtener_valores(){

        $this->db->select('
            filosofia.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('filosofia');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = filosofia.id_imagen'
        );

        $this->db->where('filosofia.tipo','valores');

        $this->db->where('filosofia.activo',1);

        $this->db->order_by('filosofia.orden','ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function buscar($q){

        $this->db->select('
            filosofia.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('filosofia');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = filosofia.id_imagen'
        );

        $this->db->group_start();

            $this->db->like('filosofia.titulo', $q);

            $this->db->or_like('filosofia.descripcion', $q);

        $this->db->group_end();

        $query = $this->db->get();

        return $query->result();
    }

}