<?php

namespace app\controllers;
use app\models\mainModel;

class autorController extends mainModel {

    /*----------  Controlador registrar autor  ----------*/
    public function registrarAutorControlador(){

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['autor_codigo']);
        $nombre = $this->limpiarCadena($_POST['autor_nombre']);
        $biografia = $this->limpiarCadena($_POST['autor_biografia']);
        $paisorigen = $this->limpiarCadena($_POST['autor_paisorigen']);

        # Verificando campos obligatorios #
        if($codigo=="" || $nombre==""){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No has llenado todos los campos que son obligatorios",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando integridad de los datos #
        if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}",$nombre)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El NOMBRE no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código único #
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM autor WHERE codigo='$codigo'");
        if($check_codigo->rowCount()>0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El CÓDIGO ingresado ya se encuentra registrado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        $autor_datos_reg=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"nombre",
                "campo_marcador"=>":Nombre",
                "campo_valor"=>$nombre
            ],
            [
                "campo_nombre"=>"biografia",
                "campo_marcador"=>":Biografia",
                "campo_valor"=>$biografia
            ],
            [
                "campo_nombre"=>"paisorigen",
                "campo_marcador"=>":PaisOrigen",
                "campo_valor"=>$paisorigen
            ]
        ];

        $registrar_autor = $this->guardarDatos("autor", $autor_datos_reg);

        if($registrar_autor->rowCount()==1){
            $alerta=[
                "tipo"=>"limpiar",
                "titulo"=>"Autor registrado",
                "texto"=>"El autor ".$nombre." se registró con éxito",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo registrar el autor, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar autor  ----------*/
    public function listarAutorControlador($pagina, $registros, $url, $busqueda){
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = $this->limpiarCadena($url);
        $url = APP_URL.$url."/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
        $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

        $pag_inicio = 0;
        $pag_final = 0;

        if(isset($busqueda) && $busqueda!=""){
            $consulta_datos = "SELECT * FROM autor WHERE (nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%') ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(idAutor) FROM autor WHERE (nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%')";
        }else{
            $consulta_datos = "SELECT * FROM autor ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(idAutor) FROM autor";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $numeroPaginas = ceil($total/$registros);

        $tabla.='
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th class="text-th">#</th>
                    <th class="text-th">Código</th>
                    <th class="text-th">Nombre</th>
                    <th class="text-th">País de Origen</th>
                    <th class="text-th">Biografía</th>
                    <th class="text-th">Opciones</th>
                </tr>
            </thead>
            <tbody>
        ';

        if($total>=1 && $pagina<=$numeroPaginas){
            $contador=$inicio+1;
            $pag_inicio=$inicio+1;
            foreach($datos as $rows){
                $tabla.='
                    <tr class="tr-main text-center">
                        <td class="text-td">'.$contador.'</td>
                        <td class="text-td">'.$rows['codigo'].'</td>
                        <td class="text-td">'.$rows['nombre'].'</td>
                        <td class="text-td">'.$rows['paisorigen'].'</td>
                        <td class="text-td">'.$rows['biografia'].'</td>
                        <td class="text-td">
                            <button class="text-td btn btn-success btn-sm rounded-pill" onclick="abrirModalEditarautor({
                                idAutor: \''.$rows['idAutor'].'\',
                                codigo: \''.$rows['codigo'].'\',
                                nombre: \''.addslashes($rows['nombre']).'\',
                                biografia: \''.addslashes($rows['biografia']).'\',
                                paisorigen: \''.addslashes($rows['paisorigen']).'\'
                            })"><i class=" bi bi-arrow-repeat"></i>
                        <span class="text-icono">
                        Actualizar
                        </span>
                        </button>
                
                            <button onclick="eliminarAutor('.$rows['idAutor'].')" class="text-td btn btn-danger btn-sm rounded-pill">
                            <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                ';
                $contador++;
            }
            $pag_final=$contador-1;
        }else{
            if($total>=1){
                $tabla.='
                    <tr class="has-text-centered text-td">
                        <td colspan="6">
                            <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            }else{
                $tabla.='
                    <tr class="has-text-centered text-td">
                        <td colspan="6">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }
        }

        $tabla.='</tbody></table></div>';

        if($total>0 && $pagina<=$numeroPaginas){
            $tabla.='<p class="has-text-right">Mostrando autores <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
            $tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
        }

        return $tabla;
    }

    /*----------  Controlador eliminar autor  ----------*/
    public function eliminarAutorControlador(){
        $id = $this->limpiarCadena($_POST['autor_id']);

        # Verificando autor #
        $datos = $this->ejecutarConsulta("SELECT * FROM autor WHERE idAutor='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el autor en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Eliminando autor #
        $eliminar = $this->ejecutarConsulta("DELETE FROM autor WHERE idAutor='$id'");
        
        if($eliminar->rowCount()==1){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Autor eliminado",
                "texto"=>"El autor ha sido eliminado exitosamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo eliminar el autor, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador actualizar autor  ----------*/
    public function actualizarAutorControlador(){
        $id = $this->limpiarCadena($_POST['autor_id']);

        # Verificando autor #
        $datos = $this->ejecutarConsulta("SELECT * FROM autor WHERE idAutor='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el autor en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }else{
            $datos = $datos->fetch();
        }

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['autor_codigo']);
        $nombre = $this->limpiarCadena($_POST['autor_nombre']);
        $biografia = $this->limpiarCadena($_POST['autor_biografia']);
        $paisorigen = $this->limpiarCadena($_POST['autor_paisorigen']);

        # Verificando campos obligatorios #
        if($codigo=="" || $nombre==""){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No has llenado todos los campos que son obligatorios",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código único #
        if($datos['codigo'] != $codigo){
            $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM autor WHERE codigo='$codigo'");
            if($check_codigo->rowCount()>0){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El CÓDIGO ingresado ya se encuentra registrado",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
        }

        $autor_datos_up=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"nombre",
                "campo_marcador"=>":Nombre",
                "campo_valor"=>$nombre
            ],
            [
                "campo_nombre"=>"biografia",
                "campo_marcador"=>":Biografia",
                "campo_valor"=>$biografia
            ],
            [
                "campo_nombre"=>"paisorigen",
                "campo_marcador"=>":PaisOrigen",
                "campo_valor"=>$paisorigen
            ]
        ];

        $condicion=[
            "condicion_campo"=>"idAutor",
            "condicion_marcador"=>":ID",
            "condicion_valor"=>$id
        ];

        if($this->actualizarDatos("autor",$autor_datos_up,$condicion)){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Autor actualizado",
                "texto"=>"Los datos del autor ".$nombre." se actualizaron correctamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos podido actualizar los datos del autor ".$nombre.", por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }
}