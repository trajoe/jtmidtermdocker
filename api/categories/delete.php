<?php

if(!property_exists($data, "id")){
    missingParams();


}else{
    if(isValid($data->id,$cat)){
        if($cat->delete()){
            echo json_encode(
                array(
                    'id' => $data->id
                )
                );
        } else {
            fail("Category","Deleted");
        }

    } else {
        notFound("category");
    }
}

exit();