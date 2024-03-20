<?php



//author query

$result = $theAuthor->read();

//row count

$rowCount = $result->rowCount();

//return json if empty

if($rowCount ==0){
    echo json_encode(
        array('message' => 'No  author found.')
    );


} else {
    $authors_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author'=>$author
        );

        //push 
        array_push($authors_arr, $author_item);
    }

    echo json_encode($authors_arr);
}