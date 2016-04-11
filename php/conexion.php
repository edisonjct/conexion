<?php


switch ($base = $_GET['IDB']){
    case '01':
        $db = 'mrbooks';
        $nombreb = 'MR BOOKS - CDI';
        break;
    case '02':
        $db = 'mrbookweb';
        $nombreb = 'MR BOOKS - WEB';
        break;
    case '03':
        $db = 'mrbookjardin';
        $nombreb = 'MR BOOKS - JARDIN';
        break;
    case '04':
        $db = 'mrbooksol';
        $nombreb = 'MR BOOKS - SOL';
        break;
    case '05':
        $db = 'mrbookcondado';
        $nombreb = 'MR BOOKS - CONDADO';
        break;
    case '06':
        $db = 'mrbooktumbaco';
        $nombreb = 'MR BOOKS - SCALA';
        break;
    case '07':
        $db = 'mrbookvill';
        $nombreb = 'MR BOOKS - VILLAGE';
        break;
    case '08':
        $db = 'mrbooksaldos';
        $nombreb = 'MR BOOKS - SALDOS';
        break;
    case '09':
        $db = 'mrbookeventos';
        $nombreb = 'MR BOOKS - EVENTOS';
        break;    
    case '10':
        $db = 'mrbookcuenca';
        $nombreb = 'MR BOOKS ';
        break; 
    case '11':
        $db = 'mrbookkiwy';
        $nombreb = 'MR BOOKS - KIWY';
        break; 
    case '12':
        $db = 'mrbookreservados';
        $nombreb = 'MR BOOKS';
        break; 
    case '13':
        $db = 'mrbookcumbaya';
        $nombreb = 'LIBRIMUNDI - CUMBAYA';
        break; 
    case '14':
        $db = 'mrbooksmarino';
        $nombreb = 'LIBRIMUNDI - SAN MARINO';
        break; 
    case '15':
        $db = 'mrbooksluis';
        $nombreb = 'LIBRIMUNDI - SAN LUIS';
        break; 
    case '16':
        $db = 'mrbookquicentro';
        $nombreb = 'LIBRIMUNDI - QUICENTRO';
        break; 
    case '17':
        $db = 'mrbookjlmera';
        $nombreb = 'LIBRIMUNDI - JUAN LEON MERA';
        break; 
}
$conexion = mysql_connect('100.100.20.100', 'root', '');
mysql_select_db($db, $conexion);
