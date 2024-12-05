<?php
require_once "./../config/database.php";
require_once "./../services/product.service.php";

$database = new Database();
$connection = $database->getConnection();

$productService = new ProductService($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header('Content-Type: application/json');
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
        echo $productService->getProductById($id);
    } else {
        echo $productService->getAllProducts();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'] ?? null;
    $description = $data['description'] ?? null;
    $price = $data['price'] ?? null;
    $image = json_encode($data['image'] ?? []);
    $quantity = $data['quantity'] ?? null;
    $ingredients = $data['ingredients'] ?? null;
    $offers = isset($data['offers']) ? (bool) $data['offers'] : null;
    $rate = $data['rate'] ?? null;
    $category_id = $data['category_id'] ?? null;
    $category_name = $data['category_name'] ?? null;
    echo $productService->createProduct($name, $description, $price, $image, $quantity, $ingredients, $offers, $rate, $category_id, $category_id);
}

// هيبعت الداتا ك جيسون_
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'] ?? null;
    $price = $data['price'] ?? null;
    $quantity = $data['quantity'] ?? null;
    echo $productService->updateProduct($id, $price, $quantity);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    header('Content-Type: application/json');
    $id = (int) $_GET['id'] ?? null;
    echo $productService->deleteProductById($id);
}
