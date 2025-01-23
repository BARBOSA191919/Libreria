<?php

namespace app\controllers;
use app\models\mainModel;

class clienteController extends mainModel {

    /*----------  Controlador registrar cliente  ----------*/
    public function registrarClienteControlador(){

        # Almacenando datos #
        $nombre = $this->limpiarCadena($_POST['cliente_nombre']);
        $tipo_documento = $this->limpiarCadena($_POST['cliente_tipo_documento']);
        $numero_documento = $this->limpiarCadena($_POST['cliente_numero_documento']);
        $telefono = $this->limpiarCadena($_POST['cliente_telefono']);

        # Verificando campos obligatorios #
        if($nombre=="" || $tipo_documento=="" || $numero_documento==""){
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
        if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El NOMBRE no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando número de documento #
        $check_documento = $this->ejecutarConsulta("SELECT numero_documento FROM cliente WHERE numero_documento='$numero_documento'");
        if($check_documento->rowCount()>0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El NÚMERO DE DOCUMENTO ingresado ya se encuentra registrado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        $cliente_datos_reg=[
            [
                "campo_nombre"=>"nombre",
                "campo_marcador"=>":Nombre",
                "campo_valor"=>$nombre
            ],
            [
                "campo_nombre"=>"tipo_documento",
                "campo_marcador"=>":TipoDocumento",
                "campo_valor"=>$tipo_documento
            ],
            [
                "campo_nombre"=>"numero_documento",
                "campo_marcador"=>":NumeroDocumento",
                "campo_valor"=>$numero_documento
            ],
            [
                "campo_nombre"=>"telefono",
                "campo_marcador"=>":Telefono",
                "campo_valor"=>$telefono
            ],
            [
                "campo_nombre"=>"fecha_registro",
                "campo_marcador"=>":FechaRegistro",
                "campo_valor"=>date("Y-m-d H:i:s")
            ]
        ];

        $registrar_cliente = $this->guardarDatos("cliente", $cliente_datos_reg);

        if($registrar_cliente->rowCount()==1){
            $alerta=[
                "tipo"=>"limpiar",
                "titulo"=>"Cliente registrado",
                "texto"=>"El cliente ".$nombre." se registró con éxito",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo registrar el cliente, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar cliente  ----------*/
    public function listarClienteControlador($pagina, $registros, $url, $busqueda){
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = $this->limpiarCadena($url);
        $url = APP_URL.$url."/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";
    
        $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
        $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
        
        // Inicializamos las variables de paginación
        $pag_inicio = 0;
        $pag_final = 0;
    
        if(isset($busqueda) && $busqueda!=""){
            $consulta_datos = "SELECT * FROM cliente WHERE (nombre LIKE '%$busqueda%' OR numero_documento LIKE '%$busqueda%') ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_cliente) FROM cliente WHERE (nombre LIKE '%$busqueda%' OR numero_documento LIKE '%$busqueda%')";
        }else{
            $consulta_datos = "SELECT * FROM cliente ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_cliente) FROM cliente";
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
                    <th class="text-th">Nombre</th>
                    <th class="text-th">Tipo Documento</th>
                    <th class="text-th">Número Documento</th>
                    <th class="text-th">Teléfono</th>
                    <th class="text-th">Fecha Registro</th>
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
                        <td class="text-td">'.$rows['nombre'].'</td>
                        <td class="text-td">'.$rows['tipo_documento'].'</td>
                        <td class="text-td">'.$rows['numero_documento'].'</td>
                        <td class="text-td">'.$rows['telefono'].'</td>
                        <td class="text-td">'.date("d-m-Y  h:i:s A",strtotime($rows['fecha_registro'])).'</td>
                        <td class="text-td">
                            <button class="text-td btn btn-success btn-sm rounded-pill" onclick="abrirModalEditarcliente({
                                id_cliente: \''.$rows['id_cliente'].'\',
                                nombre: \''.addslashes($rows['nombre']).'\',
                                tipo_documento: \''.$rows['tipo_documento'].'\',
                                numero_documento: \''.$rows['numero_documento'].'\',
                                telefono: \''.$rows['telefono'].'\'
                            })"><i class=" bi bi-arrow-repeat"></i>
                          <span class="text-icono">
                           Actualizar
                          </span>
                        </button>
                        
                            <button onclick="eliminarCliente('.$rows['id_cliente'].')" class="text-td btn btn-danger btn-sm rounded-pill">
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
                    <tr class="has-text-centered">
                        <td colspan="7">
                            <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            }else{
                $tabla.='
                    <tr class="has-text-centered">
                        <td colspan="7">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }
        }
    
        $tabla.='</tbody></table></div>';
    
        ### Paginacion ###
        if($total>0 && $pagina<=$numeroPaginas){
            $tabla.='<p class="has-text-right">Mostrando clientes <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
            $tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
        }
    
        return $tabla;
    }
    public function eliminarClienteControlador(){
        $id = $this->limpiarCadena($_POST['cliente_id']);
    
        # Verificando cliente #
        $datos = $this->ejecutarConsulta("SELECT * FROM cliente WHERE id_cliente='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el cliente en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }
    
        # Eliminando cliente #
        $eliminar = $this->ejecutarConsulta("DELETE FROM cliente WHERE id_cliente='$id'");
        
        if($eliminar->rowCount()==1){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Cliente eliminado",
                "texto"=>"El cliente ha sido eliminado exitosamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo eliminar el cliente, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }
    
        return json_encode($alerta);
    }
    /*----------  Controlador actualizar cliente  ----------*/
    public function actualizarClienteControlador(){
        $id = $this->limpiarCadena($_POST['cliente_id']);

        # Verificando cliente #
        $datos = $this->ejecutarConsulta("SELECT * FROM cliente WHERE id_cliente='$id'");
        if($datos->rowCount()<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos encontrado el cliente en el sistema",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }else{
            $datos = $datos->fetch();
        }

        # Almacenando datos #
        $nombre = $this->limpiarCadena($_POST['cliente_nombre']);
        $tipo_documento = $this->limpiarCadena($_POST['cliente_tipo_documento']);
        $numero_documento = $this->limpiarCadena($_POST['cliente_numero_documento']);
        $telefono = $this->limpiarCadena($_POST['cliente_telefono']);

        # Verificando campos obligatorios #
        if($nombre=="" || $tipo_documento=="" || $numero_documento==""){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No has llenado todos los campos que son obligatorios",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando número de documento #
        if($datos['numero_documento'] != $numero_documento){
            $check_documento = $this->ejecutarConsulta("SELECT numero_documento FROM cliente WHERE numero_documento='$numero_documento'");
            if($check_documento->rowCount()>0){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El NÚMERO DE DOCUMENTO ingresado ya se encuentra registrado",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
        }

        $cliente_datos_up=[
            [
                "campo_nombre"=>"nombre",
                "campo_marcador"=>":Nombre",
                "campo_valor"=>$nombre
            ],
            [
                "campo_nombre"=>"tipo_documento",
                "campo_marcador"=>":TipoDocumento",
                "campo_valor"=>$tipo_documento
            ],
            [
                "campo_nombre"=>"numero_documento",
                "campo_marcador"=>":NumeroDocumento",
                "campo_valor"=>$numero_documento
            ],
            [
                "campo_nombre"=>"telefono",
                "campo_marcador"=>":Telefono",
                "campo_valor"=>$telefono
            ]
        ];

        $condicion=[
            "condicion_campo"=>"id_cliente",
            "condicion_marcador"=>":ID",
            "condicion_valor"=>$id
        ];

        if($this->actualizarDatos("cliente",$cliente_datos_up,$condicion)){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Cliente actualizado",
                "texto"=>"Los datos del cliente ".$nombre." se actualizaron correctamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos podido actualizar los datos del cliente ".$nombre.", por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }
}