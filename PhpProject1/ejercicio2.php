<?php
for ($i=0;$i<30;$i++)
{
    $cuadrado=$i*$i;
    if($cuadrado%2!=0){
        echo "el cuadado de ".($i+1)." es igual a ".($i+1)*($i+1)." y es par<br/>";   
    }else{
        echo "el cuadado de ".($i+1)." es igual a ".($i+1)*($i+1)." y es impar<br/>";
    }  
}
?>