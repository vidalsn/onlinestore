<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "abstractclassbasicmodel.php";

class UsuarioRelacionTipo extends AbstractclassBasicModel
{
    const DB_TABLE = 'relacion_usuarios_tipos';
    const DB_TABLE_PK = 'id';
    public function __construct(){
        parent::__construct();
    }
}