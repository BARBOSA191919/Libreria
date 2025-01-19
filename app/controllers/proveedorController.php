<?php

namespace app\controllers;
use app\models\mainModel;

class proveedorController extends mainModel {

    /*----------  Controlador registrar proveedor  ----------*/
    public function registrarProveedorControlador(){

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['proveedor_codigo']);
        $nombreEmpresa = $this->limpiarCadena($_POST['proveedor_nombreEmpresa']);
        $contacto = $this->limpiarCadena($_POST['proveedor_contacto']);
        $direccion = $this->limpiarCadena($_POST['proveedor_direccion']);
        $telefono = $this->limpiarCadena($_POST['proveedor_telefono']);
        $email = $this->limpiarCadena($_POST['proveedor_email']);

        # Verificando campos obligatorios #
        if($codigo=="" || $nombreEmpresa==""){
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
        if($this->verificarDatos("[a-zA-Z0-9-]{1,50}",$codigo)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El CÓDIGO no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código único #
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM proveedor WHERE codigo='$codigo'");
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

        $proveedor_datos_reg=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"nombreEmpresa",
                "campo_marcador"=>":NombreEmpresa",
                "campo_valor"=>$nombreEmpresa
            ],
            [
                "campo_nombre"=>"contacto",
                "campo_marcador"=>":Contacto",
                "campo_valor"=>$contacto
            ],
            [
                "campo_nombre"=>"direccion",
                "campo_marcador"=>":Direccion",
                "campo_valor"=>$direccion
            ],
            [
                "campo_nombre"=>"telefono",
                "campo_marcador"=>":Telefono",
                "campo_valor"=>$telefono
            ],
            [
                "campo_nombre"=>"email",
                "campo_marcador"=>":Email",
                "campo_valor"=>$email
            ]
        ];

        $registrar_proveedor = $this->guardarDatos("proveedor", $proveedor_datos_reg);

        if($registrar_proveedor->rowCount()==1){
            $alerta=[
                "tipo"=>"limpiar",
                "titulo"=>"Proveedor registrado",
                "texto"=>"El proveedor ".$nombreEmpresa." se registró con éxito",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo registrar el proveedor, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar proveedor  ----------*/
    public function listarProveedorControlador($pagina, $registros, $url, $busqueda){
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
            $consulta_datos = "SELECT * FROM proveedor WHERE (nombreEmpresa LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%') ORDER BY nombreEmpresa ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_proveedor) FROM proveedor WHERE (nombreEmpresa LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%')";
        }else{
            $consulta_datos = "SELECT * FROM proveedor ORDER BY nombreEmpresa ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_proveedor) FROM proveedor";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $numeroPaginas = ceil($total/$registros);

        $tabla.='
        <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">#</th>
                    <th class="has-text-centered">Código</th>
                    <th class="has-text-centered">Empresa</th>
                    <th class="has-text-centered">Contacto</th>
                    <th class="has-text-centered">Dirección</th>
                    <th class="has-text-centered">Teléfono</th>
                    <th class="has-text-centered">Email</th>
                    <th class="has-text-centered" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
        ';

        if($total>=1 && $pagina<=$numeroPaginas){
            $contador=$inicio+1;
            $pag_inicio=$inicio+1;
            foreach($datos as $rows){
                $tabla.='
                    <tr class="has-text-centered">
                        <td>'.$contador.'</td>
                        <td>'.$rows['codigo'].'</td>
                        <td>'.$rows['nombreEmpresa'].'</td>
                        <td>'.$rows['contacto'].'</td>
                        <td>'.$rows['direccion'].'</td>
                        <td>'.$rows['telefono'].'</td>
                        <td>'.$rows['email'].'</td>
                        <td>
                            <button class="button is-success is-rounded is-small" onclick="abrirModalEditar({
                                id_proveedor: \''.$rows['id_proveedor'].'\',
                                codigo: \''.$rows['codigo'].'\',
                                nombreEmpresa: \''.addslashes($rows['nombreEmpresa']).'\',
                                contacto: \''.addslashes($rows['contacto']).'\',
                                direccion: \''.addslashes($rows['direccion']).'\',
                                telefono: \''.$rows['telefono'].'\',
                                email: \''.$rows['email'].'\'
                            })">Actualizar</button>
                        </td>
                        <td>
                            <button onclick="eliminarProveedor('.$rows['id_proveedor'].')" class="button is-danger is-rounded is-small">Eliminar</button>
                        </td>
                    </tr>
                ';
                $contador++;
            }
            $pag_final=$contador-1;
        }else{
            if($total>=1){
                $tabla.='
                    <tr class="has-text-centered">
                        <td colspan="9">
                            <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            }else{
                $tabla.='
                    <tr class="has-text-centered">
                        <td colspan="9">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }
        }

        $tabla.='</tbody></table></div>';

        if($total>0 && $pagina<=$numeroPaginas){
            $tabla.='<p class="has-text-right">Mostrando proveedores <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
            $tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
        }

        return $tabla;
    }

    /*----------  Controlador eliminar proveedor  ----------*/
    public function eliminarProveedorControlador(){
        $id = $this->limpiarCadena($_POST['proveedor_id']);

        # Verificando proveedor #
        $datos = $this->ejecutarConsulta("SELECT * FROM proveedor WHERE id_proveedor='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el proveedor en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Eliminando proveedor #
        $eliminar = $this->ejecutarConsulta("DELETE FROM proveedor WHERE id_proveedor='$id'");
        
        if($eliminar->rowCount()==1){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Proveedor eliminado",
                "texto"=>"El proveedor ha sido eliminado exitosamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo eliminar el proveedor, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador actualizar proveedor  ----------*/
    public function actualizarProveedorControlador(){
        $id = $this->limpiarCadena($_POST['proveedor_id']);

        # Verificando proveedor #
        $datos = $this->ejecutarConsulta("SELECT * FROM proveedor WHERE id_proveedor='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el proveedor en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }else{
            $datos = $datos->fetch();
        }

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['proveedor_codigo']);
        $nombreEmpresa = $this->limpiarCadena($_POST['proveedor_nombreEmpresa']);
        $contacto = $this->limpiarCadena($_POST['proveedor_contacto']);
        $direccion = $this->limpiarCadena($_POST['proveedor_direccion']);
        $telefono = $this->limpiarCadena($_POST['proveedor_telefono']);
        $email = $this->limpiarCadena($_POST['proveedor_email']);

        # Verificando campos obligatorios #
        if($codigo=="" || $nombreEmpresa==""){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No has llenado todos los campos que son obligatorios",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código #
        if($datos['codigo'] != $codigo){
            $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM proveedor WHERE codigo='$codigo'");
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

        $proveedor_datos_up=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"nombreEmpresa",
                "campo_marcador"=>":NombreEmpresa",
                "campo_valor"=>$nombreEmpresa
            ],
            [
                "campo_nombre"=>"contacto",
                "campo_marcador"=>":Contacto",
                "campo_valor"=>$contacto
            ],
            [
                "campo_nombre"=>"direccion",
                "campo_marcador"=>":Direccion",
                "campo_valor"=>$direccion
            ],
            [
                "campo_nombre"=>"telefono",
                "campo_marcador"=>":Telefono",
                "campo_valor"=>$telefono
            ],
            [
                "campo_nombre"=>"email",
                "campo_marcador"=>":Email",
                "campo_valor"=>$email
            ]
        ];

        $condicion=[
            "condicion_campo"=>"id_proveedor",
            "condicion_marcador"=>":ID",
            "condicion_valor"=>$id
        ];

        if($this->actualizarDatos("proveedor",$proveedor_datos_up,$condicion)){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Proveedor actualizado",
                "texto"=>"Los datos del proveedor ".$nombreEmpresa." se actualizaron correctamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos podido actualizar los datos del proveedor ".$nombreEmpresa.", por favor intente nuevamente",
                "icono"=>"error"
            ];
        }
        return json_encode($alerta);
    }
}