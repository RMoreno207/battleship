<?php
if (isset($_POST)) {
    $dataPosted = unserialize($_POST['datas']);
    $shipsCounterPosted = unserialize($_POST['shipsCounter']);
    $gridColorsPosted = unserialize($_POST['gridColors']);
    $grid2 = $dataPosted;
    $gridColors2 = $gridColorsPosted;
    $shipsCounter2 = $shipsCounterPosted;
    $shootY = $_POST['shootY'];
    $shootX = $_POST['shootX'];
    $shipName = $_POST['shipName'];

    //Comprobamos si hay barcos en las coordenadas del disparo en el tablero
    if ($grid2[$shootY][$shootX] === "_") {
        $grid2[$shootY][$shootX] = "AGUA";
        $gridColors2[$shootY][$shootX] = "Blue";
    } else {
        //Si el usuario dispara otra vez en las mismas coordenadas
        if (
            $grid2[$shootY][$shootX] == "AGUA"
            || $grid2[$shootY][$shootX] == "Hundido!!"
            || $grid2[$shootY][$shootX] == "BOOM!!"
        ) {
            $shipsCounter2["turno"]--;
        } else if ($grid2[$shootY][$shootX] == $shipName) {
            if ($shipsCounter2[$shipName] == 1) {
                $grid2[$shootY][$shootX] = "Hundido!!";
                $gridColors2[$shootY][$shootX] = "Red";
                $shipsCounter2[$shipName]--;
                $shipsCounter2['total']--;
            } else {
                $grid2[$shootY][$shootX] = "BOOM!!";
                $gridColors2[$shootY][$shootX] = "Red";
                $shipsCounter2[$shipName]--;
                $shipsCounter2['total']--;
            }
            if ($shipsCounter2['total'] == 0) {
                echo "<h1>You Win!!</h1>";
                foreach ($gridColors2 as $y => $valor) {
                    for ($x = 0; $x <= 10; $x++) {
                        $gridColors2[$y][$x] = "Green";
                    }
                }
            }
        }
    }
    if ($shipsCounter2['turno'] == 700) {
        echo "<h1>You Loose!!</h1>";
        foreach ($gridColors2 as $y => $valor) {
            for ($x = 0; $x <= 10; $x++) {
                $gridColors2[$y][$x] = "Red";
            }
        }
    }
    $shipsCounter2["turno"]++;

    //Tablero 2
    echo "<div style='text-align: center;'><h3>Bienvenido a hundir la flota</h3>
    <p>Tienes 70 turnos para hundir los barcos del enemigo</p>";
    echo "<h1>Turno: ", $shipsCounter2["turno"], "</h1></div>";
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
                echo "<td style='width:20px;'>$y</td>";
            } else {
                $coordinates = $grid2[$y][$x];
                $gridSerialized = serialize($grid2);
                $shipsCountSerialized = serialize($shipsCounter2);
                $color = $gridColors2[$y][$x];
                $gridColorsSerialized = serialize($gridColors2);

                echo "<td>
                <form action=" . $_SERVER['PHP_SELF'] . " method='POST' style='margin-block-end:0em'>
                <input type='hidden' value='$gridSerialized' name='datas'>
                <input type='hidden' value='$shipsCountSerialized' name='shipsCounter'>
                <input type='hidden' value='$gridColorsSerialized' name='gridColors'>
                <input type='hidden' value='$y' name='shootY'>
                <input type='hidden' value='$x' name='shootX'>
                <input type='hidden' value='$coordinates' name='shipName'>
                <input style='width:70px; height:70px; font-size:xx-small; background-color:$color;' type='submit' value='&nbsp;'>
        </form>
                </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table><br/><hr/>
    <a href='./inicio.php'><button style='width:100%; height:50px'>Comenzar de nuevo</button></a>
    <form action='solucion.php' method='POST'>
    <input type='hidden' value='$gridSerialized' name='datas'>
    <br/><input style='width:100%; height:50px' type='submit' value='Rendirse y ver barcos'>
</form>";

    echo "<p>Impactos a los barcos restantes y más información</p>";
    echo '<pre>', print_r($shipsCounter2), '</pre>';
    echo " <br/><a href='../index.html'>Volver</a>";

}
?>