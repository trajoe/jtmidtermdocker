<?php

//id not found

function notFound($modelType){
    echo json_encode(
        array('message' => $modelType . 'id not found')
    );
}

