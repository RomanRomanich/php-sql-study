<?php

$myZoo = [
    'africa' => ['Slon', 'Lev'],
    'australiya' => ['Kenguru', 'Sobaka dingo'],
    'europe' => ['Bear', 'Olen dorojniy']];
    
    
    
#var_dump ($myZoo);

echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
#print_r($myZoo);



foreach($myZoo as $c => $z) {
    $contry = $c;
#    echo $contry . '<br>';
    foreach($z as $zver) {
#    echo $zver . '<br>';
        if(stristr($zver, ' ')) {
        $newZoo[] = $zver;
        }
    }
}


print_r($newZoo);

foreach($newZoo as $zver) {
    


}

?>
