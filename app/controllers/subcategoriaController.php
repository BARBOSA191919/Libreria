<?php
namespace app\controllers;
use app\models\mainModel;

class subcategoriaController extends mainModel {

  /*----------  Método para obtener categorias  ----------*/
    public function obtenerCategoriaSControlador() {
        $consulta = "SELECT id_categoria, nombre FROM categoria ORDER BY nombre";
        $sql = $this->ejecutarConsulta($consulta);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*----------  Controlador registrar subcategoria  ----------*/
    public function registrarSubcategoriaControlador(){
    # Almacenando datos #
    $nombre = $this->limpiarCadena($_POST['subcategoria_nombre']);
    $id_categoria = $this->limpiarCadena($_POST['subcategoria_id_categoria']);

    # Verificando campos obligatorios #
    if($nombre == "" || $id_categoria == ""){
        $alerta = [
            "tipo" => "simple",
            "titulo" => "Error",
            "texto" => "No has llenado todos los campos obligatorios",
            "icono" => "error"
        ];
        return json_encode($alerta);
    }

    # Verificando si la categoría existe #
    $check_categoria = $this->ejecutarConsulta("SELECT id_categoria FROM categoria WHERE id_categoria='$id_categoria'");
    if($check_categoria->rowCount() <= 0){
        $alerta = [
            "tipo" => "simple",
            "titulo" => "Error",
            "texto" => "La categoría seleccionada no existe",
            "icono" => "error"
        ];
        return json_encode($alerta);
    }

    # Registrando la subcategoría #
    $subcategoria_datos_reg = [
        [
            "campo_nombre" => "nombre",
            "campo_marcador" => ":Nombre",
            "campo_valor" => $nombre
        ],
        [
            "campo_nombre" => "id_categoria",
            "campo_marcador" => ":IDCategoria",
            "campo_valor" => $id_categoria
        ]
    ];

    $registrar_subcategoria = $this->guardarDatos("subcategoria", $subcategoria_datos_reg);

    if($registrar_subcategoria->rowCount() == 1){
        $alerta = [
            "tipo" => "limpiar",
            "titulo" => "Éxito",
            "texto" => "La subcategoría se registró correctamente",
            "icono" => "success"
        ];
    } else {
        $alerta = [
            "tipo" => "simple",
            "titulo" => "Error",
            "texto" => "No se pudo registrar la subcategoría",
            "icono" => "error"
        ];
    }

    return json_encode($alerta);
}

    /*----------  Controlador listar subcategorias  ----------*/
    public function listarSubcategoriaControlador($pagina, $registros, $url, $busqueda){
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = $this->limpiarCadena($url);
        $url = APP_URL.$url."/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int)$pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if(isset($busqueda) && $busqueda != ""){
            $consulta_datos = "SELECT sub.*, cat.nombre AS categoria_nombre FROM subcategoria sub 
                              JOIN categoria cat ON sub.id_categoria = cat.id_categoria 
                              WHERE sub.nombre LIKE '%$busqueda%' OR cat.nombre LIKE '%$busqueda%' 
                              ORDER BY sub.nombre ASC LIMIT $inicio, $registros";
            $consulta_total = "SELECT COUNT(id_subcategoria) FROM subcategoria sub 
                               JOIN categoria cat ON sub.id_categoria = cat.id_categoria 
                               WHERE sub.nombre LIKE '%$busqueda%' OR cat.nombre LIKE '%$busqueda%'";
        } else {
            $consulta_datos = "SELECT sub.*, cat.nombre AS categoria_nombre FROM subcategoria sub 
                              JOIN categoria cat ON sub.id_categoria = cat.id_categoria 
                              ORDER BY sub.nombre ASC LIMIT $inicio, $registros";
            $consulta_total = "SELECT COUNT(id_subcategoria) FROM subcategoria";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int)$total->fetchColumn();

        $numeroPaginas = ceil($total / $registros);

        $tabla .= '<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th class="text-th">Nombre</th>
                        <th class="text-th">Categoria</th>
                        <th class="text-th">Opciones</th>
                    </tr>
                </thead>
                <tbody>';

        if($total >= 1 && $pagina <= $numeroPaginas){
            $contador = $inicio + 1;
            foreach($datos as $rows){
                $tabla .= '<tr class="tr-main text-center" class="text-td">
                    <td class="text-td">'.$rows['nombre'].'</td>
                    <td class="text-td">'.$rows['categoria_nombre'].'</td>
                    <td class="text-td">
                        <button class="text-td btn btn-success btn-sm rounded-pill onclick="abrirModalEditarSubcategoria('.$rows['id_subcategoria'].')"><i class=" bi bi-arrow-repeat"></i>
                        <span class="text-icono">
                        Actualizar
                        </span>
                        </button>
                        <button class="text-td btn btn-danger btn-sm rounded-pill" onclick="eliminarSubcategoria('.$rows['id_subcategoria'].')">
                        <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>';
                $contador++;
            }
        } else {
            $tabla .= '<tr class="text-center">
                <td colspan="4">No hay registros en el sistema</td>
            </tr>';
        }

        $tabla .= '</tbody></table></div>';

        if($total > 0 && $pagina <= $numeroPaginas){
            $tabla .= '<p class="text-end">Mostrando subcategor\u00edas del <strong>'.($inicio+1).'</strong> al <strong>'.($contador-1).'</strong> de un total de <strong>'.$total.'</strong></p>';
            $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 7);
        }

        return $tabla;
    }

    /*----------  Controlador eliminar subcategoria  ----------*/
    public function eliminarSubcategoriaControlador(){
        $id = $this->limpiarCadena($_POST['subcategoria_id']);

        # Verificando subcategor\u00eda #
        $datos = $this->ejecutarConsulta("SELECT * FROM subcategoria WHERE id_subcategoria='$id'");
        if($datos->rowCount() <= 0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurri\u00f3 un error inesperado",
                "texto" => "No hemos encontrado la subcategor\u00eda en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
        }

        $eliminar = $this->ejecutarConsulta("DELETE FROM subcategoria WHERE id_subcategoria='$id'");

        if($eliminar->rowCount() == 1){
            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Subcategor\u00eda eliminada",
                "texto" => "La subcategor\u00eda ha sido eliminada exitosamente",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurri\u00f3 un error inesperado",
                "texto" => "No se pudo eliminar la subcategor\u00eda, por favor intente nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador actualizar subcategoria  ----------*/
    public function actualizarSubcategoriaControlador(){
        $id = $this->limpiarCadena($_POST['subcategoria_id']);

        $datos = $this->ejecutarConsulta("SELECT * FROM subcategoria WHERE id_subcategoria='$id'");
        if($datos->rowCount() <= 0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurri\u00f3 un error inesperado",
                "texto" => "No hemos encontrado la subcategor\u00eda en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
        }

        $nombre = $this->limpiarCadena($_POST['subcategoria_nombre']);
        $id_categoria = $this->limpiarCadena($_POST['subcategoria_id_categoria']);

        if($nombre == "" || $id_categoria == ""){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurri\u00f3 un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
        }

        $subcategoria_datos_up = [
            ["campo_nombre" => "nombre", "campo_marcador" => ":Nombre", "campo_valor" => $nombre],
            ["campo_nombre" => "id_categoria", "campo_marcador" => ":IDCategoria", "campo_valor" => $id_categoria]
        ];

        $condicion = [
            "condicion_campo" => "id_subcategoria",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];

        if($this->actualizarDatos("subcategoria", $subcategoria_datos_up, $condicion)){
            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Subcategor\u00eda actualizada",
                "texto" => "Los datos de la subcategor\u00eda se actualizaron correctamente",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurri\u00f3 un error inesperado",
                "texto" => "No se pudo actualizar la subcategor\u00eda, intente nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }
}
