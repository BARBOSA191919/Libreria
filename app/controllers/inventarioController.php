<?php 
namespace app\controllers;
use app\models\mainModel;

class inventarioController extends mainModel {

    /*----------  Controlador registrar inventario  ----------*/
    public function registrarInventarioControlador(){
        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['libro_codigo']);
        $titulo = $this->limpiarCadena($_POST['libro_titulo']);
        $autor = $this->limpiarCadena($_POST['libro_autor']);
        $editorial = $this->limpiarCadena($_POST['libro_editorial']);
        $anio = $this->limpiarCadena($_POST['libro_anio']);
        $genero = $this->limpiarCadena($_POST['libro_genero']);
        $precio = $this->limpiarCadena($_POST['libro_precio']);
        $cantidad = $this->limpiarCadena($_POST['libro_cantidad']);
        $idioma = $this->limpiarCadena($_POST['libro_idioma']);
        $paginas = $this->limpiarCadena($_POST['libro_paginas']);
        $formato = $this->limpiarCadena($_POST['libro_formato']);

        # Verificando campos obligatorios #
        if ($codigo == "" || $titulo == "" || $autor == "" || $precio == "" || $cantidad == "") {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código único #
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM inventario WHERE codigo='$codigo'");
        if ($check_codigo->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El código ingresado ya está registrado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Preparando datos #
        $inventario_datos_reg = [
            ["campo_nombre" => "codigo", "campo_marcador" => ":Codigo", "campo_valor" => $codigo],
            ["campo_nombre" => "tituloLibro", "campo_marcador" => ":Titulo", "campo_valor" => $titulo],
            ["campo_nombre" => "autor", "campo_marcador" => ":Autor", "campo_valor" => $autor],
            ["campo_nombre" => "editorial", "campo_marcador" => ":Editorial", "campo_valor" => $editorial],
            ["campo_nombre" => "anioPublicacion", "campo_marcador" => ":Anio", "campo_valor" => $anio],
            ["campo_nombre" => "genero", "campo_marcador" => ":Genero", "campo_valor" => $genero],
            ["campo_nombre" => "precioVenta", "campo_marcador" => ":Precio", "campo_valor" => $precio],
            ["campo_nombre" => "cantidad", "campo_marcador" => ":Cantidad", "campo_valor" => $cantidad],
            ["campo_nombre" => "idioma", "campo_marcador" => ":Idioma", "campo_valor" => $idioma],
            ["campo_nombre" => "noPaginas", "campo_marcador" => ":Paginas", "campo_valor" => $paginas],
            ["campo_nombre" => "formato", "campo_marcador" => ":Formato", "campo_valor" => $formato],
            ["campo_nombre" => "fecha_registro", "campo_marcador" => ":Fecha", "campo_valor" => date("Y-m-d H:i:s")]
        ];

        # Guardando registro #
        $registrar_inventario = $this->guardarDatos("inventario", $inventario_datos_reg);

        if ($registrar_inventario->rowCount() == 1) {
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Libro registrado",
                "texto" => "El libro $titulo se registró con éxito",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo registrar el libro, intenta nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar inventario  ----------*/
   public function listarInventarioControlador($pagina, $registros, $url, $busqueda) {
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
        $consulta_datos = "SELECT * FROM inventario WHERE (codigo LIKE '%$busqueda%' OR tituloLibro LIKE '%$busqueda%' OR autor LIKE '%$busqueda%') ORDER BY tituloLibro ASC LIMIT $inicio,$registros";
        $consulta_total = "SELECT COUNT(id_inventario) FROM inventario WHERE (codigo LIKE '%$busqueda%' OR tituloLibro LIKE '%$busqueda%' OR autor LIKE '%$busqueda%')";
    }else{
        $consulta_datos = "SELECT * FROM inventario ORDER BY tituloLibro ASC LIMIT $inicio,$registros";
        $consulta_total = "SELECT COUNT(id_inventario) FROM inventario";
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
            <tr class="text-center" >
                <th class="text-th">#</th>
                <th class="text-th">Código</th>
                <th class="text-th">Título</th>
                <th class="text-th">Autor</th>
                <th class="text-th">Editorial</th>
                <th class="text-th">Año</th>
                <th class="text-th">Género</th>
                <th class="text-th">Precio</th>
                <th class="text-th">Stock</th>
                <th class="text-th">Formato</th>
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
                    <td class="text-td">'.$rows['tituloLibro'].'</td>
                    <td class="text-td">'.$rows['autor'].'</td>
                    <td class="text-td">'.$rows['editorial'].'</td>
                    <td class="text-td">'.$rows['anioPublicacion'].'</td>
                    <td class="text-td">'.$rows['genero'].'</td>
                    <td class="text-td">'.$rows['precioVenta'].'</td>
                    <td class="text-td">'.$rows['cantidad'].'</td>
                    <td class="text-td">'.$rows['formato'].'</td>
                    <td td class="text-td">
                        <button class="text-td btn btn-success btn-sm rounded-pill" onclick="abrirModalEditarInventario({
                            id_libro: \''.$rows['id_inventario'].'\',
                            codigo: \''.addslashes($rows['codigo']).'\',
                            tituloLibro: \''.addslashes($rows['tituloLibro']).'\',
                            autor: \''.addslashes($rows['autor']).'\',
                            editorial: \''.addslashes($rows['editorial']).'\',
                            anioPublicacion: \''.addslashes($rows['anioPublicacion']).'\',
                            genero: \''.addslashes($rows['genero']).'\',
                            precioVenta: \''.addslashes($rows['precioVenta']).'\',
                            cantidad: \''.addslashes($rows['cantidad']).'\',
                            idioma: \''.addslashes($rows['idioma']).'\',
                            noPaginas: \''.addslashes($rows['noPaginas']).'\',
                            formato: \''.addslashes($rows['formato']).'\'
                        })"><i class=" bi bi-arrow-repeat"></i>
                    
                        </button>
                    
                <button onclick="eliminarLibro('.$rows['id_inventario'].')" class="text-td btn btn-danger btn-sm rounded-pill"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            ';
            $contador++;
        }
        $pag_final=$contador-1;
    }else{
        if($total>=1){
            $tabla.='
                <tr class="text-center">
                    <td colspan="11">
                        <a href="'.$url.'1/" class="btn btn-primary btn-sm mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>
            ';
        }else{
            $tabla.='
                <tr class="text-center">
                    <td colspan="11">
                        No hay registros en el sistema
                    </td>
                </tr>
            ';
        }
    }

    $tabla.='</tbody></table></div>';

    if($total>0 && $pagina<=$numeroPaginas){
        $tabla.='<p class="text-end">Mostrando libros <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
        $tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
    }

    return $tabla;
}
      /*----------  Controlador eliminar inventario  ----------*/
public function eliminarInventarioControlador(){
    $id = $this->limpiarCadena($_POST['libro_id']);

    # Verificando libro #
    $datos = $this->ejecutarConsulta("SELECT * FROM inventario WHERE id_inventario='$id'");
    if($datos->rowCount()<=0){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrió un error inesperado",
            "texto"=>"No hemos encontrado el libro en el sistema",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }

    # Eliminando libro #
    $eliminar = $this->ejecutarConsulta("DELETE FROM inventario WHERE id_inventario='$id'");
    
    if($eliminar->rowCount()==1){
        $alerta=[
            "tipo"=>"recargar",
            "titulo"=>"Libro eliminado",
            "texto"=>"El libro ha sido eliminado exitosamente del inventario",
            "icono"=>"success"
        ];
    }else{
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrió un error inesperado",
            "texto"=>"No se pudo eliminar el libro, por favor intente nuevamente",
            "icono"=>"error"
        ];
    }

    return json_encode($alerta);
}

/*----------  Controlador actualizar inventario  ----------*/
public function actualizarInventarioControlador(){
    $id = $this->limpiarCadena($_POST['libro_id']);

    # Verificando libro #
    $datos = $this->ejecutarConsulta("SELECT * FROM inventario WHERE id_inventario='$id'");
    if($datos->rowCount()<=0){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrió un error inesperado",
            "texto"=>"No hemos encontrado el libro en el sistema",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }else{
        $datos = $datos->fetch();
    }

    # Almacenando datos #
    $codigo = $this->limpiarCadena($_POST['libro_codigo']);
    $tituloLibro = $this->limpiarCadena($_POST['libro_titulo']);
    $autor = $this->limpiarCadena($_POST['libro_autor']);
    $editorial = $this->limpiarCadena($_POST['libro_editorial']);
    $anioPublicacion = $this->limpiarCadena($_POST['libro_anio']);
    $genero = $this->limpiarCadena($_POST['libro_genero']);
    $precioVenta = $this->limpiarCadena($_POST['libro_precio']);
    $cantidad = $this->limpiarCadena($_POST['libro_cantidad']);
    $idioma = $this->limpiarCadena($_POST['libro_idioma']);
    $noPaginas = $this->limpiarCadena($_POST['libro_paginas']);
    $formato = $this->limpiarCadena($_POST['libro_formato']);

    # Verificando campos obligatorios #
    if($codigo=="" || $tituloLibro=="" || $autor==""){
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
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM inventario WHERE codigo='$codigo'");
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

    $libro_datos_up=[
        ["campo_nombre"=>"codigo", "campo_marcador"=>":Codigo", "campo_valor"=>$codigo],
        ["campo_nombre"=>"tituloLibro", "campo_marcador"=>":Titulo", "campo_valor"=>$tituloLibro],
        ["campo_nombre"=>"autor", "campo_marcador"=>":Autor", "campo_valor"=>$autor],
        ["campo_nombre"=>"editorial", "campo_marcador"=>":Editorial", "campo_valor"=>$editorial],
        ["campo_nombre"=>"anioPublicacion", "campo_marcador"=>":Anio", "campo_valor"=>$anioPublicacion],
        ["campo_nombre"=>"genero", "campo_marcador"=>":Genero", "campo_valor"=>$genero],
        ["campo_nombre"=>"precioVenta", "campo_marcador"=>":Precio", "campo_valor"=>$precioVenta],
        ["campo_nombre"=>"cantidad", "campo_marcador"=>":Cantidad", "campo_valor"=>$cantidad],
        ["campo_nombre"=>"idioma", "campo_marcador"=>":Idioma", "campo_valor"=>$idioma],
        ["campo_nombre"=>"noPaginas", "campo_marcador"=>":Paginas", "campo_valor"=>$noPaginas],
        ["campo_nombre"=>"formato", "campo_marcador"=>":Formato", "campo_valor"=>$formato]
    ];

    $condicion=[
        "condicion_campo"=>"id_inventario",  // Cambiado de id_libro a id_inventario
        "condicion_marcador"=>":ID",
        "condicion_valor"=>$id
    ];

    if($this->actualizarDatos("inventario",$libro_datos_up,$condicion)){
        $alerta=[
            "tipo"=>"recargar",
            "titulo"=>"Libro actualizado",
            "texto"=>"Los datos del libro ".$tituloLibro." se actualizaron correctamente",
            "icono"=>"success"
        ];
    }else{
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrió un error inesperado",
            "texto"=>"No hemos podido actualizar los datos del libro ".$tituloLibro.", por favor intente nuevamente",
            "icono"=>"error"
        ];
    }

    return json_encode($alerta);
}
  }