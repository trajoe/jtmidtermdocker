<?php



//category query

$result = $cat->read();

//row count

$rowCount = $result->rowCount();

//return json if empty

if($rowCount ==0){
    echo json_encode(
        array('message' => 'No  categories found.')
    );


} else {
    $categories_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'category'=>$category
        );

        //push 
        array_push($categories_arr, $category_item);
    }

    echo json_encode($categories_arr);
}

?>