<?php

class CategoryService
{
    private $mysqli;

    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Get all categories
    public function getAllCategories()
    {
        try {
            $query = "SELECT * FROM categories";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error fetching categories: " . $this->mysqli->error);
            }

            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $row['id'] = (int)$row['id'];
                $categories[] = $row;
            }

            $result->free();
            http_response_code(200);
            return json_encode($categories);

        } catch (Exception $exception) {
            http_response_code(400);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }

    // Get a category by ID
    public function getCategoryById($id)
    {
        try {
            if (!$id) {
                throw new Exception("Missing ID. Please provide a valid category ID.");
            }

            $id = $this->mysqli->real_escape_string($id);
            $query = "SELECT * FROM categories WHERE id = $id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error fetching category: " . $this->mysqli->error);
            }

            if ($result->num_rows === 0) {
                throw new Exception("Category not found with ID: $id");
            }

            $category = $result->fetch_assoc();
            $category['id'] = (int)$category['id'];

            $result->free();
            http_response_code(200);
            return json_encode($category);

        } catch (Exception $exception) {
            http_response_code(400);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }

    // Create a new category
    public function createCategory($name, $description)
    {
        try {
            if (!$name || !$description) {
                throw new Exception("Missing required fields. Name and description are required.");
            }

            $query = "INSERT INTO categories (name, description) VALUES (?, ?)";
            $statement = $this->mysqli->prepare($query);
            $statement->bind_param('ss', $name, $description);
            $statement->execute();

            if ($statement->affected_rows === 0) {
                throw new Exception("Failed to create category.");
            }

            $statement->close();
            http_response_code(201);
            return json_encode(["success" => "Category created successfully."]);

        } catch (Exception $exception) {
            http_response_code(500);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }

    // Update an existing category
    public function updateCategory($id, $name, $description)
    {
        try {
            if (!$id || !$name || !$description) {
                throw new Exception("Missing required fields. ID, name, and description are required.");
            }

            $query = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
            $statement = $this->mysqli->prepare($query);
            $statement->bind_param('ssi', $name, $description, $id);
            $statement->execute();

            if ($statement->affected_rows === 0) {
                throw new Exception("No rows were updated. Please check if the category ID is correct.");
            }

            $statement->close();
            http_response_code(200);
            return json_encode(["success" => "Category updated successfully."]);

        } catch (Exception $exception) {
            http_response_code(400);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }

    // Delete a category by ID
    public function deleteCategoryById($id)
    {
        try {
            if (!$id) {
                throw new Exception("Missing ID. Please provide a valid category ID.");
            }

            $id = $this->mysqli->real_escape_string($id);
            $query = "DELETE FROM categories WHERE id = $id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error deleting category: " . $this->mysqli->error);
            }

            if ($this->mysqli->affected_rows === 0) {
                throw new Exception("No category found with ID: $id");
            }

            http_response_code(200);
            return json_encode(["success" => "Category deleted successfully."]);

        } catch (Exception $exception) {
            http_response_code(500);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }
}
