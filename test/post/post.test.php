<?php

if (isset($_POST['text'])){  
        $response = 'you typed: '.$_POST['text']; 
    print_r(json_encode($response));      
}else{
    print <<<HTML
       <h1>Try using the <a href="./">index</a> to test this</h1><br/>   
          <h5>suplike 💜 PHP</h5>   
       HTML;  
}