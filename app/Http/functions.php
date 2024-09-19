<?php

function formataData($data) {
    $dateTime = new DateTime($data);
    return $dateTime->format('y/m/d H:i:s');
}

?>