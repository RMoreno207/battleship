<?php
if (isset($_POST)) {
    $dataPosted = unserialize($_POST['datas']);
    $grid2 = $dataPosted;

    //Tablero 2
    echo "<h1>You Lose!!!</h1>";
    echo "<h3>La proxima vez seguro que ganas!</h3>";
    echo "<table border=1 width=700px height=700px align=center>";
    echo "<tr>";
    for ($i = 0; $i <= 10; $i++) {
        if ($i == 0) {
            echo "<th></th>";
        } else {
            echo "<th>$i</th>";
        }
    }
    echo "</tr>";
    foreach ($grid2 as $y => $valor) { //Crea el eje Y
        echo "<tr>";
        for ($x = 0; $x <= 10; $x++) { //Crea el eje X (horizontal)
            if ($x == 0) {
                echo "<td>$y</td>";
            } else {
                $coordinates = $grid2[$y][$x];
                echo "<td>
                <form action='#' method='POST' style='margin-block-end:0em'>
                <input style='width:70px; height:70px; font-size:xx-small' type='submit' value='$coordinates'>
                </form>
                </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table><br/><hr/>
    <a href='./index.php'><button style='width:100%; height:50px'>Comenzar de nuevo</button></a>";
    echo "<br/><br/><a href='../index.html'>Volver</a>";
}
?>