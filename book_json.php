<?php header ('Content-Type: application/json');

$books = [
    [
        "id" => 1,
        "title" => "Harry Potter",
        "author" => "J.K. Rowling",
        "year" => 1997
    ],
    [
        "id" => 2,
        "title" => "The Lord of the Rings",
        "author" => "J.R.R. Tolkien",
        "year" => 1954
    ]
];

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($books);
        break;

    case 'POST':
        $input =json_decode(file_get_contents('php://input'),true);
        $input ['id'] = end($books)['id'] + 1;
        $books[] = $input;
        echo json_encode ($input);
    
    default:
        http_response_code(405);
        echo json_encode(["message"=> "metode HTTP tidak didukung"]);
        break;
}
?>