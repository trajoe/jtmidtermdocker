<?php


if(isValid($GET['id'],$cat)){
    $cat_arr = array(
        'id' => $cat->id,
        'category'=> $cat->name
    );

    echo json_encode($cat_arr);
}else{
    notFound("category");
}

?>