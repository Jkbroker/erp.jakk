<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class jakkbonos extends CI_Model
{
    private $afiliados = array();
    private $temp = false;
    private $fechaInicio = '';
    private $fechaFin = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('/bo/bonos/afiliado');
    }

    function getTemp()
    {
        $val = $this->temp;
        $this->temp = array();
        #log_message("DEV","<tmp> ".json_encode($val)."</tmp>");
        return $val;
    }
    function getTempRows($implode = false,$del =  false)
    {
        $val = $this->temp;
        if(!$val)
            return false;
        if($del)
            $this->temp = array();
        #log_message("DEV","<tmp> ".json_encode($val)."</tmp>");
        if($implode)
            $val = implode(",", $val);
        return $val;
    }
    function setTempRows($tmp) {
        if(gettype($this->temp)!="array")
            $this->temp = array();
        foreach ($this->temp as $tmps)
            if($tmps == $tmp)
                return false;
        array_push($this->temp,$tmp);
    }

    function getAfiliados($log = false)
    {
        $val = $this->afiliados;
        $this->afiliados = array();
        if($log)
            log_message("DEV","<afiliados> ".json_encode($val)."</afiliados>");
        if($this->temp)
            $this->getTemp();
        return $val;
    }

    function setAfiliados($afiliados) {
        if(gettype($this->afiliados)!="array")
            $this->afiliados = array();

        array_push($this->afiliados,$afiliados);
    }

    function setFechaInicio($value = '')
    {
        if (! $value)
            $value = date('Y-m-d');

        $this->fechaInicio = $value;
    }

    function setFechaFin($value = '')
    {
        if (! $value)
            $value = date('Y-m-d');

        $this->fechaFin = $value;
    }

    function getTituloAfiliado($id_usuario,$red = 1,$fecha = '' )
    {
        $query ="SELECT * FROM cross_rango_user WHERE id_user = $id_usuario";

        $q = $this->db->query($query);
        $q = $q->result();

        if(!$q)
            return false;

        $id = $this->issetVar($q,"id_rango",0);

        return $this->getTitulo("nombre","id = $id");
    }


    function isActived ( $id_usuario,$id_bono = 0,$red = 1,$fecha = '' )
    {
        $bono = $this->getBono($id_bono);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $this->setFechaInicio($this->getPeriodoFecha($periodo,"INI", $fecha));
        $this->setFechaFin($this->getPeriodoFecha($periodo, "FIN", $fecha));

        $isActived = $this->isActivedAfiliado($id_usuario,$red);
        $isPaid = $this->isPaid($id_usuario,$id_bono,$red);
        $isScheduled = $this->isValidDate($id_usuario,$id_bono);

        $part= "P:($isPaid) A:($isActived) S:($isScheduled)";
        $log = "ID:$id_usuario BONO:$id_bono RED:$red ACTIVO: [$part]";
        log_message('DEV',$log);

        if($isPaid||!$isActived||!$isScheduled)
            return false;

        return true;
    }

    function isActivedAfiliado($id_usuario,$red = false)
    {
        if($id_usuario==2)
            return true;

        $where = "AND id_red != 1 AND estatus = 'ACT'";

        if($red)
            $where.=" AND id_red = $red";

        $red_activa = $this->getLastRed($id_usuario,$where);

        return ($red_activa);
    }


    public function getNombreRed($id_red)
    {
        $dato_red = $this->getTipoRed($id_red);
        $nombre_red = $this->issetVar($dato_red, "nombre", "Red");

        return $nombre_red;
    }

    public function getLastAfiliar($id, $red)
    {
        $query = "SELECT max(id) id FROM afiliar WHERE id_afiliado = $id AND id_red = $red";

        $q = $this->db->query($query);
        $q = $q->result();

        $id = $q ? $q[0]->id : rand(1000, 9999);
        return $id;
    }


    private function isRegistered($id)
    {
        $query = "SELECT * FROM afiliar WHERE id_afiliado = $id AND id_red = 1";

        $this->db->query($query);
        return $query;
    }

    private function isPaid($id_usuario,$id_bono,$red = 1)
    {
        $query = "SELECT
						*
					FROM
						comision_bono c,
						comision_bono_historial h
					WHERE
						c.id_bono_historial = h.id
						AND c.id_bono = h.id_bono
						AND h.id_bono = $id_bono
						AND h.red = $red
						AND c.id_usuario = $id_usuario
						AND h.fecha BETWEEN '$this->fechaInicio' AND '$this->fechaFin'
						AND (c.valor > 0 OR c.extra != '')";

        $q = $this->db->query($query);
        $q =$q->result();

        if (! $q)
            return false;

        $valid = (sizeof($q) > 0) ? true : false;

        return $valid;
    }

    private function isValidDate($id_usuario,$id_bono,$dia = false)
    {
        $bono = $this->getBono($id_bono);

        $mes_inicio = $bono[0]->mes_desde_afiliacion;
        $mes_fin = $bono[0]->mes_desde_activacion;

        if($mes_inicio<=0)
            return true;

        $select = "DATE_FORMAT(created, '%Y-%m')";
        $select.= " < DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $mes_inicio MONTH),'%Y-%m')";

        if($dia)
            $select = "created < DATE_SUB(NOW(), INTERVAL $mes_inicio MONTH)";

        $query = "SELECT
					    $select 'valid'
					FROM
					    users
					WHERE
					    id = " . $id_usuario;

        $q = $this->db->query($query);
        $q = $q->result();

        if (! $q)
            return false;

        $valid = $this->issetVar($q,"valid",0);
        $valid = ($valid == 1) ? true : false;

        return $valid;
    }

    private function isScheduled($id_usuario,$id_bono,$fecha = "")
    {
        $bono = $this->getBono($id_bono);

        $mes_inicio = $bono[0]->mes_desde_afiliacion;
        $mes_fin = $bono[0]->mes_desde_activacion;
        $where = "";

        $fecha = (strlen($fecha)>2) ? "'".$fecha."'" : "NOW()";

        $isHalfMonth = "(DATE_FORMAT(created,'%d')<16)";
        $halfMonth = "CONCAT(DATE_FORMAT(created,'%Y-%m'),'-15')";
        $limiteInicio = "(CASE WHEN $isHalfMonth THEN $halfMonth ELSE LAST_DAY(created) END)";

        if($mes_inicio>0)
            $where .= " AND DATE_FORMAT($fecha, '%Y-%m-%d') > ".$limiteInicio;

        if($mes_fin>0){
            $mes_fin+=$mes_inicio;
            $where .= " AND DATE_FORMAT($fecha, '%Y-%m-%d') <= ".$limiteInicio;
        }

        $query = "SELECT
					    1 'valid'
					FROM
					    users
					WHERE
					    id = ".$id_usuario.$where;

        $q = $this->db->query($query);
        $q = $q->result();
        if (! $q)
            return false;

        $valid = $this->issetVar($q,"valid",0);
        $valid = ($valid == 1) ? true : false;

        return $valid;
    }

    function getBonosUsuario($id_usuario)
    {
        $redes = $this->getBonoRedes($id_usuario);
        $bonos = $this->getBonos();

        $fecha = date('Y-m-d');
        $parametro = array("id_usuario" => $id_usuario,"fecha" => $fecha);
        $formatoMonto = 'integer';
        $formatoDoble = 'array';

        foreach ($redes as $red){

            $id_red= $red->id_red;
            $parametro["red"] = $id_red;

            foreach ($bonos as $bono){

                $id_bono = $bono->id;
                $valor = 0;
                $extra = "";

                $isActived = $this->isActived($id_usuario,$id_bono,$id_red);

                if($isActived)
                    $valor = $this->getValorBonoBy($id_bono, $parametro);

                $isDoble = gettype($valor) == $formatoDoble;
                $isMonto = gettype($valor) == $formatoMonto;

                if($isDoble){
                    $extra = $valor[1];
                    $valor = $valor[0];
                }else if(!$isMonto){
                    $extra = $valor;
                    $valor = 0;
                }

                $isGanancia = $valor>0||strlen($extra)>2;

                if($isGanancia)
                    $this->repartirBono($id_bono, $id_usuario, $valor,$extra,$fecha,$id_red);

            }/* foreach: $bonos */
        }/* foreach: $redes */
    }

    private function repartirBono($id_bono,$id_usuario,$valor,$extra = "",$fecha="",$red = 1)
    {
        $bono = $this->getBono($id_bono);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $fechaInicio=$this->getPeriodoFecha($periodo,"INI", $fecha);
        $fechaFin=$this->getPeriodoFecha($periodo, "FIN", $fecha);

        $historial = $this->getHistorialBono($id_bono,$fechaInicio, $fechaFin,$red);

        if(!$historial)
            $historial= $this->newHistorialBono($id_bono, $fechaInicio, $fechaFin,$red);

        $this->insertBonoUsuario($id_bono, $id_usuario, $valor, $historial,$extra);

        return true;
    }

    private function newHistorialBono($id_bono, $fechaInicio, $fechaFin,$red=1)
    {
        $dia = date('d', strtotime($fechaInicio));
        $mes = date('m', strtotime($fechaInicio));
        $anio = date('Y', strtotime($fechaInicio));

        $query = "INSERT INTO comision_bono_historial (id_bono,dia,mes,ano,fecha)
                    VALUES ($id_bono,$dia,$mes,$anio,'$fechaFin')";

        $this->db->query($query);

        $result = $this->getHistorialBono($id_bono,$fechaInicio, $fechaFin);

        return $result;
    }

    private function getHistorialBono($id_bono, $fechaInicio, $fechaFin,$red=1)
    {
        $query = "SELECT * FROM comision_bono_historial
            		WHERE
                        fecha  between '$fechaInicio' AND '$fechaFin'
                        AND id_bono = $id_bono";

        $q = $this->db->query($query);
        $result = $q->result();

        if (! $result)
            return false;

        $historial = $result[0]->id;

        return $historial;
    }

    private function insertBonoUsuario($id_bono, $id_usuario, $valor, $historial, $extra="")
    {
        $query = "INSERT INTO comision_bono
                     (id_usuario,id_bono,id_bono_historial,valor,extra)
                    VALUES 
                     ($id_usuario,$id_bono,$historial,$valor,'$extra')";

        $this->db->query($query);
    }


    function getValorBonoBy($id_bono,$parametro)
    {
        switch ($id_bono){

            case 1 :
                return $this->getValorBonoDirectos($parametro);
                break;

            case 2 :
                return $this->getValorBonoBinario($parametro);
                break;

            case 3 :
                return $this->getValorBonoInversion($parametro);
                break;

            default:
                return 0;
                break;

        }/* switch: $id_bono */
    }

    private function getValorBonoDirectos($parametro)
    {
        $id_bono = 1;
        $valores = $this->getBonoValorNiveles($id_bono);

        $bono = $this->getBono($id_bono);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $fechaInicio=$this->getPeriodoFecha($periodo, "INI", $parametro["fecha"]);
        $fechaFin=$this->getPeriodoFecha($periodo, "FIN", $parametro["fecha"]);

        $id_usuario = $parametro["id_usuario"];
        $id_red = isset($parametro["red"]) ?  $parametro["red"] : 1;

        log_message('DEV', "BONO $id_bono between: $fechaInicio - $fechaFin");

        $afiliados = $this->getAfiliadosInicial($valores, $id_usuario, $fechaInicio, $fechaFin);

        $monto = $this->getMontoInicial($valores, $afiliados, $fechaInicio, $fechaFin);

        return $monto;
    }

    private function getAfiliadosInicial($valores, $id, $fechaInicio, $fechaFin)
    {
        $where = ""; #@test: 1

        $afiliados = array();

        foreach ($valores as $nivel) {

            if ($nivel->nivel > 0) {

                $this->getDirectosBy($id, $nivel->nivel, $where);
                array_push($afiliados, $this->getAfiliados());

            }/* if: $nivel */
        }/* foreach: $valores */

        return $afiliados;
    }

    private function getMontoInicial($valores, $afiliados, $fechaInicio, $fechaFin, $red = 1)
    {
        $monto = 0; $lvl = 0;
        $usuario = new $this->afiliado();
        $calculo = "getCalculoPersonal";
        $afiliados = $this->setScheduled($valores, $afiliados, $fechaInicio, 2);
        for ($i = 0; $i < sizeof($valores); $i ++) {
            $Corre = ($i > 0) && isset($afiliados[$lvl]);
            if ($Corre) {
                $per = $valores[$i]->valor / 100;
                #@test: 2
                $afiliado = implode(",", $afiliados[$lvl]);
                $valor = $usuario->$calculo($afiliado,$fechaInicio,$fechaFin,"0","0","PUNTOS");
                $valor *= $per;
                #@test: 3
                log_message('DEV', "A:$afiliado N:$i P:".($per * 100)."% V:$valor S:$monto");
                $monto += $valor;
                #@test: 4
                $lvl ++;
            }/* if: $corre */
        }/* for: $valores */
        return $monto;
    }

    private function getValorBonoBinario($parametro,$pagar=false)
    {
        if(!isset($parametro["fecha"]))
            $parametro["fecha"] = date('Y-m-d');

        $id_bono = 2;
        $valores = $this->getBonoValorNiveles($id_bono);

        $bono = $this->getBono(1);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $fechaInicio=$this->getPeriodoFecha($periodo, "INI", $parametro["fecha"]);
        $fechaFin=$this->getPeriodoFecha($periodo, "FIN", $parametro["fecha"]);

        $id_usuario = $parametro["id_usuario"];
        $id_red = isset($parametro["red"]) ?  $parametro["red"] : 1;

        $afiliados = $this->getAfiliadosMatriz($valores,$id_usuario);

        $ganancia =0;

        if($pagar&&$ganancia>0)
            $this->repartirBono($id_bono, $id_usuario, $ganancia,"",$fechaFin);

        return $ganancia;
    }

    private function getAfiliadosMatriz($valores, $id)
    {
        $where = ""; #@test: 1

        $afiliados = array();

        if(!$valores)
            return array();

        $limite = $afiliados[0]->valor;

        for($key = 0;$key<$limite; $key++) {

            $nivel = $key + 1;

            $this->getAfiliadosBy($id, $nivel, "RED", $where);
            array_push($afiliados, $this->getAfiliados());


        }/* foreach: $valores */

        return $afiliados;
    }


    private function getGananciaAvance($id_usuario,$valores,$id_red,$fechaInicio,$fechaFin)
    {
        if($id_usuario<=2)return 0;

        $this->getAfiliadosBy($id_usuario, 2,"RED","",false,$id_red);
        $afiliados = $this->getAfiliados();
        $InicioFecha = $this->getInicioFecha($id_usuario);

        $aplica = 0;
        $item = $id_red-1;
        $monto = $valores[$item]->valor;
        $usuario = new $this->afiliado ();
        $compras = "getComprasPersonalesIntervaloDeTiempo";
        $where = "AND i.categoria = 1";
        foreach ($afiliados as $id_dato){
            $valor=$usuario->$compras($id_dato,1,$InicioFecha,$fechaFin,5,$item,"COSTO",$where);

            if($valor>0)
                $aplica++;
        }

        if($aplica==0)
            return 0;

        #TODO: if($aplica>4)
        $aplica=4;

        $ventas = $this->getVentaMercancia($id_usuario, $InicioFecha, $fechaFin,5,$item);
        $costo = $this->issetVar($ventas,"costo",0);
        $monto *= $costo/100;

        $Ganancia = $monto*$aplica;

        return $Ganancia;
    }


    function getValorBonoInversion($parametro,$pagar = false)
    {
        if(!isset($parametro["fecha"]))
            $parametro["fecha"] = date('Y-m-d');

        $valores = $this->getBonoValorNiveles(3);

        $bono = $this->getBono(1);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $fechaInicio=$this->getPeriodoFecha($periodo, "INI", $parametro["fecha"]);
        $fechaFin=$this->getPeriodoFecha($periodo, "FIN", $parametro["fecha"]);

        $id_usuario = $parametro["id_usuario"];
        $id_red = isset($parametro["red"]) ?  $parametro["red"] : 1;

        $calculo = "getGananciaCumplimiento";
        $Ganancia = $this->$calculo($id_usuario,$valores,$id_red,$fechaInicio,$fechaFin);
        $nombreRed = $this->getNombreRed($id_red);
        $extra = $extra = "Cierre de Ciclo de $nombreRed";

        if($pagar&&$Ganancia>0)
            $this->repartirBono(3, $id_usuario, $Ganancia,$extra,$fechaFin);

        return $Ganancia;
    }

    private function getGananciaCumplimiento($id_usuario,$valores,$id_red,$fechaInicio=false,$fechaFin=false)
    {
        if($id_usuario == 1)
            return 0;

        log_message('DEV',"EVALUAR CICLO ($id_usuario)[$id_red]");
        $inicioFecha = $this->getInicioFecha($id_usuario);
        $red_bono = $id_red-1;
        $monto = $valores[$red_bono]->valor;

        if (!$fechaFin)
            $fechaFin = date('Y-m-d');

        list($estimados,$afiliados) = $this->estimarCiclosCompletos($id_usuario, $id_red,  $fechaInicio, $fechaFin);

        $order = "id_red DESC";
        $Afiliado = $this->isLiderenRed ( $id_usuario, $id_red , $order);
        $ciclos = sizeof($Afiliado);
        $aplica = $ciclos *4;
        $noAplica = ($afiliados < $aplica);
        #TODO: $noAplica |= $estimados < $ciclos;

        log_message('DEV',"ciclo actual ($id_usuario)[$id_red] : $ciclos => $afiliados de $aplica");

        if($noAplica)
            return 0;

        $cumple = $this->procesoCiclo($id_usuario,$id_red);

        $inscripcion = $this->getVentaMercancia($id_usuario, $inicioFecha, $fechaFin,5,$red_bono);
        $data = sizeof($inscripcion);
        if (! $cumple && $inscripcion) {
            $monto += $this->issetVar($inscripcion,"costo",0);
            $this->setRedCumplida($id_usuario, $id_red);
            $this->nueva_red($id_usuario,$id_red);
            $this->insertNewRed($id_usuario,$id_red);
        }

        log_message('DEV',"Cumplimiento ($id_usuario)[$id_red] :: M:$monto C:[$cumple] I:$data");
        $Ganancia = $monto;

        return $Ganancia;
    }

    function getValorBonoRangos($parametro,$pagar = false)
    {
        if(!isset($parametro["fecha"]))
            $parametro["fecha"] = date('Y-m-d');

        $valores = $this->getBonoValorNiveles(4);

        $bono = $this->getBono(4);
        $periodo = $this->issetVar($bono,"frecuencia","UNI");

        $fechaInicio = $this->getPeriodoFecha($periodo, "INI", $parametro["fecha"]);
        $fechaFin = $this->getPeriodoFecha($periodo, "FIN", $parametro["fecha"]);

        $id_usuario = $parametro["id_usuario"];

        log_message('DEV', "between: $fechaInicio - $fechaFin");

        $titulo = $this->getRangoAfiliado($id_usuario);

        $isCobro = true;
        if (! $titulo || ! $isCobro)
            return 0;

        $monto = $this->getMontoRangos($id_usuario, $valores, $titulo);

        if($pagar&&$monto>0)
            $this->repartirBono(4, $id_usuario, $monto,"",$fechaFin);

        return $monto;
    }

    private function getRangoAfiliado($id_usuario)
    {
        $query = "SELECT * FROM cross_rango_user
					WHERE
					    id_user = $id_usuario
					    AND estatus = 'ACT'";

        $q = $this->db->query($query);
        $q = $q->result();
        return $q ? $q[0] : false;
    }

    private function getTitulo($param = "", $where = "")
    {
        if ($where)
            $where = " WHERE " . $where;

        $query = "SELECT * FROM cat_titulo
					$where
					ORDER BY orden ASC";

        $q = $this->db->query($query);
        $result = $q->result();

        if (! $result)
            return false;

        if ($param && isset($result[0]->$param))
            $result = $result[0]->$param;
        else if ($param === 0)
            $result = $result[0];

        return $result;
    }

    function getPuntos($id,$where = ""){
        $redes = $this->getRedUsuarioby($id,$where);
        $acumulado = 0;
        foreach ($redes as $key => $red_dato){
            $acumulado+=$red_dato->puntos;
        }
        return $acumulado;
    }

    private function getMontoRangos($id_usuario, $valores, $rango)
    {
        $id_rango = $rango->id_rango;


        $bono_rango= isset($valores[$id_rango]) ? $valores[$id_rango]->valor : $valores[1]->valor;

        $monto = $bono_rango;

        $this->entregar_rango($id_usuario,$id_rango);

        return $monto;
    }

    private function entregar_rango($id_usuario,$rango = 0)
    {
        $query = "UPDATE cross_rango_user 
                    SET id_rango = $rango, entregado = 1 
                    WHERE id_user = $id_usuario";
        $q = $this->db->query($query);
    }

    private function editar_afiliacion($id, $datos,$where = false)
    {
        $datos["id_afiliado"] = $id;

        if($where)
            $datos["where"] = $where;

        return $this->myDataset( "afiliar",$datos,"id_afiliado");
    }

    private function nueva_afiliacion($id, $datos)
    {
        $datos["id_afiliado"] = $id;

        return $this->myDataset( "afiliar",$datos,"id_afiliado",true);
    }

    private function myDataset( $table, $datos, $idtable = "id",$new=false)
    {
        if (! $datos)
            return false;

        $type_query = ($new) ? "insert" : "update";
        $isWhere = isset($datos["where"]);

        if (! $new) {

            $this->db->where($idtable, $datos[$idtable]);

            if ($isWhere) {
                foreach ($datos["where"] as $key => $value) {
                    $this->db->where($key, $value);
                }
                unset($datos["where"]);
            }/* if: $isWhere */
        }/* if: $new */

        try {
            return $this->db->$type_query($table, $datos);
        } catch (Exception $e) {
            log_message('ERROR', "$type_query :: " . json_encode($datos));
            return false;
        }/* try */
    }


    private function renovarCompra($id,$red)
    {   log_message('DEV',"Renovar ($id)[$red]");

        $red_item = $red-1;

        $id_venta = $this->insertVenta($id);
        $monto = $this->insertVentaItem($id, $id_venta,$red_item);
        #@test: 5

        return $red;
    }

    private function descontarBilletera($id, $id_venta, $monto)
    {
        $fecha = date('Y-m-d H:i:s');
        $dato = array(
            "id_user" => $id,
            "tipo" => "SUB",
            "Descripcion" => "Descuento Automático - VENTA # $id_venta",
            "fecha" => $fecha,
            "monto" => $monto
        );

        $this->db->insert('transaccion_billetera', $dato);

        return true;
    }

    private function insertVentaItem($id, $id_venta,$item)
    {
        $query = "INSERT INTO cross_venta_mercancia 
                    SELECT 
                        $id_venta,id,1,costo,0,costo,'',null
                    FROM
                        mercancia
                    WHERE
                    	id = $item";

        $this->db->query($query);

        return $this->getMontoVentaItem($id_venta, $item);
    }

    private function getMontoVentaItem($id_venta, $item)
    {
        $query = "SELECT costo_total FROM cross_venta_mercancia
            		WHERE
                        id_mercancia = $item
                        AND id_venta = $id_venta";

        $q = $this->db->query($query);
        $result = $q->result();

        if(!$result)
            return false;

        $monto = $this->issetVar($result,"costo_total",0);

        return $monto;
    }
    /** ARGS:
     * id:id_usuario f0:fechaInicio f1:fechaFin tp:tipo mc:item WH:where OD:order GP:group
     */
    private function getVentaMercancia($id,$f0,$f1,$tp=false,$mc=false,$WH="",$OD=false,$GP=false)
    {
        if ($tp)
            $WH .= " AND m.id_tipo_mercancia in ($tp)";

        if ($mc)
            $WH .= " AND cvm.id_mercancia in ($mc)";

        if ($GP)
            $GP = "GROUP BY cvm.id_mercancia";
        else
            $GP = "";

        if ($OD)
            $OD = "ORDER BY v.fecha DESC,v.id_venta DESC";
        else
            $OD = "";

        $query = "SELECT *
						FROM
							cross_venta_mercancia cvm,
							mercancia m,
                            items i,
							venta v
						WHERE
                            i.id = m.id
							AND m.id = cvm.id_mercancia
							AND cvm.id_venta = v.id_venta
							$WH
							AND v.id_user in ($id)
							AND v.id_estatus = 'ACT'
							AND v.fecha BETWEEN '$f0' AND '$f1 23:59:59'
						$GP $OD";

        $q = $this->db->query($query);
        $q = $q->result();

        return $q;
    }

    private function insertVenta($id)
    {
        $fecha = date('Y-m-d H:i:s');
        $dato = array(
            "id_user" => $id,
            "id_estatus" => "ACT",
            "id_metodo_pago" => "BANCO",
            "fecha" => $fecha
        );

        $this->db->insert('venta', $dato);
        return $this->db->insert_id();
    }

    function setComision($id,$id_red,$valor,$id_venta)
    {
        $dato = array(
            "id_venta" => $id_venta,
            "id_afiliado" => $id,
            "id_red" => $id_red,
            "puntos" => 0,
            "valor" => $valor
        );

        $this->db->insert("comision",$dato);
    }


    private function setRedCumplida($id_usuario,$id_red)
    {
        $dato = array(
            "estatus" => "DES"
        );

        $this->db->where('id_afiliado', $id_usuario);
        $this->db->where('id_red', $id_red);
        $this->db->update('afiliar', $dato);

        $this->setRedBloqueada($id_usuario, $id_red);
        $this->limpiarAfiliaciones();
    }

    private function getMontoBono($id_usuario,$id_bono,$fechaInicio,$fechaFin)
    {
        $query = "SELECT max(c.valor) valor
                    FROM
                		comision_bono c,
                        comision_bono_historial h
                    WHERE
                		c.id_usuario = $id_usuario
                        AND h.id_bono = c.id_bono
                        AND c.id_bono = $id_bono
                        AND c.id_bono_historial = h.id
                        AND h.fecha between '$fechaInicio' AND '$fechaFin'";

        $q = $this->db->query($query);
        $q = $q->result();

        if(!$q)
            return 0;

        return $this->issetVar($q,"valor",0);
    }

    private function getBonoRedes($id,$nored = 1)
    {
        $query = "SELECT 
                        distinct a.id_red,t.nombre 
                    FROM 
                        afiliar a, tipo_red t
                    WHERE 
                        t.id = a.id_red 
                        AND a.id_afiliado = $id 
                        AND a.id_red > 1 
                        AND a.id_red not in ($nored)";

        $q = $this->db->query($query);
        $q = $q->result();
        return $q;
    }

    function getBonoValorNiveles($id)
    {
        $query = "SELECT * FROM cat_bono_valor_nivel WHERE id_bono = $id ORDER BY nivel asc";
        $q = $this->db->query($query);
        $q = $q->result();
        return $q;
    }

    private function getTipoRed($id)
    {
        $q = $this->db->query("SELECT * FROM tipo_red WHERE id = $id");
        $q = $q->result();
        return $q;
    }

    private function getBonos() {
        $q = $this->db->query("SELECT * FROM bono WHERE estatus = 'ACT'");
        $q = $q->result();
        return $q;
    }

    private function getBono($id)
    {
        $q = $this->db->query("SELECT * FROM bono WHERE id = $id");
        $q = $q->result();
        return $q;
    }

    private function getDirectosBy($id,$nivel,$where = "",$red = 1,$negocio =false)
    {
        $subquery ="AND estatus = 'ACT'" ;

        if($negocio)
            $subquery = "SELECT id_red FROM red 
                        WHERE 
                            lider = $id AND tipo_red = $red $subquery";

        $negocio = ($negocio===0) ? "" : "AND a.red in ($subquery)";

        $query = "SELECT -- imprimir
						distinct a.id_afiliado id,
						a.directo
					FROM
						afiliar a,
						users u
					WHERE
						u.id = a.id_afiliado
						AND a.id_red = $red
						AND a.directo = $id
						$negocio $where";

        $q = $this->db->query($query);
        $datos = $q->result();

        if (! $datos)
            return;

        $nivel --;
        foreach ($datos as $dato) {

            if ($nivel <= 0) {
                $this->setAfiliados($dato->id);
            } else {
                $this->getDirectosBy($dato->id, $nivel, $where, $red);
            }/* if: $nivel */
        }/* foreach: $datos */
    }

    private function getAfiliadosBy ($id,$nivel,$tipo,$where,$padre = false,$red = 1)
    {
        $is = array("DIRECTOS" =>"a.directo","RED"=>"a.debajo_de");

        $query = "SELECT 
						a.id_afiliado id,
						a.directo,a.id rowid
					FROM
						afiliar a,
						users u
					WHERE
						u.id = a.id_afiliado
						AND a.id_red = $red
						AND a.debajo_de = $id
						$negocio $where";

        $q = $this->db->query($query);
        $datos = $q->result();

        if (! $datos)
            return;

        $nivel --;
        foreach ($datos as $dato) {

            if ($nivel <= 0) {

                if ($tipo != "DIRECTOS" || $padre == $dato->directo) {
                    $this->setTempRows($dato->rowid);
                    $this->setAfiliados($dato->id);
                }
            } else {
                $this->getAfiliadosBy($dato->id, $nivel, $tipo, $where, $padre, $red);
            }/* if: $nivel */
        }/* foreach: $datos */
    }

    function setFechaformato($fecha=false,$formato=0)
    {
        $f = array('Y-m-d H:i:s','Y-m-d');

        if(!$fecha)
            $fecha = date($f[0]);

        $fecha = strtotime($fecha);

        if(isset($f[$formato]))
            return date($f[$formato],$fecha);

        try {
            return date($formato,$fecha);
        } catch (Exception $e) {
            log_message('DEV',"fail conversion date :: $formato");
            return date($f[1],$fecha);
        }
    }

    function issetVar($var,$type=false,$novar = false){

        $result = isset($var) ? $var : $novar;

        if($type)
            $result = isset($var[0]->$type) ? $var[0]->$type : $novar;

        if(!isset($var[0]->$type))
            log_message('DEV',"issetVar T:($type) :: ".json_encode($var));

        return $result;
    }

    private function getEmpresa($attrib = 0)
    {
        $q = $this->db->query("SELECT * FROM empresa_multinivel GROUP BY id_tributaria");
        $q = $q->result();

        if(!$q){
            return 0;
        }

        if($attrib === 0){
            return $q;
        }

        return $q[0]->$attrib;
    }

    private function getPeriodoFecha ($frecuencia,$tipo,$fecha = '')
    {
        if (! $fecha)
            $fecha = date('Y-m-d');

        $periodoFecha = array(
            "SEM" => "Semana",
            "QUI" => "Quincena",
            "MES" => "Mes",
            "ANO" => "Ano"
        );

        $tipoFecha = array(
            "INI" => "Inicio",
            "FIN" => "Fin"
        );

        if ($frecuencia == "UNI") {
            return ($tipo == "INI") ? $this->getInicioFecha() : date('Y-m-d');
        }

        if (! isset($periodoFecha[$frecuencia]) || ! isset($tipoFecha[$tipo])) {
            return $fecha;
        }

        $functionFecha = "get" . $tipoFecha[$tipo] . $periodoFecha[$frecuencia];

        return $this->$functionFecha($fecha);
    }

    private function getInicioFecha($id = false)
    {
        $query = "SELECT
                        date_format(MIN(created),'%Y-%m-%d') fecha
                    FROM
                        users";

        if($id)$query.=" WHERE id = $id";

        $q = $this->db->query($query);
        $q =$q->result();

        $year = new DateTime();
        $year->setDate($year->format('Y'), 1, 1);

        if(!$q)
            return date_format($year, 'Y-m-d');

        return $this->issetVar($q,"fecha",date('Y-m-d'));
    }

    private function getFinSemana($date)
    {
        $offset = strtotime($date);

        $dayofweek = date('w',$offset);

        if($dayofweek == 6)
            return $date;

        $date = date("Y-m-d", strtotime('last Saturday', strtotime($date)));

        return $date;
    }

    private function getInicioSemana($date)
    {
        $fecha_sub = new DateTime($date);
        date_sub($fecha_sub, date_interval_create_from_date_string('7 days'));
        $date = date_format($fecha_sub, 'Y-m-d');

        $offset = strtotime($date);

        $dayofweek = date('w',$offset);

        if($dayofweek == 0)
            return $date;

        $date = date("Y-m-d", strtotime('last Sunday', strtotime($date)));

        return $date;
    }

    private function getInicioQuincena($date)
    {
        $dateAux = new DateTime();

        $dayTime = $this->setFechaformato($date,"d");
        $monthTime = $this->setFechaformato($date,"m");
        $yearTime = $this->setFechaformato($date,"Y");
        $isHalfMonth = ($dayTime<=15);

        $dayTime = ($isHalfMonth) ? 1 : 16;

        $dateAux->setDate($yearTime,$monthTime,$dayTime);

        $date = date_format($dateAux, 'Y-m-d');

        return $date;
    }

    private function getFinQuincena($date) {

        $dateAux = new DateTime();

        $dayTime = $this->setFechaformato($date,"d");
        $monthTime = $this->setFechaformato($date,"m");
        $yearTime = $this->setFechaformato($date,"Y");
        $isHalfMonth = ($dayTime<=15);

        $date = $this->setFechaformato($date,"Y-m-t");

        if($isHalfMonth){
            $dateAux->setDate($yearTime,$monthTime, 15);
            $date = date_format($dateAux, 'Y-m-d');
        }

        return $date;
    }

    private function getInicioMes($date) {
        $dateAux = new DateTime();
        $monthTime = $this->setFechaformato($date,"m");
        $yearTime = $this->setFechaformato($date,"Y");
        $dateAux->setDate($yearTime,$monthTime, 1);
        return date_format($dateAux, 'Y-m-d');
    }

    private function getFinMes($date) {
        return $this->setFechaformato($date,"Y-m-t");
    }

    private function getInicioAno($date) {
        $year = new DateTime($date);
        $year->setDate($year->format('Y'), 1, 1);
        return date_format($year, 'Y-m-d');
    }

    private function getFinAno($date) {
        $year = new DateTime($date);
        $year->setDate($year->format('Y'), 12, 31);
        return date_format($year, 'Y-m-d');
    }

    private function getAnyTime($date, $time = '1 month',$add= false)
    {
        $fecha_sub = new DateTime($date);
        if($add)
            date_add($fecha_sub, date_interval_create_from_date_string("$time"));
        else
            date_sub($fecha_sub, date_interval_create_from_date_string("$time"));

        $date = date_format($fecha_sub, 'Y-m-d');

        return $date;
    }

    private function getNextTime($date, $time = 'month')
    {
        $fecha_sub = new DateTime($date);
        date_add($fecha_sub, date_interval_create_from_date_string("1 $time"));
        $date = date_format($fecha_sub, 'Y-m-d');

        return $date;
    }

    private function getLastTime($date, $time = 'month')
    {
        $fecha_sub = new DateTime($date);
        date_sub($fecha_sub, date_interval_create_from_date_string("1 $time"));
        $date = date_format($fecha_sub, 'Y-m-d');

        return $date;
    }

    function reporte_activos ($fechaInicio = "",$fechaFin = "",$id = 2,$status = true)
    {
        $this->setFechaInicio($fechaInicio);
        $this->setFechaFin($fechaFin);

        $red = $this->getTipoRedes();
        $id_red = $this->issetVar($red,"id",1);
        $profundidad = $this->issetVar($red,"profundidad",0);

        $afiliadosEnLaRed=array();
        $afiliadosActivos=array();

        $usuario=new $this->afiliado;
        $usuario->getAfiliadosDebajoDe($id,$id_red,"RED",0,$profundidad);
        $afiliadosEnLaRed = $usuario->getIdAfiliadosRed();

        foreach ($afiliadosEnLaRed as $afiliado){

            $Activado = $this->isActivedAfiliado($afiliado);

            if($Activado==$status){
                $query = "SELECT
							 	a.id,
							 	a.username usuario,
							 	b.nombre nombre,
							 	b.apellido apellido,
							 	a.email
							FROM
								users a,
								user_profiles b
							WHERE
								a.id=b.user_id
								AND b.id_tipo_usuario=2
								AND a.id=$afiliado";
                $q=$this->db->query($query);

                $afiliado=$q->result();
                array_push($afiliadosActivos,$afiliado);
            }/* if: $Activado */
        }/* foreach: $afiliadosEnLaRed */

        return $afiliadosActivos;
    }

    private function getTipoRedes()
    {
        $q = $this->db->query('SELECT * FROM tipo_red');
        $red = $q->result();
        return $q;
    }

    /** <? TEST ?>
     *	last time : 2017-08-05
     *	recent author : qcmarcel
     *  #TEST: ($parametro){
     */

    private function test() {
        return;
        $where = " AND u.created BETWEEN '$fechaInicio' AND '$fechaFin 23:59:59'";
        foreach ($afiliados[$lvl] as $afiliado){
            $activoAfiliado = $this->isActivedAfiliado($afiliado);
        }
        $this->descontarBilleteraCiclo($id, $id_venta, $monto);
        $negocio = isset($Afiliado[0]->red) ? $Afiliado[0]->red : false;
        if ($negocio==$negocioSponsor) return array($sponsor);
        $isMax = ($negocio<$negocioSponsor);
        $subquery ="AND lider = $padre ";
    }


}
