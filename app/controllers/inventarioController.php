<?php

namespace app\controllers;
use app\models\mainModel;

class libroController extends mainModel {

    /*----------  Controlador registrar libro  ----------*/
    public function registrarLibroControlador(){

        # Almacenando datos #
        $codigo = $this->limpiarCadena($_POST['libro_codigo']);
        $titulo = $this->limpiarCadena($_POST['libro_titulo']);
        $autor = $this->limpiarCadena($_POST['libro_autor']);
        $editorial = $this->limpiarCadena($_POST['libro_editorial']);
        $año = $this->limpiarCadena($_POST['libro_año']);
        $genero = $this->limpiarCadena($_POST['libro_genero']);
        $precio = $this->limpiarCadena($_POST['libro_precio']);
        $cantidad = $this->limpiarCadena($_POST['libro_cantidad']);
        $idioma = $this->limpiarCadena($_POST['libro_idioma']);
        $paginas = $this->limpiarCadena($_POST['libro_paginas']);
        $formato = $this->limpiarCadena($_POST['libro_formato']);

        # Verificando campos obligatorios #
        if($codigo=="" || $titulo=="" || $autor=="" || $precio=="" || $cantidad==""){
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
        if($this->verificarDatos("[a-zA-Z0-9-]{1,70}",$codigo)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El CÓDIGO no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando código #
        $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM libro WHERE codigo='$codigo'");
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

        $libro_datos_reg=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"tituloLibro",
                "campo_marcador"=>":Titulo",
                "campo_valor"=>$titulo
            ],
            [
                "campo_nombre"=>"autor",
                "campo_marcador"=>":Autor",
                "campo_valor"=>$autor
            ],
            [
                "campo_nombre"=>"editorial",
                "campo_marcador"=>":Editorial",
                "campo_valor"=>$editorial
            ],
            [
                "campo_nombre"=>"añoPublicacion",
                "campo_marcador"=>":Año",
                "campo_valor"=>$año
            ],
            [
                "campo_nombre"=>"genero",
                "campo_marcador"=>":Genero",
                "campo_valor"=>$genero
            ],
            [
                "campo_nombre"=>"precioVenta",
                "campo_marcador"=>":Precio",
                "campo_valor"=>$precio
            ],
            [
                "campo_nombre"=>"cantidad",
                "campo_marcador"=>":Cantidad",
                "campo_valor"=>$cantidad
            ],
            [
                "campo_nombre"=>"idioma",
                "campo_marcador"=>":Idioma",
                "campo_valor"=>$idioma
            ],
            [
                "campo_nombre"=>"noPaginas",
                "campo_marcador"=>":Paginas",
                "campo_valor"=>$paginas
            ],
            [
                "campo_nombre"=>"formato",
                "campo_marcador"=>":Formato",
                "campo_valor"=>$formato
            ],
            [
                "campo_nombre"=>"fecha_registro",
                "campo_marcador"=>":FechaRegistro",
                "campo_valor"=>date("Y-m-d H:i:s")
            ]
        ];

        $registrar_libro = $this->guardarDatos("libro", $libro_datos_reg);

        if($registrar_libro->rowCount()==1){
            $alerta=[
                "tipo"=>"limpiar",
                "titulo"=>"Libro registrado",
                "texto"=>"El libro ".$titulo." se registró con éxito",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo registrar el libro, por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar libro  ----------*/
    public function listarLibroControlador($pagina, $registros, $url, $busqueda){
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = $this->limpiarCadena($url);
        $url = APP_URL.$url."/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
        $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
        
        if(isset($busqueda) && $busqueda!=""){
            $consulta_datos = "SELECT * FROM libro WHERE (codigo LIKE '%$busqueda%' OR tituloLibro LIKE '%$busqueda%' OR autor LIKE '%$busqueda%') ORDER BY tituloLibro ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_libro) FROM libro WHERE (codigo LIKE '%$busqueda%' OR tituloLibro LIKE '%$busqueda%' OR autor LIKE '%$busqueda%')";
        }else{
            $consulta_datos = "SELECT * FROM libro ORDER BY tituloLibro ASC LIMIT $inicio,$registros";
            $consulta_total = "SELECT COUNT(id_libro) FROM libro";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $numeroPaginas = ceil($total/$registros);

           $tabla.='
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Título</th>
                    <th class="text-center">Autor</th>
                    <th class="text-center">Editorial</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
        ';

        if($total>=1 && $pagina<=$numeroPaginas){
            $contador=$inicio+1;
            $pag_inicio=$inicio+1;
            foreach($datos as $rows){
                $tabla.='
                    <tr class="text-center">
                        <td>'.$contador.'</td>
                        <td>'.$rows['codigo'].'</td>
                        <td>'.$rows['tituloLibro'].'</td>
                        <td>'.$rows['autor'].'</td>
                        <td>'.$rows['editorial'].'</td>
                        <td>'.$rows['genero'].'</td>
                        <td>$'.$rows['precioVenta'].'</td>
                        <td>'.$rows['cantidad'].'</td>
                        <td>
                            <button class="btn btn-success btn-sm rounded-pill" onclick="abrirModalEditar1({
                                id_libro: \''.$rows['id_libro'].'\',
                                codigo: \''.addslashes($rows['codigo']).'\',
                                titulo: \''.addslashes($rows['tituloLibro']).'\',
                                autor: \''.addslashes($rows['autor']).'\',
                                editorial: \''.addslashes($rows['editorial']).'\',
                                año: \''.addslashes($rows['añoPublicacion']).'\',
                                genero: \''.addslashes($rows['genero']).'\',
                                precio: \''.addslashes($rows['precioVenta']).'\',
                                cantidad: \''.addslashes($rows['cantidad']).'\',
                                idioma: \''.addslashes($rows['idioma']).'\',
                                paginas: \''.addslashes($rows['noPaginas']).'\',
                                formato: \''.addslashes($rows['formato']).'\'
                            })">Actualizar</button>
                        </td>
                        <td>
                            <button onclick="eliminarLibro('.$rows['id_libro'].')" class="btn btn-danger btn-sm rounded-pill">Eliminar</button>
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
                        <td colspan="10">
                            <a href="'.$url.'1/" class="btn btn-primary btn-sm rounded-pill mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            }else{
                $tabla.='
                    <tr class="text-center">
                        <td colspan="10">
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

    /*----------  Controlador eliminar libro  ----------*/
    public function eliminarLibroControlador(){
        $id = $this->limpiarCadena($_POST['libro_id']);

        # Verificando libro #
        $datos = $this->ejecutarConsulta("SELECT * FROM libro WHERE id_libro='$id'");
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
        $eliminar = $this->ejecutarConsulta("DELETE FROM libro WHERE id_libro='$id'");
        
        if($eliminar->rowCount()==1){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Libro eliminado",
                "texto"=>"El libro ha sido eliminado exitosamente",
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

    /*----------  Controlador actualizar libro  ----------*/
    public function actualizarLibroControlador(){
        $id = $this->limpiarCadena($_POST['libro_id']);

        # Verificando libro #
        $datos = $this->ejecutarConsulta("SELECT * FROM libro WHERE id_libro='$id'");
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
        $titulo = $this->limpiarCadena($_POST['libro_titulo']);
        $autor = $this->limpiarCadena($_POST['libro_autor']);
        $editorial = $this->limpiarCadena($_POST['libro_editorial']);
        $año = $this->limpiarCadena($_POST['libro_año']);
        $genero = $this->limpiarCadena($_POST['libro_genero']);
        $precio = $this->limpiarCadena($_POST['libro_precio']);
        $cantidad = $this->limpiarCadena($_POST['libro_cantidad']);
        $idioma = $this->limpiarCadena($_POST['libro_idioma']);
        $paginas = $this->limpiarCadena($_POST['libro_paginas']);
        $formato = $this->limpiarCadena($_POST['libro_formato']);

        # Verificando campos obligatorios #
        if($codigo=="" || $titulo=="" || $autor=="" || $precio=="" || $cantidad==""){
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
            $check_codigo = $this->ejecutarConsulta("SELECT codigo FROM libro WHERE codigo='$codigo'");
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

        # Verificando precio y cantidad #
        if(!is_numeric($precio) || $precio<=0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El PRECIO no es válido",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        if(!is_numeric($cantidad) || $cantidad<0){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"La CANTIDAD no es válida",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        $libro_datos_up=[
            [
                "campo_nombre"=>"codigo",
                "campo_marcador"=>":Codigo",
                "campo_valor"=>$codigo
            ],
            [
                "campo_nombre"=>"tituloLibro",
                "campo_marcador"=>":Titulo",
                "campo_valor"=>$titulo
            ],
            [
                "campo_nombre"=>"autor",
                "campo_marcador"=>":Autor",
                "campo_valor"=>$autor
            ],
            [
                "campo_nombre"=>"editorial",
                "campo_marcador"=>":Editorial",
                "campo_valor"=>$editorial
            ],
            [
                "campo_nombre"=>"añoPublicacion",
                "campo_marcador"=>":Año",
                "campo_valor"=>$año
            ],
            [
                "campo_nombre"=>"genero",
                "campo_marcador"=>":Genero",
                "campo_valor"=>$genero
            ],
            [
                "campo_nombre"=>"precioVenta",
                "campo_marcador"=>":Precio",
                "campo_valor"=>$precio
            ],
            [
                "campo_nombre"=>"cantidad",
                "campo_marcador"=>":Cantidad",
                "campo_valor"=>$cantidad
            ],
            [
                "campo_nombre"=>"idioma",
                "campo_marcador"=>":Idioma",
                "campo_valor"=>$idioma
            ],
            [
                "campo_nombre"=>"noPaginas",
                "campo_marcador"=>":Paginas",
                "campo_valor"=>$paginas
            ],
            [
                "campo_nombre"=>"formato",
                "campo_marcador"=>":Formato",
                "campo_valor"=>$formato
            ]
        ];

        $condicion=[
            "condicion_campo"=>"id_libro",
            "condicion_marcador"=>":ID",
            "condicion_valor"=>$id
        ];

        if($this->actualizarDatos("libro",$libro_datos_up,$condicion)){
            $alerta=[
                "tipo"=>"recargar",
                "titulo"=>"Libro actualizado",
                "texto"=>"Los datos del libro ".$titulo." se actualizaron correctamente",
                "icono"=>"success"
            ];
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos podido actualizar los datos del libro ".$titulo.", por favor intente nuevamente",
                "icono"=>"error"
            ];
        }

        return json_encode($alerta);
    }
}