<?php
session_start();
require "conexion.php";
date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);
$total_botellones = 0;
$total_litros = 0;

if(isset($submit)){
    $query = "SELECT * FROM botellones";
    $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
    $html = '';
    $html .= '
        <h2 align="center">Reporte</h2>
        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Numero de Botellones</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Litros llenado por botellones</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Total de litros llenados</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Zona del pais</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Fecha y Hora</th>
            </tr> 
            ';
            foreach ($result as $row){
            $pdo_cliente = $conectar->prepare ("SELECT * FROM clientes where cedula = $row[cliente_botellon]");
            $pdo_cliente->execute();
            $cliente = $pdo_cliente->fetchAll();
            foreach($cliente as $row_2){
                $pdo_admin = $conectar->prepare ("SELECT * FROM admins where cedula = $row[admin_botellon]");
                $pdo_admin->execute();
                $admin = $pdo_admin->fetchAll();
                foreach($admin as $row_3){

            $html .='
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row["cantidad_botellones"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row["litros_por_botellon"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row["total_litros_botellones"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row_2["nombre"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row_3["nombre"].'</td>
            </tr>
        ';
        $total_botellones = $total_botellones + $row['cantidad_botellones'];
        $total_litros = $total_litros + $row['total_litros_botellones'];


    }}}
    $html .= '</table>';
    $html .='
    <br>
    <p>Total de botellones: '.$total_botellones.'</p>
    <p>Total de litros: '.$total_litros.'</p>
    ';
    $dompdf = NEW DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4","landscape");
    $dompdf->render();
    $canvas = $dompdf->get_canvas(); 
    $canvas->page_text(400, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}",null, 13, array(0,0,0)); 
    $dompdf->stream("reporte.pdf");

}
?>