<?php
include '../php/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $nombreb; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">         
        <link rel="icon" type="image/png" href="../recursos/icono.ico"/>        
        <script src="../js/jquery.js"></script>
        <script src="../js/myjava.js"></script>
        <script src="../js/bootstrap-select.js"></script>        
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-select.css">        
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    </head>
    <body>
        <div class="container">    
            <form class="form-inline" role="form" method="GET">
                <center>      
                    <h2><?php echo $nombreb; ?></h2>
                    <input class="hide" type="text" required="required" readonly="readonly" id="IDB" value=<?php echo $base; ?> />
                    <div class="form-group">                        
                        <select required="required" id="cb-condicion" class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-toggle="tooltip" title="Condicion de Pago">
                            <?php
                            $query = mysql_query("SELECT t.codtab AS codigo, t.nomtab AS nombre FROM maetab t WHERE t.numtab = '72' AND t.ad5tab = '0' AND t.codtab <> ''");
                            if (mysql_num_rows($query) > 0) {
                                while ($row = mysql_fetch_array($query)) {
                                    echo "<option value='" . $row['codigo'] . "'>" . $row['nombre'] . "</option>\n";
                                }
                            }
                            ?>                                                                    
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>Fechas</label>
                        <input type="date" class="form-control" id="bd-desde"/>
                        <input type="date" class="form-control" id="bd-hasta"/>
                    </div>        
                    <button id="bt-creditosemp" class="btn btn-primary">Buscar</button>        
                    <a target="_blank" href="javascript:reporteF();" class="btn btn-success">Excel</a>
                </center>
            </form>      
            <br>
            <div class="table-responsive" id="agrega-registros"></div>
        </div>        
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>