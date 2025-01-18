<?php

namespace app\controllers;
use app\models\mainModel;

class categoriaController extends mainModel {

    /*----------  Controlador registrar categoría  ----------*/
    public function registrarCategoriaControlador(){

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['categoria_codigo']);
        $nombre = $this->limpiarCadena($_POST['categoria_nombre']);
        $subcategoria = $this->limpiarCadena($_POST['categoria_subcategoria']);

        # Verificando campos obligatorios #
        if($codigo=="" || $nombre=="" || $subcategoria==""){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando si ya existe el código #
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM categoria WHERE codigo='$codigo'");
        if($check_codigo->rowCount()>0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El CÓDIGO de la categoría ya se encuentra registrado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Registrando categoría #
        $categoria_datos_reg = [
            [
                "campo_nombre" => "codigo",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo
            ],
            [
                "campo_nombre" => "nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "subcategoria",
                "campo_marcador" => ":Subcategoria",
                "campo_valor" => $subcategoria
            ],
            [
                "campo_nombre" => "fecha_registro",
                "campo_marcador" => ":FechaRegistro",
                "campo_valor" => date("Y-m-d H:i:s")
            ]
        ];

        $registrar_categoria = $this->guardarDatos("categoria", $categoria_datos_reg);

        if($registrar_categoria->rowCount() == 1){
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Categoría registrada",
                "texto" => "La categoría ".$nombre." se registró con éxito",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo registrar la categoría, por favor intente nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar categorías  ----------*/
    public function listarCategoriaControlador($pagina, $registros, $url, $busqueda){
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = $this->limpiarCadena($url);
        $url = APP_URL.$url."/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if(isset($busqueda) && $busqueda != ""){
            $consulta_datos = "SELECT * FROM categoria WHERE (nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%') ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_categoria) FROM categoria WHERE (nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%')";
        } else {
            $consulta_datos = "SELECT * FROM categoria ORDER BY nombre ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_categoria) FROM categoria";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $numeroPaginas = ceil($total / $registros);

        $tabla .= '
        <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">#</th>
                    <th class="has-text-centered">Código</th>
                    <th class="has-text-centered">Nombre</th>
                    <th class="has-text-centered">Subcategoría</th>
                    <th class="has-text-centered">Fecha Registro</th>
                    <th class="has-text-centered" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
        ';

        if($total >= 1 && $pagina <= $numeroPaginas){
            $contador = $inicio + 1;
            $pag_inicio = $inicio + 1;
            foreach($datos as $rows){
                $tabla .= '
                    <tr class="has-text-centered">
                        <td>'.$contador.'</td>
                        <td>'.$rows['codigo'].'</td>
                        <td>'.$rows['nombre'].'</td>
                        <td>'.$rows['subcategoria'].'</td>
                        <td>'.date("d-m-Y h:i:s A", strtotime($rows['fecha_registro'])).'</td>
                        <td>
                            <a href="'.APP_URL.'categoriaUpdate/'.$rows['id_categoria'].'/" class="button is-success is-rounded is-small">Actualizar</a>
                        </td>
                        <td>
                            <form class="FormularioAjax" action="'.APP_URL.'app/ajax/categoriaAjax.php" method="POST" autocomplete="off">
                                <input type="hidden" name="modulo_categoria" value="eliminar">
                                <input type="hidden" name="categoria_id" value="'.$rows['id_categoria'].'">
                                <button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                ';
                $contador++;
            }
            $pag_final = $contador - 1;
        } else {
            if($total >= 1){
                $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="7">
                            <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            } else {
                $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="7">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }
        }

        $tabla .= '</tbody></table></div>';

        ### Paginacion ###
        if($total > 0 && $pagina <= $numeroPaginas){
            $tabla .= '<p class="has-text-right">Mostrando categorías <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
            $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 7);
        }

        return $tabla;
    }

    /*----------  Controlador actualizar categoría  ----------*/
    public function actualizarCategoriaControlador(){
        $id = $this->limpiarCadena($_POST['categoria_id']);

        # Verificando categoría #
        $datos = $this->ejecutarConsulta("SELECT * FROM categoria WHERE id_categoria='$id'");
        if($datos->rowCount() <= 0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No hemos encontrado la categoría en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['categoria_codigo']);
        $nombre = $this->limpiarCadena($_POST['categoria_nombre']);
        $subcategoria = $this->limpiarCadena($_POST['categoria_subcategoria']);

        # Verificando campos obligatorios #
        if($codigo == "" || $nombre == "" || $subcategoria == ""){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando si el código existe #
        if($datos['codigo'] != $codigo){
            $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM categoria WHERE codigo='$codigo'");
            if($check_codigo->rowCount() > 0){
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El CÓDIGO ingresado ya se encuentra registrado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        }

        $categoria_datos_up = [
            [
                "campo_nombre" => "codigo",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo
            ],
            [
                "campo_nombre" => "nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "subcategoria",
                "campo_marcador" => ":Subcategoria",
                "campo_valor" => $subcategoria
            ]
        ];

        $condicion = [
            "condicion_campo" => "id_categoria",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];

        if($this->actualizarDatos("categoria", $categoria_datos_up, $condicion)){
            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Categoría actualizada",
                "texto" => "Los datos de la categoría ".$nombre." se actualizaron correctamente",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No hemos podido actualizar los datos de la categoría ".$nombre.", por favor intente nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }
}
