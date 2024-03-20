<?php


if(isValid($GET['id'],$quo)){
    $quo_arr = array(
        'id' => $quo->id,
        'quote' => $quo->theQuote,
        'author'=> $quo->theAuthor,
        'category'=> $quo->theCategory
    ); 

    echo json_encode($quote_arr);
}else{
    echo json_encode(
        array('message'=>'No quotes')
    );
}

?>