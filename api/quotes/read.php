<?php

$data = $_GET;

//if user used combo of authorId or CategoryId

if(isset($data['authorId'])) {
    $quo->authorId = $data['authordId'];

    //if both are provided

    if(isset($data['categoryId'])){
        $quo->categoryId = $data['categoryId'];
        $result = $quo->read_author_and_category();

        //if only authorId is shown


    } else {
        $result = $quo->read_author();
    }

    //only categoryid is shown
} else if {
    (isset($data['category'])){
        $quo->categoryId = $data['cateogryId'];
        $result = $quo->read_category();

        //nothing, return all quotes
    } else {
        $result = $quo->read();
    }

    //row count

    $rowCount = $result -> rowCount();


    //json if empty query

    if($rowCount ==0){
        echo json_encode(
            array('message' => 'Please enter quote')
        );

    } else {
        $quotes_arr = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
            );

            //push to data 
            array_push($quotes_arr, $quote_item);

            echo json_encode($quotes_arr);

        }
    }
}