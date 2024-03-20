<?php

//quote authorId and category

if(!property_exists($data, 'quote') || !property_exists($data, 'authorId') || !property_exists($data, 'categoryId')){

    missingParams();
} else {
    $auth = new Author($db);
    $cat = new Category($db);

    if(!isValid($data->authorId, $auth)){
        notFound("category");
    } else {
        $quo->theQuote = $data->quote;
        $quo->authorId = $data->authorId;
        $quo->categoryId = $data->categoryId;


        if ($quo->create()){
            echo json_encode(
                array(
                    'id' => $quo->id,
                    'quote' => $quo->theQuote,
                    'authorId' => $quo->authorId,
                    'categoryId' => $quo->categoryId
                )
                );


        } else {
            fail("Quote", "Created");
        }
    }
}
