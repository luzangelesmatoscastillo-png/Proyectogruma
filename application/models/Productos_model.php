<?php
class Productos_model extends CI_Model{

    public function autocomplete($q){

        $this->db->select('id, nombre');

        $this->db->like('nombre', $q);

        $this->db->where('activo', 1);

        $this->db->limit(6);

        $query = $this->db->get('cat_productos');

        return $query->result();
    }

    public function obtener_productos(){

        $this->db->select('
            cat_productos.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('cat_productos');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = cat_productos.id_imagen'
        );

        $this->db->where('cat_productos.activo',1);

        $query = $this->db->get();

        return $query->result();
    }

    public function obtener_producto($id){

        $this->db->select('
            cat_productos.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('cat_productos');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = cat_productos.id_imagen'
        );

        $this->db->where('cat_productos.id',$id);

        $query = $this->db->get();

        return $query->row();
    }

    public function obtener_marcas(){

        $query = $this->db->get('marcas');

        return $query->result();
    }

    public function obtener_productos_marca($id_marca){

        $this->db->select('
            cat_productos.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('cat_productos');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = cat_productos.id_imagen'
        );

        $this->db->where('cat_productos.id_marca',$id_marca);

        $this->db->where('cat_productos.activo',1);

        $query = $this->db->get();

        return $query->result();
    }

    public function buscar($q){

        $this->db->select('
            cat_productos.*,
            cat_imagenes.url,
            cat_imagenes.nombre_archivo
        ');

        $this->db->from('cat_productos');

        $this->db->join(
            'cat_imagenes',
            'cat_imagenes.id = cat_productos.id_imagen'
        );

        $this->db->group_start();

            $this->db->like('cat_productos.nombre', $q);

            $this->db->or_like('cat_productos.descripcion', $q);

        $this->db->group_end();

        $this->db->where('cat_productos.activo', 1);

        $query = $this->db->get();

        return $query->result();
    }

}