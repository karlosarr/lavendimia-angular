<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuracion_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getConfiguracion()
    {
        return $this->db->select([
            'idconfiguraciones',
            'tasa_financiamiento',
            'enganche',
            'plazo_maximo',
            'fecha_actualizacion'])
            ->get('configuraciones')
            ->row();
    }

    public function setConfiguracion($configuracion)
    {
        $configuracionActual = $this->getConfiguracion();
        if (empty($configuracionActual)) {
            $this->db->insert('configuraciones', $configuracion);
        } else {
            $configuracion['fecha_actualizacion'] = 'CURRENT_TIMESTAMP';
            $this->db->where('idconfiguraciones', $configuracionActual->idconfiguraciones);
            $this->db->update('configuraciones', $configuracion);
        }
    }

}
