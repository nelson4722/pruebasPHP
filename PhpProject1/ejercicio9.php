<html>
    <head>
        <title>POO in PHP</title>
        <?php include("phpClase.php");?>
    </head>
    <body>
        <?php
        $persona1= new persona();
        $persona2= new persona();
        echo "El nombre por defecto es ";$persona1->imprimir();
        $persona1->set_nombre("nelson");
        $persona2->set_nombre("christian");
        echo "El nombre de la persona 1 es ";$persona1->imprimir();
        echo "El nombre de la persona 2 es ";$persona2->imprimir();    
        ?>
    </body>
</html>
