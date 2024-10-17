 
 <?

    $edad = 25;
    //Números de punto flotante (float): Representan números con parte decimal. Ejemplo: 
    $precio = 19.99;
    //Cadenas (string): Representan texto. Puedes usar comillas simples o comillas dobles para definir cadenas. Ejemplos: 
    $nombre = 'Juan';
    $saludo = "Hola, $nombre";
    //Booleanos (bool): Representan valores verdaderos o falsos. Ejemplo: 
    $activo = true;
    $valido = false;
    #Arrays: Representan colecciones de datos. Pueden ser indexados numéricamente o asociativos. Ejemplo de un array indexado: 

    $colores = ['rojo', 'verde', 'azul'];
    #Ejemplo de un array asociativo: 

    $persona = [
        'nombre' => 'María',
        'edad' => 30
    ];

    #NULL: Representa la ausencia de valor. Se utiliza cuando una variable no tiene un valor asignado. Ejemplo: 
    $sinValor = null;
    #constante  
    define("PI", 3.14159);
    #operadores
    $resultado = 5 + 3;
    $numero = 5;
    $numero++; // $numero contendrá 6 después de esta operación
    // Operaciones relacionales
    $a = 5;
    $b = "5";
    $resultado = $a == $b; // $resultado contendrá true
    $a = 5;
    $b = "5";
    $resultado = $a === $b; // $resultado contendrá false
    $a = 5;
    $b = "5";
    $resultado = $a != $b; // $resultado contendrá false
    $a = 5;
    $b = "5";
    $resultado = $a !== $b; // $resultado contendrá true
    $a = 10;
    $b = 10;
    $resultado = $a >= $b; // $resultado contendrá true

    #uso de operadores logicos 
    $expresion1 = true;
    $expresion2 = false;

    $resultado = $expresion1 && $expresion2; // $resultado contendrá false
    $expresion1 = true;
    $expresion2 = false;

    $resultado = $expresion1 || $expresion2; // $resultado contendrá true
    $expresion = true;

    $resultado = !$expresion; // $resultado contendrá false
    
    $expresion1 = true;
    $expresion2 = false;
    $expresion3 = true;

    $resultado = ($expresion1 || $expresion2) && $expresion3; // $resultado contendrá true
