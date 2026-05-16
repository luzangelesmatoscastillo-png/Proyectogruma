<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Productos_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /* =========================
       PRODUCTOS
    ========================= */
    public function index(){
        $marcas = $this->Productos_model->obtener_marcas();
        foreach($marcas as $m){
            $m->productos = $this->Productos_model->obtener_productos_marca($m->id);
        }
        $data['marcas'] = $marcas;

        $this->load->view('secciones/header');
        $this->load->view('productos/productos',$data);
        $this->load->view('secciones/footer');
    }

    /* =========================
       CARRITO (Optimizado para calcular totales)
    ========================= */
    public function carrito(){
        // Capturamos lo que hay en el carrito actual de la sesión
        $carrito = $this->session->userdata('carrito');
        if(!$carrito) {
            $carrito = [];
        }

        // Inicializamos las variables para el resumen de compra
        $subtotal = 0;
        
        // Recorremos el carrito para calcular los subtotales individuales y el total general
        foreach ($carrito as $id => $item) {
            $carrito[$id]['subtotal_producto'] = $item['precio'] * $item['cantidad'];
            $subtotal += $carrito[$id]['subtotal_producto'];
        }

        // Preparamos el paquete de datos para la vista
        $data['productos_carrito'] = $carrito;
        $data['subtotal_general'] = $subtotal;
        $data['envio'] = 0; // Puedes cambiarlo si vas a cobrar envío
        $data['impuesto'] = 0; // Puedes cambiarlo si manejas IVA separado
        $data['total_general'] = $subtotal + $data['envio'] + $data['impuesto'];

        $this->load->view('secciones/header');
        // Le pasamos los datos calculados a la vista del carrito
        $this->load->view('productos/carrito', $data);
        $this->load->view('secciones/footer');
    }

    /* =========================
       AGREGAR
    ========================= */
    public function agregar_carrito(){
        $id       = $this->input->post('id');
        $nombre   = $this->input->post('nombre');
        $precio   = $this->input->post('precio');
        $cantidad = $this->input->post('cantidad');
        $imagen   = $this->input->post('imagen');

        $carrito = $this->session->userdata('carrito');
        if(!$carrito){
            $carrito = [];
        }

        if(isset($carrito[$id])){
            $carrito[$id]['cantidad'] += $cantidad;
        }else{
            $carrito[$id] = [
                'id'       => $id,
                'nombre'   => $nombre,
                'precio'   => $precio,
                'cantidad' => $cantidad,
                'imagen'   => $imagen
            ];
        }

        $this->session->set_userdata('carrito',$carrito);
        echo json_encode(['ok' => true]);
    }

    /* =========================
       ELIMINAR
    ========================= */
    public function eliminar_carrito(){
        $id = $this->input->post('id');
        $carrito = $this->session->userdata('carrito');

        if(isset($carrito[$id])){
            unset($carrito[$id]);
        }

        $this->session->set_userdata('carrito',$carrito);
        // Redirección corregida a la ruta real del carrito
        redirect(base_url('productos/carrito'));
    }

    /* =========================
       ACTUALIZAR CANTIDAD (Botones + y -)
    ========================= */
    public function actualizar_cantidad(){
        $id = $this->input->post('id');
        $accion = $this->input->post('accion');
        $carrito = $this->session->userdata('carrito');

        if(isset($carrito[$id])){
            if($accion == 'sumar'){
                $carrito[$id]['cantidad']++;
            }
            if($accion == 'restar'){
                $carrito[$id]['cantidad']--;
                if($carrito[$id]['cantidad'] <= 0){
                    unset($carrito[$id]);
                }
            }
        }

        $this->session->set_userdata('carrito',$carrito);
        // Redirección corregida a la ruta real del carrito
        redirect(base_url('productos/carrito'));
    }
}