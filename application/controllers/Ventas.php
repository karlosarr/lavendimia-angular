<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ventas
 *
 * @author karlo
 */
class Ventas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ventas_model');
        $this->load->model('clientes_model');
        $this->load->model('articulos_model');
        $this->load->model('configuracion_model');
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->library('form_validation');
    }
    /**
     * Create view
     */
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('ventas');
        $this->load->view('template/footer');
    }
    /**
     *
     */
    public function detalles()
    {
        $get = $this->input->get();
        $venta = $get['venta'];
        $data = array(
            'idventa' => $venta,
        );
        $this->load->view('template/header');
        $this->load->view('ventas_detalles', $data);
        $this->load->view('template/footer');
    }
    /**
     * Show details
     */
    public function showDetalles()
    {
        $idventa = $this->input->get('venta');
        $ventas = $this->ventas_model->getDetallesVenta($idventa);
        $ventasJson = array();
        foreach ($ventas as $key => $value) {
            $ventasJson[$key] = array(
                'idventa' => $value->idventa,
                'modelo' => $value->modelo,
                'fecha_registro' => $value->fecha_registro,
                'nombre' => $value->nombre,
                'cantidad' => $value->cantidad,
                'importe' => $value->importe,
            );
        }
        echo json_encode($ventasJson);
    }
    /**
     * Show sales
     */
    public function show()
    {
        $ventas = $this->ventas_model->getVentas();
        $ventasJson = array();
        foreach ($ventas as $key => $value) {
            $idarticulos = sprintf('%04d', $value->idventa);
            $idclientes = sprintf('%04d', $value->idclientes);
            $nombre = "$value->nombre $value->apellido_parterno $value->apellido_materno";
            $ventasJson[$key] = array(
                'idventa' => $idarticulos,
                'idclientes' => $idclientes,
                'nombre' => $nombre,
                'total' => $value->total,
                'fecha_registro' => $value->fecha_registro,
                'status' => $value->status,
            );
        }
        header('Content-Type: application/json');
        echo json_encode($ventasJson);
    }
    /**
     * show sale
     */
    public function agregar()
    {
        $ultimoRegistro = $this->ventas_model->ultimoRegistro();
        $idventa = sprintf('%04d', $ultimoRegistro->idventa + 1);
        $data["codigo"] = $idventa;
        $data["configuracion"] = $this->cargarConfiguraciones();
        $this->load->view('template/header');
        $this->load->view('ventas_agregar', $data);
        $this->load->view('template/footer');
    }
    /**
     * get the next id
     */
    public function id()
    {
        $ultimoRegistro = $this->ventas_model->ultimoRegistro();
        $id = $ultimoRegistro ? $ultimoRegistro->idventa + 1 : 1;
        $idventa = sprintf('%04d', $id);
        $json = [
            'id' => $idventa
        ];
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    /**
     * get a configurations
     */
    public function cargarConfiguraciones()
    {
        return $this->configuracion_model->getConfiguracion();
    }
    /**
     *
     */
    public function add()
    {
        $json = $this->input->raw_input_stream;
        $json = json_decode($json);
        $venta = $json->venta;
        $detallesventa = $json->detallesventa;

        $this->ventas_model->guardarVenta($venta);
        $ultimoRegistro = $this->ventas_model->ultimoRegistro();
        if(!$ultimoRegistro) {
            $json = [
                'error' => 1,
                'mensaje' => '',
                'data' => 1,
            ];
            echo json_encode($json);
            return ;
        }
        $idVenta = $ultimoRegistro->idventa;

        $this->ventas_model->guardarDetalleVenta($idVenta, $detallesventa);
        $json = [
            'error' => 0,
            'mensaje' => '',
            'data' => $ultimoRegistro,
        ];
        echo json_encode($json);
    }
}
