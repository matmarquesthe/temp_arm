<?php
require_once('db.php');
$slq = "SELECT * FROM contatos";
$stmt = mysqli_query($conn, $slq);
$data = [];
$i = 0;
while($row = mysqli_fetch_assoc($stmt)){
    $data[$i]['wea_id'] = $row['wea_id'];
    $data[$i]['wea_date'] = $row['wea_date'];
    $data[$i]['wea_temp'] = $row['wea_temp'];
    $data[$i]['wea_humid'] = $row['wea_humid'];
    $data[$i]['ponto'] = $row['ponto'];
    $i++;
}
require_once('Export.php');
$export = new Export();

if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    $export->excel('Temperaturas Armazem', $_GET['fileName'], $data);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exportando dados com PHP</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    </head>
    <body>

    <div class="container">
        <div class="row">
            <h1>Temperaturas Armazém</h1>
        </div>
        <div class="row">
            <buttom class="dropdown-button btn right" data-activates="btn-export">Exportar</buttom>
            <ul id="btn-export" class="dropdown-content" style="margin-top: 40px;">
                <li><a href="?export=excel&&fileName=contatos">Excel</a></li>
            </ul>
        </div>
        <div class="row">
            <table class="bordered highlight">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Data/Hora</th>
                        <th>Temperatura</th>
                        <th>Umidade</th>
                        <th>Ponto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <td><?php echo $row['wea_id']; ?></td>
                            <td><?php echo $row['wea_date']; ?></td>
                            <td><?php echo $row['wea_temp']; ?></td>
                            <td><?php echo $row['wea_humid']; ?></td>
                            <td><?php echo $row['ponto']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    </body>
</html>
