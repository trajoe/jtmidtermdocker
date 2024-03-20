<?php
class Author {
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

//create
    function create() {
        $query = 'INSERT INTO ' . $this->table. '
            SET author = :name';

        // prepare stmt
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind data
        $stmt->bindParam(':name', $this->name);

        // execute query 
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // if something goes wrong print 
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

//get authors

function read(){
    $query = 'SELECT *
    FROM ' . $this->table .'
    ORDER BY id';

//prepare statement 
$stmt = $this->conn->prepare($query);

//execute stmt

$stmt->execute();

return $stmt;    
}

//read single author
function read_single(){
    $query = 'SELECT *
    FROM ' . $this->table . ' 
    WHERE id = :id';

  // prepare statement
  $stmt = $this->conn->prepare($query);


  //bind id

  $stmt->bindParam(':id',$this->id);

//execute query

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) { $this->name = $row['author']; }
}

//update

function update(){
    $query = 'UPDATE ' . $this->table . '
    SET author = :author
    WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    //clean

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind

    $stmt->bindParam(':author', $this->name);
    $stmt->bindParam(':id', $this->id);

    //execute

    if ($stmt->execute()) {
        return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);
    return false;


   //delete
   function delete()
   {
    $query = ' DELETE FROM ' . $this->table . '
    WHERE id = :id';

    //prepare
    $stmt = $this->conn->prepare($query);

    //clean

    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind

    $stmt->bindParam(':id', $this->id);

    //execute query
    if ($stmt->execute()) {
        return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;

   }
   
}

}
?>