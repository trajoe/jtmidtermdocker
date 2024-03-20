<?php

//make sure id and author are there, if not reutrn json missing parameters

if(!property_exists($data, 'id') || !property_exists($data, 'author')){
    missingParams();

} else {
    if(isValid($data->id, $theAuthor)){
        $theAuthor->name = $data->author;

        //update
        if($theAuthor->update()){
            echo json_encode(
                array(
                    'id' =>$theAuthor->id,
                    'author'=>$theAuthor->name
                )
                );


        } else {
            fail("Author", "Updated");
        }

    } else {
        notFound("author");
    }
}

exit();

