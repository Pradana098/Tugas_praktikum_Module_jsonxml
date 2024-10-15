<?php header ('Content-Type: application/xml');
$xml = new SimpleXMLElement('<book/>');

$book1 = $xml->addChild('book');
$book1->addChild('id', 1);
$book1->addChild('title', 'Harry Potter');
$book1->addChild('author', 'J.K. Rowling');
$book1->addChild('year', 1997);

$book2 = $xml->addChild('book');
$book2->addChild('id', 2);
$book2->addChild('title', 'The Lord of the Rings');
$book2->addChild('author', 'J.R.R. Tolkien');
$book2->addChild('year', 1954);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo $xml->asXML();
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);

        $newBook = $xml->addChild('book');
        $newBook->addChild('id', (int)$input['id']);
        $newBook->addChild('title', $input['title']);
        $newBook->addChild('author', $input['author']);
        $newBook->addChild('year', (int)$input['year']);

        echo $xml->asXML();
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metode HTTP tidak didukung"]);
        break;
}
?>