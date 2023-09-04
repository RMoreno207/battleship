# battleship
Battleship game with PHP without SESSIONS or db. 1 player shooting in a random board

Tarea del Tema uno del módulo Desarrollo Web en Entorno Servidor.
Descripción de la tarea:
## Crea una aplicación web con HTML, CSS y PHP 8

Se trata de programar una versión simplificada del conocido juego de "Hundir la flota":

- Trataremos de destruir en el menor número de turnos posible los barcos de nuestro contrincante (el servidor).

- La página de inicio, en `inicio.php`, cargará un tablero de 10x10 con los barcos ocultos y situados de manera aleatoria. Los barcos no pueden situarse en posiciones adyacentes.

  - La aleatoriedad implica que pueden estar situados en cualquier casilla y en cualquier orientación (vertical u horizontal), siempre que las dimensiones del tablero lo permitan.

  - Los barcos son:
    - 1 portaviones de 4 casillas de longitud
    - 2 submarinos de 3 casillas de longitud
    - 1 acorazado de 3 casillas de longitud
    - 3 destructores de 2 casillas de longitud
    - 2 fragatas de 1 casilla de longitud

- Una vez cargada en el cliente `inicio.php`, podrá elegir una posición del tablero en la que realizar "el cañonazo". El formulario correspondiente se enviará a `jugando.php`. Desde dicho script se debe procesar el desarrollo del juego, y gestionar si procede el final de la partida. Por tanto se mandará al cliente un tablero actualizado, con un formulario para seguir jugando, así como el número de turnos que lleva. También se dará la opción de volver a cargar el juego (es decir, de volver a `inicio.php`).

