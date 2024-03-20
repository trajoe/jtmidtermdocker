<?php

//make sure id and category are there, if not reutrn json missing parameters

if(!property_exists($data, 'id') || !property_exists($data, 'category')){
    missingParams();

} else {
    if(isValid($data->id, $cat)){
        $cat->name = $data->category;

        //update
        if($cat->update()){
            echo json_encode(
                array(
                    'id' =>$cat->id,
                    'category'=>$cat->name
                )
                );


        } else {
            fail("Category", "Updated");
        }

    } else {
        notFound("Category");
    }
}

exit();

