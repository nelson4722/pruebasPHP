<?php 
class DB{
	var $conect;
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
        var $Puerto;
	function DB(){
		$this->BaseDatos = "test";
		$this->Servidor = "localhost";
		$this->Usuario = "root";
		$this->Clave = "root";
                $this->Puerto = "3306";
	}

	 function conectar() {          
             $con = mysqli_connect('localhost', 'root', 'root', 'clinica', '3306');
                if (!$con) {
                  echo('Could not connect to MySQL: ' . mysqli_connect_error());
                  exit();
                }
                else
                {
                    //echo('CONECTADO');
                }
		return $this->conect=$con;	
	}
}
?>
