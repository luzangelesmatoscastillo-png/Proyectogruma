<?php

class Filosofia_model extends CI_Model{

    public function obtener_pilares(){

        // Seleccionamos solo los campos de la tabla filosofia
        $this->db->select('filosofia.*');

        $this->db->from('filosofia');

        // Se eliminó el JOIN a cat_imagenes para evitar el error de id_imagen

        $this->db->where('filosofia.tipo','pilares');

        $this->db->where('filosofia.activo',1);

        $this->db->order_by('filosofia.orden','ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function obtener_valores(){

        // Seleccionamos solo los campos de la tabla filosofia
        $this->db->select('filosofia.*');

        $this->db->from('filosofia');

        // Se eliminó el JOIN a cat_imagenes para evitar el error de id_imagen

        $this->db->where('filosofia.tipo','valores');

        $this->db->where('filosofia.activo',1);

        $this->db->order_by('filosofia.orden','ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function buscar($q){

        // Seleccionamos solo los campos de la tabla filosofia
        $this->db->select('filosofia.*');

        $this->db->from('filosofia');

        // Se eliminó el JOIN a cat_imagenes para evitar el error de id_imagen

        $this->db->group_start();

            $this->db->like('filosofia.titulo', $q);

            $this->db->or_like('filosofia.descripcion', $q);

        $this->db->group_end();

        $query = $this->db->get();

        return $query->result();
    }

}