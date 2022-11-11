<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Hundir la flota</title>
</head>

<body>
     <!-- Comienz el cogido PHP  -->
     <?php
     // creamos la matriz del tablero a la que se le añadiran los barcos
     $grid = array(
          "A" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "B" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "C" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "D" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "E" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "F" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "G" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "H" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "I" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_"),
          "J" => array("0", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_")
     );

     // creamos la matriz del tablero que será visible
     $gridColors = array(
          "A" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "B" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "C" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "D" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "E" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "F" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "G" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "H" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "I" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey"),
          "J" => array("0", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey", "Grey")
     );


     //Tamaño de barcos
     $ships = array(
          'Portaviones' => 4,
          'Submarino_1' => 3,
          'Submarino_2' => 3,
          'Acorazado' => 3,
          'Destructor_1' => 2,
          'Destructor_2' => 2,
          'Destructor_3' => 2,
          'Fragata_1' => 1,
          'Fragata_2' => 1
     );


     //Contador de barcos
     $shipsCounter = array(
          "Portaviones" => 4,
          "Submarino_1" => 3,
          "Submarino_2" => 3,
          "Acorazado" => 3,
          "Destructor_1" => 2,
          "Destructor_2" => 2,
          "Destructor_3" => 2,
          "Fragata_1" => 1,
          "Fragata_2" => 1,
          "total" => 21,
          "turno" => 1
     );


     //Coordenadas temporales de cada barco
     $coordinates = array(
          "shipY" => array(""),
          "shipX" => array(""),
          "leftY" => array(""),
          "leftX" => array(""),
          "rightY" => array(""),
          "rightX" => array(""),
          "upY" => array(""),
          "upX" => array(""),
          "downY" => array(""),
          "downX" => array("")
     );


     //Crear las coordenadas aleatorias de cada barco
     function coordinates($length, $orientation, $name)
     {
          global $coordinates;

          if ($orientation == 1) { //Vertical
     
               // generar letra aleatoria del eje Y
               $permitted_chars = 'ABCDEFGHIJ';
               $positionNumber = random_int(0, 10 - $length);
               $y = $permitted_chars[$positionNumber];

               //Generar numero aleatorio para el eje X
               $x = random_int(1, 10);

               //Añadir coordenadas barco a array de coordenadas temporal
               for ($i = 0; $i < $length; $i++) {
                    $coordinates['shipY'][$i] = $permitted_chars[$positionNumber + $i];
                    $coordinates['shipX'][$i] = $x;
               }

               //añadir coordenadas de posiciones adyacentes a la izquierda
               if ($x > 1) {
                    for ($i = 0; $i < $length; $i++) {
                         $coordinates['leftY'][$i] = $permitted_chars[$positionNumber + $i];
                         $coordinates['leftX'][$i] = $x - 1;
                    }
               }

               //añadir coordenadas de posiciones adyacentes a la derecha
               if ($x < 10) {
                    for ($i = 0; $i < $length; $i++) {
                         $coordinates['rightY'][$i] = $permitted_chars[$positionNumber + $i];
                         $coordinates['rightX'][$i] = $x + 1;
                    }
               }

               //añadir coordenadas de posiciones adyacentes arriba
               if ($positionNumber > 0) {
                    $coordinates['upY'][0] = $permitted_chars[$positionNumber - 1];
                    $coordinates['upX'][0] = $x;
               }

               //añadir coordenadas de posiciones adyacentes abajo
               if ($positionNumber < 9 - $length) {
                    $coordinates['downY'][0] = $permitted_chars[$positionNumber + $length];
                    $coordinates['downX'][0] = $x;
               }

          } else { //Horizontal
     
               // generar letra aleatoria del eje Y
               $permitted_chars = 'ABCDEFGHIJ';
               $positionNumber = random_int(0, 9);
               $y = $permitted_chars[$positionNumber];

               //Generar numero aleatorio para el eje X
               $x = random_int(1, 10 - $length);

               //Añadir coordenadas barco a array de coordenadas temporal
               for ($i = 0; $i < $length; $i++) {
                    $coordinates['shipY'][$i] = $y;
                    $coordinates['shipX'][$i] = $x + $i;
               }

               //añadir coordenadas de posiciones adyacentes a la izquierda
               if ($x > 1) {
                    $coordinates['leftY'][0] = $y;
                    $coordinates['leftX'][0] = $x - 1;
               }

               //añadir coordenadas de posiciones adyacentes a la derecha
               if ($x < 10 - $length) {
                    $coordinates['rightY'][0] = $y;
                    $coordinates['rightX'][0] = $x + $length;
               }

               //añadir coordenadas de posiciones adyacentes arriba
               if ($positionNumber > 0) {
                    for ($i = 0; $i < $length; $i++) {
                         $coordinates['upY'][$i] = $permitted_chars[$positionNumber - 1];
                         $coordinates['upX'][$i] = $x + $i;
                    }
               }

               //añadir coordenadas de posiciones adyacentes abajo
               if ($positionNumber < 9) {
                    for ($i = 0; $i < $length; $i++) {
                         $coordinates['downY'][$i] = $permitted_chars[$positionNumber + 1];
                         $coordinates['downX'][$i] = $x + $i;
                    }
               }
          }
     }
     ;


     // funcion para crear barcos en posiciones aleatorias
     function setShips()
     {
          global $grid;
          global $coordinates;
          global $ships;

          //nombre y tamaño del barco
          foreach ($ships as $name => $size) {
               $orientation = random_int(1, 2);
               $length = $size;
               $clearShip = false;
               $clearLeft = false;
               $clearRight = false;
               $clearUp = false;
               $clearDown = false;
               $clearAll = false;
               $complete = false;

               //Comprobar si hay otros barcos en esascoordenadas
               while ($clearAll == false) {
                    global $complete;
                    global $clearShip;
                    global $clearLeft;
                    global $clearRight;
                    global $clearUp;
                    global $clearDown;
                    global $clearAll;
                    $clearShip = false;
                    $clearLeft = false;
                    $clearRight = false;
                    $clearUp = false;
                    $clearDown = false;
                    $clearAll = false;
                    $complete = false;

                    //Ejecutamos la funcion para obtener coordenadas
                    coordinates($length, $orientation, $name);

                    //Comprobamos si en las coordenadas del BARCO existe otro barco
                    for ($i = 0; $i < $length; $i++) {
                         if ($grid[$coordinates['shipY'][$i]][$coordinates['shipX'][$i]] != "_") {
                              $clearShip = false;
                              break;
                         } else {
                              $clearShip = true;
                         }
                    }

                    //Comprobamos si en las coordenadas adyacentes IZQUIERDA existe otro barco
                    if ($coordinates['shipX'][0] > 1) {
                         if ($orientation == 1) { //Vertical
                              for ($i = 0; $i < $length; $i++) {
                                   if ($grid[$coordinates['leftY'][$i]][$coordinates['leftX'][$i]] != "_") {
                                        $clearLeft = false;
                                        break;
                                   } else {
                                        $clearLeft = true;
                                   }
                              }
                         } else { //Horizontal
                              if ($grid[$coordinates['leftY'][0]][$coordinates['leftX'][0]] != "_") {
                                   $clearLeft = false;
                              } else {
                                   $clearLeft = true;
                              }
                         }
                    } else {
                         $clearLeft = true;
                    }

                    //Comprobamos si en las coordenadas adyacentes DERECHA existe otro barco
                    if ($coordinates['shipX'][0] < 10) {
                         if ($orientation == 1) { //Vertical
                              for ($i = 0; $i < $length; $i++) {
                                   if ($grid[$coordinates['rightY'][$i]][$coordinates['rightX'][$i]] != "_") {
                                        $clearRight = false;
                                        break;
                                   } else {
                                        $clearRight = true;
                                   }
                              }
                         } else { //Horizontal
                              if ($grid[$coordinates['rightY'][0]][$coordinates['rightX'][0]] != "_") {
                                   $clearRight = false;
                              } else {
                                   $clearRight = true;
                              }
                         }
                    } else {
                         $clearRight = true;
                    }

                    //Comprobamos si en las coordenadas adyacentes ARRIBA existe otro barco
                    if ($coordinates['shipY'][0] != "A") {
                         if ($orientation == 1) { //Vertical
                              if ($grid[$coordinates['upY'][0]][$coordinates['upX'][0]] != "_") {
                                   $clearUp = false;
                              } else {
                                   $clearUp = true;
                              }
                         } else { //Horizontal
                              for ($i = 0; $i < $length; $i++) {
                                   if ($grid[$coordinates['upY'][$i]][$coordinates['upX'][$i]] != "_") {
                                        $clearUp = false;
                                        break;
                                   } else {
                                        $clearUp = true;
                                   }
                              }
                         }
                    } else {
                         $clearUp = true;
                    }

                    //Comprobamos si en las coordenadas adyacentes ABAJO existe otro barco
                    if ($coordinates['shipY'][$length - 1] != "J") {
                         if ($orientation == 1) { //Vertical
                              if ($grid[$coordinates['downY'][0]][$coordinates['downX'][0]] != "_") {
                                   $clearDown = false;
                              } else {
                                   $clearDown = true;
                              }
                         } else { //Horizontal
                              for ($i = 0; $i < $length; $i++) {
                                   if ($grid[$coordinates['downY'][$i]][$coordinates['downX'][$i]] != "_") {
                                        $clearDown = false;
                                        break;
                                   } else {
                                        $clearDown = true;
                                   }
                              }
                         }
                    } else {
                         $clearDown = true;
                    }

                    if ($clearShip && $clearLeft && $clearRight && $clearUp && $clearDown) {
                         $clearAll = true;
                    }
               }

               //Si no hay otros barcos se insertan las coordenadas en el tablero
               if ($clearAll == true) {
                    for ($i = 0; $i < $length; $i++) {

                         $grid[$coordinates['shipY'][$i]][$coordinates['shipX'][$i]] = $name;
                    }
               }
          }
     }
     setShips();

     //Tablero-------------------------------------------
     // contador de turnos
     echo "<div style='text-align: center;'><h3>Bienvenido a hundir la flota</h3>
     <p>Tienes 70 turnos para hundir los barcos del enemigo</p>
     <h1>Turno: 1</h1>
     </div>
     <table border=1 width=700px height=700px align=center>
     <tr>";
     for ($i = 0; $i <= 10; $i++) {
          if ($i == 0) {
               echo "<th></th>";
          } else {
               echo "<th>$i</th>";
          }
     }
     echo "</tr>";
     foreach ($grid as $y => $valor) { //Crea el eje Y
          echo "<tr>";
          for ($x = 0; $x <= 10; $x++) { //Crea el eje X (horizontal)
               if ($x == 0) {
                    echo "<td>$y</td>";
               } else {
                    $coordinates = $grid[$y][$x];
                    $color = $gridColors[$y][$x];
                    $gridSerialized = serialize($grid);
                    $shipsCountSerialized = serialize($shipsCounter);
                    $gridColorsSerialized = serialize($gridColors);

                    echo "<td>
                    <form action='jugando.php' method='POST' style='margin-block-end:0em'>
                    <input type='hidden' value='$gridSerialized' name='datas'>
                    <input type='hidden' value='$shipsCountSerialized' name='shipsCounter'>
                    <input type='hidden' value='$gridColorsSerialized' name='gridColors'>
                    <input type='hidden' value='$y' name='shootY'>
                    <input type='hidden' value='$x' name='shootX'>
                    <input type='hidden' value='$coordinates' name='shipName'>
                    <input style='width:70px; height:70px; font-size:xx-small; background-color:$color;' type='submit' value=' '>
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

     ?>
     <!-- acaba el codigo PHP -->
     <br />
     <a href="../index.html">Volver</a>
</body>

</html>