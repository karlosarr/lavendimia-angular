<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ventas_model
 *
 * @author karlo
 */
class Ventas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas()
    {
        $consulta = $this->db->select(['venta.idventa',
            'venta.status',
            'venta.fecha_registro',
            'venta.total',
            'clientes.idclientes',
            'clientes.nombre',
            'clientes.apellido_parterno',
            'clientes.apellido_materno'])
            ->from('venta')
            ->join('clientes', 'clientes.idclientes = venta.clientes_idclientes')
            ->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    /**
     * Get the last sale
     */
    public function ultimoRegistro()
    {
        return $this->db->select_max('idventa')
        ->from('venta')
        ->get()
        ->row();
    }

    public function guardarVenta($venta)
    {
        return $this->db->insert('venta', $venta);
    }

    public function guardarDetalleVenta($idventa, $detalle)
    {
        $detalleVenta = [];
        foreach ($detalle as $key => $value) {
            $detalleVenta = [
                'venta_idventa' => $idventa,
                'articulos_idarticulos' => $value->id,
                'cantidad' => $value->cantidad,
                'importe' => $value->importe,
            ];
            $this->db->insert('detalles_venta', $detalleVenta);
        }

    }

    public function getDetallesVenta($idventa)
    {
        $consulta = $this->db->select([
            'venta.idventa',
            'articulos.modelo',
            'venta.fecha_registro',
            'CONCAT_WS(\' \',clientes.nombre, clientes.apellido_parterno, clientes.apellido_materno) AS nombre',
            'detalles_venta.cantidad',
            'detalles_venta.importe'])
            ->from('detalles_venta')
            ->join('venta', 'detalles_venta.venta_idventa = venta.idventa')
            ->join('articulos', 'articulos.idarticulos = detalles_venta.articulos_idarticulos')
            ->join('clientes', 'clientes.idclientes = venta.clientes_idclientes')
            ->where('detalles_venta.venta_idventa', $idventa)
            ->get();
        $resultado = $consulta->result();
        return $resultado;
    }

}
