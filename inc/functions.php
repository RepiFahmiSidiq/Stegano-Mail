<?php

//function toBinary(string $message) {
function toBinary($message) {
    $result = (string) '';
    for($i = 0; $i < strlen($message); $i++) {
        $result .= str_pad(decbin(ord($message[$i])), 8, "0", STR_PAD_LEFT);
    }
    return $result;
}

?>