<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de todos</title>
</head>
<form method="post" action="#">
<input type="text" name="buscar" required="required">
<input type="submit" name="btn_buscar" value="Buscar">
</form>
<body>
    <?php
include_once "./entity/Usuario.class.php";
include_once "./pesistance/MySQLPDO.class.php";

    if ( isset($_POST['btn_buscar'])) {
        MySQLPDO::connect();
        $buscar = $_POST ['buscar'];
        $result = MySQLPDO::buscarUsu($buscar);
    if (sizeof($result) !=0){
    ?>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
        </tr>
<?php
foreach($result as $calculo){
    extract($calculo);
      
?>
        <tr>
            <td><a href="modificar.php"><?php echo $id; ?></a></td>
            <td><?php echo $n1?></td>
            <td><?php echo $n2?></td>
            <td><?php $avg = ($n1 + $n2)/2; echo $avg?></td>
            <td>
                <form action="borrar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" value="Borrar" name="btn_borrar">
                </form>
            </td>
        </tr>
    </table>
    <?php
}  
} else {
    echo "Error no encontrado";
}
/*
for (i=0; $i<sizeof($resultado),i++){
$fila=resultado[$i]
}
*/
    }
    ?>
</body>
</html>