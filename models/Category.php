<?php
class Category {
    private $conn;
    private $table = 'categories';

    public $id;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }

//create
 function create(){
    $query = 'INSERT INTO ' . $this->table. '
    SET category = :name';

    $stmt = $this->conn->prepare($query);

    //clean

    $this->name = htmlspecialchars(strip_tags($this->name));

    //bind

    $stmt->bindParam(':name', $this->name);

    //execute

    if ($stmt->execute()) {
        $this->id = $this->conn->lastInsertId();
        return true;
    }

    //error if wrong

    printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //get categories

    function read(){
        $query =    'SELECT *
        FROM ' . $this->table . '
        ORDER BY id';
    //prepare
    $stmt = $this->conn->prepare($query);    

    //execute

    $stmt->execute();

    return $stmt;
    }

 //read single category
 
 function read_single(){
    $query = 'SELECT *
    FROM' .$this->table . ' 
    WHERE id = :id';

//prepare
$stmt = $this->conn->prepare($query);

//bind
$stmt->bindParam(':id', $this->id);

//execute query
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);


//set properties if the row exists
if ($row) {
    $this->name = $row['category'];
}

}

//update

function update(){
    $query = 'UPDATE' .$this->table . '
    SET category = :category
    WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    //clean

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind

    $stmt->bindParam(':category', $this->name);
    $stmt->bindParam(':id', $this->id);

    //execeute query

    if ($stmt->execute()) {
        return true;
    }


    printf("Error: %s.\n", $stmt->error);
    return false;
}

//delete

function delete(){
    $query = '  DELETE FROM ' . $this->table . '
        WHERE id = :id'; 

    //prepare
    
    $stmt = $this->conn->prepare($query);

    //clean
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind

    $stmt->bindParam(':id', $this->id);

    //execute

    if ($stmt->execute()) {
        return true;
    }
    //error handling
      printf("Error: %s.\n", $stmt->error);
        return false;
}



}

?>

 








    
    











