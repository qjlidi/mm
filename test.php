<?php

$test=2333;
function fun(){
    global $test;
    echo $test;
    
}
fun();
?>