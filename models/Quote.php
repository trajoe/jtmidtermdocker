<?php
class Quote{
    private $conn;
    private $table = 'quotes';

   public $id;
   public $theQuote;
   public $theAuthor;
   public $theCategory;
   public $authorId;
   public $categoryId;
   
   
   public function __construct($db) {
    $this->conn = $db;

}   

//create

function create(){
  $query = 'INSERT INTO ' . $this->table . ' (quote, authorId, categoryId) 
  VALUES (:quote, :authorId, :categoryId);';

  //prepare

  $stmt = $this->conn->prepare($query);

  //clean data

  $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
  $this->authorId = htmlspecialchars(strip_tags($this->authorId));
  $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

//bind
  $stmt->bindParam(':quote', $this->theQuote);
  $stmt->bindParam(':authorId', $this->authorId);
  $stmt->bindParam(':categoryId', $this->categoryId);


  //execute query

  if ($stmt->execute()) {
    $this->id = $this->conn->lastInsertId();
    return true;
}

//print error

printf("ErrorL %s.\n", $stmt->error);
return false;

}


//query return json object of all quotes in database

function read(){
  $query = 'SELECT q.id, q.quote, a.author, c.category
  FROM ' .$this->table . 'q 
  LEFT JOIN authors a on q.authorId = a.id
  LEFT JOIN categories c on q.categoryId = c.id;';
  
//prepare

$stmt = $this->conn->prepare($query);

//execute

 $stmt->execute();

return $stmt;

}


//query all quotes from matching authorId

function read_author(){
  $query = 'SELECT q.id, q.quote, a.author, c.category
  FROM ' . $this->table . ' q
  LEFT JOIN authors a on  q.authorId = a.id
  LEFT JOIN categories c on q.categoryId = c.id
  WHERE a.id = :authorId';
}

//prepare

$stmt = $this->conn->prepare($query);

//bind
$stmt->bindParam(':authorId', $this->authorId);

//execute
$stmt->execute();

return $stmt;

}

//return all quotes from matching category

function read_category() {
  $query = 'SELECT q.id, q.quote, a.author, c.category
  FROM ' . $this->table . ' q
  LEFT JOIN authors a on  q.authorId = a.id
  LEFT JOIN categories c on q.categoryId = c.id
  WHERE c.id = :categoryId';

//prepare

$stmt = $this->conn->prepare($query);

//bind
$stmt->bindParam(':authorId', $this->authorId);

//execute
$stmt->execute();

return $stmt;
}


//returns all quotes from matching author and category

function read_author_and_category() {
  $query = 'SELECT q.id, q.quote, a.author, c.category
  FROM ' . $this->table . ' q
  LEFT JOIN authors a on  q.authorId = a.id
  LEFT JOIN categories c on q.categoryId = c.id
  WHERE a.id = :authorId AND c.id = :categoryId';

//prepare

$stmt = $this->conn->prepare($query);

//bind
$stmt->bindParam(':categoryId', $this->categoryId);
$stmt->bindParam(':authorId', $this->authorId);

//execute
$stmt->execute();

return $stmt;

}

//returns a single quote based on the quote id
function read_single() {
  $query = 'SELECT q.id, q.quote, a.author, c.category, a.id AS "authorId", c.id AS "categoryId"
  FROM ' . $this->table . ' q
  LEFT JOIN authors a on  q.authorId = a.id
  LEFT JOIN categories c on q.categoryId = c.id
  WHERE q.id = :id;';

//prepare

$stmt = $this->conn->prepare($query);


//bind

$stmt->bindParam(':id',$this->id);

//execute
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

//set properties if the row exists

if($row){
  $this->theQuote= $row['quote'];
  $this->theAuthor= $row['author'];
  $this->theCategory= $row['category'];
  $this->authorId= $row['authorId'];
  $this->categoryId= $row['categoryId'];

}




//update

function update(){
  $query = 'UPDATE ' .$this->table . '
  SET quote = :quote,
  authorId = :authorId,
  categoryId = categoryId
  WHERE id = :id;';
}

$stmt = $this->conn->prepare($query);

//clean

$this->id = htmlspecialchars(strip_tags($this->id));
$this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
$this->authorId = htmlspecialchars(strip_tags($this->authorId));
$this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

//bind

$stmt->bindParam(':id', $this->id);
$stmt->bindParam(':quote', $this->theQuote);
$stmt->bindParam(':authorId', $this->authorId);
$stmt->bindParam(':categoryId', $this->categoryId);

//execute

if ($stmt->execute()) {
  return true;
}

//print if error
printf("ErrorL %s.\n", $stmt->error);
return false;
}


//delete

function delete(){
  $query = 'DELETE FROM ' . $this->table . '
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

printf("Error: %s.\n", $stmt->error);
return false;
}

?>