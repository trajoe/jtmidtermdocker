<?php

if(!property_exists($data, "id")){
    missingParams();


}else{
    if(isValid($data->id,$theAuthor)){
        if($theAuthor->delete()){
            echo json_encode(
                array(
                    'id' => $data->id
                )
                );
        } else {
            fail("Author","Deleted");
        }

    } else {
        notFound("author");
    }
}

exit();