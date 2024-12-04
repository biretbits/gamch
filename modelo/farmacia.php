<?php
/**
 *
 */

class Farmacia
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarNombreGenerico($inicioList=false,$listarDeCuanto=false,$buscar='',$codNombreGenerico=false){
    $sql = "select p.cod_generico,p.codigo,p.nombre,p.enfermedad,p.vitrina,p.stockmin,p.stockmax,p.cod_forma,p.cod_conc,p.cod_usuario,
    p.stock_producto,p.cantidad_total,p.estado,f.cod_forma,f.nombre_forma,c.cod_conc,c.concentracion,u.cod_usuario,u.nombre_usuario,u.ap_usuario,u.am_usuario
     from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join conc_uni_med as c on p.cod_conc=c.cod_conc inner join usuario as u where p.cod_usuario = u.cod_usuario ";
    if($buscar != ''){
       $sql.=" and (LOWER(p.nombre) LIKE '%".$buscar."%' or LOWER(p.codigo) LIKE '%".$buscar."%') ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY p.cod_generico DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }

  public function SeleccionarConcentracion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from conc_uni_med";
    if($buscar != ''){
       $sql.=" where LOWER(concentracion) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_conc DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarPresentacion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from forma_presentacion";
    if($buscar != ''){
       $sql.=" where LOWER(nombre_forma) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_forma DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }


  public function InsertarActualizarPresentacion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update forma_presentacion set nombre_forma='".$generico."' where cod_forma = $cod_generico";
    }else{//insertar
      $sql = "insert into forma_presentacion(nombre_forma)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax,$cod_forma,$cod_conc,$usuario,$codigo){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update producto set codigo='".$codigo."',nombre='".$generico."',enfermedad='".$enfermedad."',vitrina='".$vitrina."',stockmin=$stockmin,";
      $sql.="stockmax=$stockmax,cod_forma=$cod_forma,cod_conc=$cod_conc,fechaHora=now() where cod_generico = $cod_generico";
    }else{//insertar
      $sql = "insert into producto(codigo,nombre,enfermedad,vitrina,stockmin,stockmax,cod_forma,cod_conc,cod_usuario,fechaHora,estado)values";
      $sql.="('".$codigo."','".$generico."','".$enfermedad."','".$vitrina."',$stockmin,$stockmax,$cod_forma,$cod_conc,$usuario,now(),'activo');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarConcentracion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update conc_uni_med set concentracion='".$generico."' where cod_conc = $cod_generico";
    }else{//insertar
      $sql = "insert into conc_uni_med(concentracion)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }


  public function p(){
    $sql = "select *from p";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarProducto($inicioList=false,$listarDeCuanto=false,$buscar='',$fechai=false,$fechaf=false,$estadoProducto=false){
    $sql="SELECT
    e.cod_entrada,e.nrodoc,e.nro,e.fuente_reposicion,e.programa_salud,e.cod_proveedor,e.costo_valorado,
    e.saldo,e.nrolote,e.lote_generico,e.lote_nacional,e.cantidad,e.respaldo_cantidad,e.manipulado,e.costounitario,e.costototal,e.costototal_respaldo,e.vencimiento,e.fecha,
    e.hora,e.cod_usuario,e.cod_generico,e.estado_producto,e.estado,p.codigo,p.nombre,p.cod_forma,
    u.cod_usuario,u.nombre_usuario,u.ap_usuario,u.am_usuario,p.cod_conc
    FROM entrada AS e
    INNER JOIN producto AS p ON e.cod_generico = p.cod_generico
    INNER JOIN usuario AS u ON e.cod_usuario = u.cod_usuario ";
    if($estadoProducto != false){
      $sql.=" and e.estado_producto ='$estadoProducto' ";
    }
    if($buscar !=''){
      $sql.=" and (p.nombre LIKE '%$buscar%' or p.codigo like '%$buscar%')";
    }
    if($fechai!=false &&$fechaf!=false){
      $sql.=" and (e.fecha >= '$fechai' and e.fecha <= '$fechaf') ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY e.cod_entrada DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    //echo "<br>".$sql;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
 }

 public function seleccionarNG(){
   $sql = "select * from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join conc_uni_med as c on p.cod_conc=c.cod_conc and p.estado = 'activo'";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarC(){
   $sql = "select *from conc_uni_med";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarP(){
   $sql = "select *from forma_presentacion";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarCID($id){
   $sql = "select *from conc_uni_med where cod_conc = $id";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarPID($id){
   $sql = "select *from forma_presentacion where cod_forma = $id";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }

 public function InsertEntradaProducto($da,$fechaActual,$usuario,$hora){
   $sql = "";$uso = '';
   $accion = 'si';
   $cod_entrada = $da["cod_entrada"];
   if(is_numeric($cod_entrada)){//update
      $uso = $this->verificarSIcantidadSEuso($cod_entrada);
      if($uso =='no_se_uso'){
        $accion = 'si';
      }
   }else{//insert
      $accion='si';
   }
   if($accion == 'si'){
     $cod_producto = $da["cod_producto"];

      $cod_proveedor = $da["cod_proveedor"];
      $nrodoc = $da["nrodoc"];
      $programa_salud = $da["programa_salud"];
      $nro = $da["nro"];
      $fuente_reposicion = $da["fuente_reposicion"];
      $proveedor = $da["proveedor"];
      $representante = $da["representante"];
      $nombre_producto = $da["nombre_producto"];
      $costo_valorado = $da["costo_valorado"];
      $saldo = $da["saldo"];
      $nrolote = $da["nrolote"];
      $lote_generico = $da["lote_generico"];
      $lote_nacional = $da["lote_nacional"];
      $cantidad = $da["cantidad"];
      $unitario = $da["unitario"];
      $total = $da["total"];
      $vencimiento = $da["vencimiento"];
      $sql = '';
      if (is_numeric($cod_entrada)) {
          // Si cod_entrada es numérico, se realiza un UPDATE
          $sql = "UPDATE entrada
                  SET
                      nrodoc = '$nrodoc',
                      nro = '$nro',
                      fuente_reposicion = '$fuente_reposicion',
                      programa_salud = '$programa_salud',
                      cod_proveedor = '$cod_proveedor',
                      costo_valorado = '$costo_valorado',
                      saldo = '$saldo',
                      nrolote = '$nrolote',
                      lote_generico = '$lote_generico',
                      lote_nacional = '$lote_nacional',
                      cantidad = '$cantidad',
                      respaldo_cantidad = '$cantidad',
                      manipulado = '',
                      costounitario = '$unitario',
                      costototal = '$total',
                      costototal_respaldo = '$total',
                      vencimiento = '$vencimiento',
                      cod_generico = '$cod_producto',
                      fecha = '$fechaActual',
                      hora = '$hora',
                      cod_usuario = '$usuario'
                  WHERE cod_entrada = '$cod_entrada'";
      } else {
          // Si cod_entrada no es numérico, se realiza un INSERT
          $sql = "INSERT INTO entrada (
                      cod_entrada, nrodoc, nro, fuente_reposicion, programa_salud, cod_proveedor, costo_valorado, saldo, nrolote, lote_generico,
                      lote_nacional, cantidad, respaldo_cantidad, manipulado, costounitario, costototal, costototal_respaldo,
                      vencimiento, fecha, hora, cod_usuario, cod_generico
                  ) VALUES (
                      '$cod_entrada', '$nrodoc', '$nro', '$fuente_reposicion', '$programa_salud', '$cod_proveedor', '$costo_valorado', '$saldo', '$nrolote',
                      '$lote_generico', '$lote_nacional', '$cantidad', '$cantidad', '', '$unitario', '$total', '$total', '$vencimiento', '$fechaActual',
                      '$hora', '$usuario', '$cod_producto'
                  )";
      }

   if($uso=='' or $uso=='no_se_uso')
   {
     $resul = $this->con->query($sql);

    if($resul !=''){
      return "correcto";
    }else{
      return "error";
    }
  }else{
    return $uso;
  }
 }
}


 function verificarSIcantidadSEuso($cod_entrada){
   $lis = "select *from entrada where cantidad=respaldo_cantidad and cod_entrada = $cod_entrada";
   $resul = $this->con->query($lis);
   $si = 'no_se_uso';
   if($resul->num_rows > 0){
      $si='no_se_uso';//si es mayor a cero esto quiere decir que hay una fila osea esta intacto sin usar
   }else{
     $si='ya_se_uso';//no esta intacto ya se utilizo la cantidad
   }
   return $si;
 }

 public function buscarProductoFar($nombre_producto){
   $nombre_producto = strtolower($nombre_producto);
   $lis = "select *from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join
   conc_uni_med as c on p.cod_conc=c.cod_conc WHERE p.estado='activo' and LOWER(p.nombre) LIKE '%$nombre_producto%' LIMIT 5 OFFSET 0";
   $resul = $this->con->query($lis);
   return $resul;
}
//funcion para seleccionar de tabla salida
 public function SeleccionarSalida($inicioList=false,$listarDeCuanto=false,$buscar='',$fechai=false,$fechaf=false){
     $sql="select s.cod_salida,
          s.nombre_receta,
          s.entregado,
          s.cod_usuario,
          s.cod_paciente,
          s.fechaHora,
          s.estado,
          u.ci_usuario,
           u.usuario,
           u.nombre_usuario,
           u.ap_usuario,
           u.am_usuario,
           u.fecha_nac_usuario,
           u.edad_usuario,
           u.telefono_usuario,
           u.direccion_usuario,
           u.profesion_usuario,
           u.especialidad_usuario,
           u.ocupacion_usuario,
           u.comunidad_usuario
          from salida as s inner join usuario as u on s.cod_paciente=u.cod_usuario ";
     $si = "no";
     $buscar = strtolower($buscar);
     if($buscar !='' && $si == 'no'){
       $sql.=" where (lower(s.nombre_receta) LIKE '%$buscar%' or lower(u.nombre_usuario) LIKE '%$buscar%'
       or lower(u.ap_usuario) LIKE '%$buscar%' or lower(u.am_usuario) LIKE '%$buscar%')";
       $si = 'si';
     }

     if($fechai!=false &&$fechaf!=false && $si == 'no'){
       $sql.=" where (DATE(s.fechaHora) >= '$fechai' and DATE(s.fechaHora) <= '$fechaf') ";
     }else if($fechai!=false &&$fechaf!=false && $si == 'si'){
       $sql.="  and (DATE(s.fechaHora) >= '$fechai' and DATE(s.fechaHora) <= '$fechaf') ";
     }
     if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
       $sql.=" ORDER BY s.cod_salida DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
     }
     //echo $sql;
     $resul = $this->con->query($sql);
     if($resul===false){
       return $this->con->error;
     }else{
       return $resul;
     }
 }

 public function UpdateNG($accion,$cod_generico){
   if($accion == 'activo'){
       $sql = "update producto set estado = 'desactivo' where cod_generico=".$cod_generico;
   }else{
       $sql = "update producto set estado = 'activo' where cod_generico=".$cod_generico;
   }
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }

 public function UpdateEF($accion,$cod_entrada){
   $uso='';
   $uso=$this->verificarSIcantidadSEuso($cod_entrada);
   if($uso == "ya_se_uso")
   {
     return $uso;
   }else{
    // echo $cod_entrada."   ".$accion;
     if($accion == 'activo'){
         $sql = "update entrada set estado = 'desactivo' where cod_entrada=".$cod_entrada;
     }else{
         $sql = "update entrada set estado = 'activo' where cod_entrada=".$cod_entrada;
     }
     $resul = $this->con->query($sql);
     // Retornar el resultado
     if($resul != ''){
       return "correcto";
     }else{
       return "error";
     }
   }
   mysqli_close($this->con);
 }

 public function buscarPacienteFar($nombre_paciente){
   $nombre_paciente = strtolower($nombre_paciente);
   $lis = "select *from usuario WHERE (LOWER(nombre_usuario) LIKE '%$nombre_paciente%' or LOWER(ap_usuario) like '%$nombre_paciente%') and tipo_usuario='paciente' and estado='activo' LIMIT 5 OFFSET 0;";
   $resul = $this->con->query($lis);
   return $resul;
   mysqli_close($this->con);
 }


   public function entradaTodo($fechaActual,$cod_generico){
     $sql = "select *from entrada where vencimiento >= '$fechaActual' and cod_generico=$cod_generico and estado = 'activo' order by vencimiento asc";
     $resul = $this->con->query($sql);
     // Retornar el resultado
     return $resul;
     mysqli_close($this->con);
   }

   public function actualizarCantidad($nueva_cantidad,$cod_entrada){
     //echo $nueva_cantidad."  =  ".$cod_entrada."<br>";
     $sql = "update entrada set cantidad = $nueva_cantidad where cod_entrada=".$cod_entrada;
     $this->con->query($sql);
    // mysqli_close($this->con);
   }

   public function seleccionarEntradas(){
     $select="select *from entrada where estado = 'activo'";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   public function ProductoVencido($cod_entrada){
     $select="update entrada set estado_producto='vencido' where cod_entrada=".$cod_entrada."";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   public function SeleccionarProductosTodo(){
     $select="select *from producto where estado='activo'";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   public function actualizarCantidadNuevo($si,$cantidad_total,$cod_generico){
     $sql= "update producto set stock_producto='$si',cantidad_total=".$cantidad_total." where cod_generico=".$cod_generico."";
     $this->con->query($sql);
   }
   public function ModificarPrecioTotalEnEntrada($cod_entrada){
     $sql= "update entrada set costototal= (cantidad * costounitario) where cod_entrada = $cod_entrada";
     $this->con->query($sql);
   }

   public function insertarNuevoRegistroSalida($cod_producto,$cantidad,$codigos,$cat_res,$cod_salida,$costos,$total,$costosUnitarios,$fechaHoraActual){
    // $costoUnitario = $fa->ObtenerCostoUnitario();
     $select = '';
       $select="insert into productosolicitado(cantidad_solicitada,codigos_entrada,cantidadRestado,costosUnitario
       ,costos,costoTotal,fechaHora,cod_producto,cod_salida)
       values($cantidad,'$codigos','$cat_res','$costosUnitarios','$costos',$total,'$fechaHoraActual',$cod_producto,$cod_salida)";

       $resul = $this->con->query($select);
       if($resul!=''){
         $ultimoId = $this->con->insert_id;
         return $ultimoId;
       }
     mysqli_close($this->con);
   }
   public function ObtenerCostoUnitario(){
     $select = '';
       $select="select costounitario from entrada where cod_entrada";
       $resul = $this->con->query($select);
       if($resul!=''){
         $ultimoId = $this->con->insert_id;
         return $ultimoId;
       }
     mysqli_close($this->con);
   }

   public function actualizar_datos_entrada($cod_solicitado){
    // echo $cod_solicitado." cod solicitado";
     $resultado = $this->seleccionarProductoSolicitado($cod_solicitado);
     $fila = mysqli_fetch_array($resultado);
     $codigos = $fila["codigos_entrada"];
     $cantidad_resta = $fila["cantidadRestado"];
     $separar = explode(',', $codigos);
     $sepa = explode(',',$cantidad_resta);
     //primero verificamos si uno de los productos ya vencio o no vencio
     $re= '';
     $re=$this->verificarVencimientoPrimero($separar);
     if($re==0){
        return $re;
      }else{
        return $re;
      }
   }

   function verificarVencimientoPrimero($codigos_sep) {
     $c = 0;
     for ($i = 0; $i < count($codigos_sep); $i++) {
         $select = "SELECT * FROM entrada WHERE cod_entrada = $codigos_sep[$i] AND estado_producto = 'vencido' AND estado = 'activo'";
         $resul = $this->con->query($select);
         if ($resul) {
             if (mysqli_num_rows($resul) > 0) {
                 $c = 1;
                 break;
             }
         }
     }
     return $c;
 }

   public function SeleccionarSalidaID($cod_salida){
     $select="select *from salida where cod_salida = $cod_salida";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   function seleccionarProductoSolicitado($cod_solicitado){
     $select="select *from productosolicitado where cod_solicitado = $cod_solicitado";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   public function actualizarCantidadEntradaDesdeSalida($nueva_cantidad,$cod_entrada){
    $re = $this->detectarMayor($cod_entrada);//esta funcion permite saver si el dato en ese codigo es mayor si es mayor se colocara el datos del campo de apoyo
    $c = $re[0];
    $cantOLD = $re[1];
    //echo $c."   ".$cantOLD;
    if($c == 'si'){//si es mayor solo copiamos el dato de respando cantidad
      //echo "lleggooooooooo";
      $sql = "update entrada set cantidad = $cantOLD,costototal = costounitario * cantidad  where cod_entrada=".$cod_entrada;
    }else{//si no es mayor solo sumamos el valor
      $sql = "update entrada set cantidad = (cantidad+$nueva_cantidad), costototal = costounitario * cantidad
       where cod_entrada=".$cod_entrada;
    }
    $this->con->query($sql);
   }

   function detectarMayor($cod_entrada){
     $sql = "select *from entrada where cantidad>=respaldo_cantidad and cod_entrada = $cod_entrada and estado = 'activo'";
     $resul = $this->con->query($sql);
     $c = "no";
     $cantOLD = "";
     if($resul){
       if(mysqli_num_rows($resul)>0){
         $fi = mysqli_fetch_array($resul);
         $cantOLD = $fi['respaldo_cantidad'];
        $c="si";
       }
     }
     return array($c,$cantOLD);
   }

   public function seleccionarCantEntrada($cod_solicitado){
     $resultado = $this->seleccionarProductoSolicitadoID($cod_solicitado);//seleccionamos productos solicitados
     $fila = mysqli_fetch_array($resultado);
     $codigos = $fila["codigos_entrada"];
     $cantidad_resta = $fila["cantidadRestado"];
     $separar = explode(',', $codigos);
     $sepa = explode(',',$cantidad_resta);
     return array($separar,$sepa);
   }

   public function SumasActualizar($codigos,$cantiEntra){
     for ($i = 0; $i < count($codigos); $i++) {
       $this->actualizarCantidadEntradaDesdeSalida($cantiEntra[$i],$codigos[$i]);
     }
   }

   public function eliminarRegistro($cod_salida){
     $select="delete from salida where cod_salida = $cod_salida";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   function seleccionarProductoSolicitadoID($cod_solicitado){
     $select="select *from productosolicitado where cod_solicitado=$cod_solicitado";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }

   public function InsertarENsalida($cod_salida,$nombre_receta,$usuario,$id_paciente){
    $sql = '';
    if (is_numeric($cod_salida)) {
    // Si cod_salida es numérico, se realiza un UPDATE
    $sql = "UPDATE salida
            SET
                nombre_receta = '$nombre_receta',
                cod_usuario = '$usuario',
                cod_paciente = '$id_paciente',
                fechaHora = null,
                estado = 'activo'
            WHERE cod_salida = '$cod_salida'";
    } else {
        // Si cod_salida no es numérico, se realiza un INSERT
        $sql = "INSERT INTO salida (
                    cod_salida, nombre_receta, cod_usuario, cod_paciente, fechaHora, estado
                ) VALUES (
                    '$cod_salida', '$nombre_receta', '$usuario', '$id_paciente', null, 'activo'
                )";
    }

    $resul = $this->con->query($sql);
    if($resul!=''){
      if(is_numeric($cod_salida)){
        return  $cod_salida;
      }else{
        $ultimoId = $this->con->insert_id;
        return $ultimoId;
      }
    }

   }

   function buscarSolicitado($cod_solicitado){
     $select="select *from productosolicitado as ps inner join producto as p on ps.cod_producto = p.cod_generico
     where ps.cod_solicitado=$cod_solicitado";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
   }
   function actualizarProductosSolicitados($ar,$codigosNEW,$cat_resNEW,$costos,$total,$costosUnitarios){
     $cod_solicitado = $ar['cod_solicitado1'];
     $cod_producto = $ar["cod_producto1"];
     $cantidad = $ar["cantidad1"];
     $sql = "update productoSolicitado set cantidad_solicitada=$cantidad,codigos_entrada='$codigosNEW',
     cantidadRestado='$cat_resNEW',costosUnitario = '$costosUnitarios',costos = '$costos', costoTotal = $total,cod_producto=$cod_producto where cod_solicitado = $cod_solicitado";
     $resul = $this->con->query($sql);
     // Retornar el resultado
     return $resul;
   }

   public function ActualizarEntregaDePaciente($cod_salida,$fecha){
     $select="update salida set entregado = 'si',fechaHora = '$fecha' where cod_salida=$cod_salida";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
    mysqli_close($this->con);
   }

   public function buscarDatosProductoS($cod_salida){
     $select="select   ps.fechaHora AS fechaHora_solicitado,p.fechaHora AS fechaHora_producto,ps.*,p.*
     from productosolicitado as ps inner join producto as p on ps.cod_producto=p.cod_generico where cod_salida=$cod_salida";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
  }

   public function deleteProductoSolicitado($cod_solicitado){
     $select="delete from productoSolicitado where cod_solicitado=$cod_solicitado";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
     mysqli_close($this->con);
   }

   public function SeleccionarCodigosSolicitados($cod_salida){
     $select="select * from productoSolicitado where cod_salida=$cod_salida";
     $resul = $this->con->query($select);
     // Retornar el resultado
     return $resul;
     mysqli_close($this->con);
   }

   //funcion de proveedor
   public function SeleccionarProveedor($buscar='',$inicioList=false,$listarDeCuanto=false,){
     $sql = "select *from proveedor";
     if($buscar != ''){
       $sql.=" where (lower(nombre) like '%$buscar%')";
     }
     $sql.= " order by cod_prov desc";
     if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
       $sql.=" LIMIT $listarDeCuanto OFFSET $inicioList ";
     }
   //  echo "<br><br><br><br>".$sql;
     $resul = $this->con->query($sql);
     // Retornar el resultado
     if($resul===false){
       return $this->con->error;
     }else{
       return $resul;
     }
     mysqli_close($this->con);
   }
//end proveedor
//registrar proveedor
  public function InsertarProveedor($datos){
    $cod_prov = $datos["cod_prov"];$nombre=$datos["nombre"];$telefono=$datos["telefono"];
    $correo = $datos["correo"];$cod_rep = $datos["cod_rep"];
    $fecha = '';//iniciamos una variable fecha en vacio
    /*if(!is_numeric($datos["cod_pat"]))
    {
      $fecha = date("Y-m-d");
      $hora = date("H:i:s");
    }*/
    $sql = '';
    if (is_numeric($cod_prov)) {
        // Si cod_prov es numérico, se realiza un UPDATE
        $sql = "UPDATE proveedor
                SET
                    nombre = '$nombre',
                    telefono = '$telefono',
                    correo = '$correo',
                    cod_representante = '$cod_rep'
                WHERE cod_prov = '$cod_prov'";
    } else {
        // Si cod_prov no es numérico, se realiza un INSERT
        $sql = "INSERT INTO proveedor (
                    cod_prov, nombre, telefono, correo, cod_representante
                ) VALUES (
                    '$cod_prov', '$nombre', '$telefono', '$correo', '$cod_rep'
                )";
    }

    // Ejecutar la consulta
    $resul = $this->con->query($sql);
    return $resul;
  }
//end registrar proveedor
//Eliminar proveedorTabla
  public function EliminarProveedor($cod_prov,$estado){
    $estado_nuevo = '';
    if($estado == 'activo'){
      $estado_nuevo = 'desactivo';
    }else{
      $estado_nuevo = 'activo';
    }
    $sql = "update proveedor set estado = '$estado_nuevo' where cod_prov = $cod_prov";
    $resul = $this->con->query($sql);
    return $resul;
  }
//eliniar end

   //funcion de representante
   public function SeleccionarRepresentante($buscar='',$inicioList=false,$listarDeCuanto=false,){
     $sql = "select *from representante";
     if($buscar != ''){
       $sql.=" where (lower(nombre_apellidos) like '%$buscar%')";
     }
     $sql.= " order by cod_rep desc";
     if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
       $sql.=" LIMIT $listarDeCuanto OFFSET $inicioList ";
     }
   //  echo "<br><br><br><br>".$sql;
     $resul = $this->con->query($sql);
     // Retornar el resultado
     if($resul===false){
       return $this->con->error;
     }else{
       return $resul;
     }
     mysqli_close($this->con);
   }
   public function InsertarRepresentante($datos){
     $cod_rep = $datos["cod_rep"];$nombre_apellidos=$datos["nombre_apellidos"];$telefono=$datos["telefono"];
     $cargo = $datos["cargo"];
     $fecha = '';//iniciamos una variable fecha en vacio
     /*if(!is_numeric($datos["cod_pat"]))
     {
       $fecha = date("Y-m-d");
       $hora = date("H:i:s");
     }*/
     $sql = '';
     if (is_numeric($cod_rep)) {
     // Si cod_rep es numérico, se realiza un UPDATE
     $sql = "UPDATE representante
             SET
                 nombre_apellidos = '$nombre_apellidos',
                 telefono = '$telefono',
                 cargo = '$cargo'
             WHERE cod_rep = '$cod_rep'";
     } else {
         // Si cod_rep no es numérico, se realiza un INSERT
         $sql = "INSERT INTO representante (
                     cod_rep, nombre_apellidos, telefono, cargo
                 ) VALUES (
                     '$cod_rep', '$nombre_apellidos', '$telefono', '$cargo'
                 )";
     }

     // Ejecutar la consulta
     $resul = $this->con->query($sql);
     return $resul;
   }
   public function EliminarRepresentante($cod_rep,$estado){
     $estado_nuevo = '';
     if($estado == 'activo'){
       $estado_nuevo = 'desactivo';
     }else{
       $estado_nuevo = 'activo';
     }
     $sql = "update representante set estado = '$estado_nuevo' where cod_rep = $cod_rep";
     $resul = $this->con->query($sql);
     return $resul;
   }

   public function representanteBuscar($representante){
     $sql = "select *from representante where (lower(nombre_apellidos) like '%$representante%') LIMIT 5 OFFSET 0";
     $resul = $this->con->query($sql);
     return $resul;
   }
   public function selectDatosRepresentante($id){
    if(is_numeric($id))
     {
       $lis = "select * from representante where cod_rep = $id";
       $resul = $this->con->query($lis);
       $a = [];
       while ($fi = mysqli_fetch_array($resul)) {
         $datos = [
           "nombre_apellidos" => $fi["nombre_apellidos"],
           "telefono"=> $fi["telefono"],
           "cargo"=>$fi["cargo"]
         ];
         $a[] = $datos;
       }
       return $a;
     }else{
       return '';
     }
     mysqli_close($this->con);
   }
  //end representante
  public function buscarProveedorTabla($proveedor){
    $proveedor = strtolower($proveedor);
    $lis = "select *from proveedor as p  inner join representante as r on r.cod_rep = p.cod_representante
    where (LOWER(p.nombre) like '%$proveedor%' or LOWER(r.nombre_apellidos) like '%$proveedor%') and p.estado = 'activo' LIMIT 5 OFFSET 0";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }
  public function SeleccionarDatosProveed($id){
    $lis = "select *from proveedor as p  inner join representante as r on r.cod_rep = p.cod_representante
    where p.cod_prov=$id and p.estado = 'activo'";
    $resul = $this->con->query($lis);
    return $resul;
  }

  public function  entrada2(){
    $select="select *from entrada where estado = 'activo'";
    $resul = $this->con->query($select);
    return $resul;
  }

  public function ActualizarEnEntradaAvencido($cod_entrada,$accion){
    $sql2 = "update entrada set estado_producto='".$accion."' where cod_entrada=".$cod_entrada."";
    $resul = $this->con->query($sql2);
  }
  public function SeleccionarSoloProductos(){
    $select2="select *from producto where estado='activo'";
    $resul = $this->con->query($select2);
    if($resul != ''){
      return $resul;
    }else{
      return "error";
    }
  }

  public function updateStockProducto($total,$cod_generico,$accion){
    $sql= "update producto set stock_producto='".$accion."', cantidad_total=".$total." where cod_generico=".$cod_generico."";
    $resul = $this->con->query($sql);
  }

  public function selectMedicamentosObtenidos($cod_salida){
    $sql= "select *from productosolicitado where cod_salida=$cod_salida";
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function selectMedicamentosSalida($cod_salida){
    $sql= "select *from salida where cod_salida=$cod_salida";
    $resul = $this->con->query($sql);
    return $resul;
  }

    public function selectProductos($cod_producto){
      $datos = []; // Inicializar la variable para evitar errores si no hay resultados
      $sql= "select *from producto where cod_generico=$cod_producto";
      $resul = $this->con->query($sql);
      while($row = $resul->fetch_assoc()) {
       $datos[] = $row;
     }
     return $datos;
    }

    public function selectodosLosDatosUsuario($cod_usuario){
      $datos = []; // Inicializar la variable para evitar errores si no hay resultados
      $sql= "select *from usuario where cod_usuario=$cod_usuario";
      $resul = $this->con->query($sql);
      while($row = $resul->fetch_assoc()) {
       $datos[] = $row;
     }
     return $datos;
    }
}



 ?>
