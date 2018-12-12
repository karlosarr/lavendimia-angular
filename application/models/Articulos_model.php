<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Articulos_model
 *
 * @author karlo
 */
class Articulos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getArticulos()
    {
        $consulta = $this->db->select([
            'idarticulos',
            'descripcion',
            'modelo',
            'precio',
            'existencia',
            'fecha_registro'])
            ->from('articulos')
            ->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function getArticulo($idArticulo)
    {
        $consulta = $this->db->select([
            'idarticulos',
            'descripcion',
            'modelo',
            'precio',
            'existencia',
            'fecha_registro'])
            ->from('articulos')
            ->where('idarticulos', $idArticulo)
            ->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function setArticulo($articulo)
    {
        $this->db->insert('articulos', $articulo);
    }

    public function ultimoRegistro()
    {
        $this->db->select_max('idarticulos');
        $this->db->from('articulos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function update($articulo)
    {
        $acticuloEditar = [
            'descripcion' => $articulo['descripcion'],
            'modelo' => $articulo['modelo'],
            'precio' => $articulo['precio'],
            'existencia' => $articulo['existencia'],
        ];
        $this->db->where('idconfiguraciones', $articulo['idarticulos'])
            ->update('articulos', $acticuloEditar);
    }

    public function buscar($descripcion)
    {
        $consulta = $this->db->select([
            'idarticulos',
            'descripcion',
            'modelo',
            'precio',
            'existencia'])
            ->from('articulos')
            ->or_like('descripcion', $descripcion)
            ->or_like('modelo', $descripcion)
            ->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function editarExistencia($articulo)
    {
        $acticuloEditar = [
            'existencia' => $articulo['existencia'],
        ];
        $this->db->where([
            'idconfiguraciones' => $articulo['idarticulos']
            ])
            ->update('articulos', $acticuloEditar);
    }

}
