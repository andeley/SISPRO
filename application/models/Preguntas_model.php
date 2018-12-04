<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preguntas_model extends CI_Model
{

public function getAreaP($id_pregunta){
    $this->db->select('a.nombre, a.id');
        $this->db->from('area a');
        $this->db->join('pregunta p', 'a.id = p.id_area');
        $this->db->where('p.id', $id_pregunta);
        return $this->db->get()->row();
}
public function getPreguntasArea($id_area){
        $this->db->select('p.id, p.id_area, a.nombre AS area, p.estado, p.visibilidad, p.id_enunciado');
        $this->db->from('pregunta p');
        $this->db->join('area a', 'a.id=p.id_area');
        $this->db->where('p.id_area', $id_area);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }return false;
}

public function descripcionEnunciado($id_enunciado){
    $this->db->select('*'); 
    $this->db->from('enunciado');
    $this->db->where('id', $id_enunciado); 
    return $this->db->get()->row()->contenido;
}
public function getOpcionesRespuesta($id_pregunta){
    $this->db->select('*');  
    $this->db->from('opcion');
    $this->db->where('id_pregunta', $id_pregunta); 
    $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }return false;
}

    public function getPregunta($id_pregunta){
        $this->db->select('*');
        $this->db->from('pregunta');
        $this->db->where('id', $id_pregunta);
        return $this->db->get()->row();
    }

    public function aprobarPregunta($id_pregunta)
    {
        $data['estado'] = 'aprobado';
        $this->db->where('id', $id_pregunta);
        $this->db->update('pregunta', $data);
    }

    public function get_preguntas_programa($programa)
    {
//cargar las preguntas que aun no han sido aprobadas por el director de plan de estudios
        $this->db->select('p.id, u.nombre AS docente, a.nombre AS area');
        $this->db->from('pregunta p');
        $this->db->join('docente d', 'd.id_user=p.id_docente_cargo');
        $this->db->join('usuario u', 'u.id=d.id_user');
        $this->db->join('area a', 'p.id_area=a.id');
        $this->db->join('programa_academico pa', 'pa.id=u.id_programa');
        $this->db->where('pa.nombre', $programa);
        $this->db->where('p.estado', "espera");
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }return false;
    }

    public function getPreguntas($id)
    {
        //todos las preguntas creadas por un docente
        $this->db->select('p.id, p.id_area, a.nombre AS area, p.estado, p.visibilidad, p.id_enunciado');
        $this->db->from('pregunta p');
        $this->db->join('area a', 'a.id=p.id_area');
        $this->db->where('p.id_docente_cargo', $id);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }return false;
    }

    public function crearEnunciado($data)
    {
        $this->db->insert("enunciado", $data);
        $this->db->select('*');
        $this->db->from('enunciado');
        $consulta = $this->db->get()->result();

        return $consulta[count($consulta) - 1]->id; //retornar id ultimo enunciado
    }

    public function crearPregunta($info)
    {
        $this->db->insert("pregunta", $info);
        $this->db->select('id');
        $this->db->from('pregunta');
        $this->db->where('id_docente_cargo', $info['id_docente_cargo']);
        $consulta = $this->db->get()->result();

        return $consulta[count($consulta) - 1]->id;
    }

    public function registrarOpcion($data)
    {
        $this->db->insert("opcion", $data);
    }

    public function getOpciones($id_P)
    {
        $this->db->select('*');
        $this->db->from('opcion');
        $this->db->where('id_pregunta', $id_P);
        $resultados = $this->db->get();

        if ($resultados->num_rows() > 0) {
            return $resultados->result(); //un solo user
        } else {
            return false;
        }

    }

    public function getEnunciados($id)
    {
        //todos los enunciados del docente
        $this->db->select('*');
        $this->db->from('enunciado');
        $this->db->where('id_Docente', $id);
        $resultados = $this->db->get();

        if ($resultados->num_rows() > 0) {
            return $resultados->result(); //un solo user
        } else {
            return false;
        }
    }

    public function actualizarEnunciadoPregunta($data, $idPregunta)
    {
        //relacionar un enunciado a una pregunta
        $this->db->where('id', $idPregunta);
        return $this->db->update('pregunta', $data);
    }

    public function getEnunciado($id_P)
    {
//me retorna el enunciado relacionado a esa pregunta
        $this->db->select('*');
        $this->db->from('pregunta');
        $this->db->where('id', $id_P);
        $idE = $this->db->get()->row()->id_enunciado;

        if (!is_null($idE)) {

            $this->db->select('*');
            $this->db->from('enunciado');
            $this->db->where('id', $idE);
            return $this->db->get()->row();
        } else {
            return false;
        }
    }

    public function generarVF($id_p)
    {
        $this->db->where('id_pregunta', $id_p);
        return $this->db->delete('opcion');
    }

    public function actualizarDatosPregunta($data, $id_p)
    {
        $this->db->where('id', $id_p);
        return $this->db->update('pregunta', $data);
    }

}
