<?php

//$op was completed

function success($modelType, $op){
    echo json_encode(
        array("message" => $modelType . " " . $op)
    );
}