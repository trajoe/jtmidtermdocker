<?php

//make sure id and category are there, if not reutrn json missing parameters

if(!property_exists($data, 'id') || !property_exists($data, 'quote') || !property_exists($data, 'authorId') || !property_exists($data, 'categoryId')){
    missingParams();

} else {
    $auth = new Author($db);
    $cat = new Category($db);

   if(!isValid($data->id,$quo)){
    echo json_encode(
        array(
            "message"=> "No quotes"
        )
        );

        //authorid in db


   } else if(!isValid($data->authorId, $auth)){
    notFound("author");
    //check for categoryid in db
   } else if (!isValid($data->categoryId, $cat)){
    notFound("category");

   } else {
    //update quote

    $quo->theQuote = $data->quote;
    $quo->authorId = $data->authorId;
    $quo->categoryId = $data->categoryId;

    if($quo->update()){
        echo json_encode(
            array(
                'id'=>$quo->id,
                'quote'=> $quo->theQuote,
                'authorId'=>$quo->authorId,
                'categoryId'=>$quo->categoryId
            )
            );


    } else {
        fail("Quote","Updated");
    }
   }
}
exit();

?>