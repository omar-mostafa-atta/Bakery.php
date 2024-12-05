<?php
require_once "./../config/database.php";
require_once "./../services/category.service.php";

$database = new Database();
$connection = $database->getConnection();

$categoryService = new CategoryService($connection);

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header('Content-Type: application/json');
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
        echo $categoryService->getCategoryById($id);
    } else {
        echo $categoryService->getAllCategories();
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'] ?? null;
    $description = $data['description'] ?? null;

    echo $categoryService->createCategory($name, $description);
}

// Handle PATCH requests
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'] ?? null;
    $name = $data['name'] ?? null;
    $description = $data['description'] ?? null;

    echo $categoryService->updateCategory($id, $name, $description);
}

// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    header('Content-Type: application/json');
    $id = (int) $_GET['id'] ?? null;

    echo $categoryService->deleteCategoryById($id);
}
