<?php
class persona
{
    private $nombre;
    function __persona()
    {
        $this->nombre="Nulo";
    }
    function __personaP($n)
    {
        $this->nombre=$n;
    }
    public function set_nombre($nuevo_nombre)
    {
        $this->nombre=$nuevo_nombre;
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function imprimir()
    {
        echo $this->nombre."<br>";
    }
}