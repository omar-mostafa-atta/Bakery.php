<?php

class UserService
{
    private $mysqli;

    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function signup($username, $email, $password, $phone_number, $address)
    {
        try {
            if (!isset($username, $email, $phone_number, $address, $password)) {
                throw new Exception("Missing Information, Please Provide (username, email, phone number, address)");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            // بضشوف لو اليوز بالايميل ده موجود ولا لا 
            $checkForUserExists = "SELECT email FROM users WHERE email = ?";
            $stmt = $this->mysqli->prepare($checkForUserExists);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                throw new Exception("User with this email already exists");
            }
            /**
             * NOTE:
             * I'll use password_hash and password_verify
             * for hashing and verifying the password.
             * PASSWORD_DEFAULT: the best available hashing algorithm in PHP.
             */

            /**
             * TODO: Generate a JSON Web Token (JWT).
             * John Snow / John Snow / John Snow / John Snow / John Snow
             */

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, email, password, phone_number, address) VALUES (?, ?, ?, ?, ?)";
            $statement = $this->mysqli->prepare($query);
            $statement->bind_param("sssss", $username, $email, $hashed_password, $phone_number, $address);
            $statement->execute();
            if ($statement->affected_rows === 0) {
                throw new Exception("Failed to create product.");
            }
            $statement->close();
            http_response_code(201);
            return json_encode(["success" => "User Created Successfully"]);
        } catch (Exception $exception) {
            http_response_code(400);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }

    public function login($email, $password)
    {
        try {
            if (!isset($email, $password)) {
                throw new Exception("Missing informatio, Please provide (email, password)");
            }
            $checkForUserExists = "SELECT email, password FROM users WHERE email = ?";
            $stmt = $this->mysqli->prepare($checkForUserExists);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $hashedPasswordFromDB = "";
            if ($row = $result->fetch_object()) {
                $hashedPasswordFromDB = $row->password;
            } else {
                throw new Exception("No user found with the given email.");
            }
            if (!password_verify($password, $hashedPasswordFromDB)) {
                throw new Exception("Incorrect Email or password");
            }
            http_response_code(200);
            return json_encode(["success" => "Login successful"]);
        } catch (Exception $exception) {
            http_response_code(400);
            return json_encode(["error" => $exception->getMessage()]);
        }
    }
    public function getUserById($id)
    {
        try {
            if (!isset($id)) {
                throw new Exception("Missing Id, please make sure that u provide an id");
            }
            if (!is_numeric($id)) {
                throw new Exception("Invalid ID, ID Must be a number");
            }

            $id = $this->mysqli->real_escape_string($id);
            $query = "SELECT * FROM users WHERE id = $id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error executing query: " . $this->mysqli->error);
            }
            if ($result->num_rows === 0) {
                throw new Exception("User not found for ID: $id");
            }
            $user = $result->fetch_assoc();
            $user['id'] = (int) $user['id'];
            unset($user['password']);
            http_response_code(200);
            return json_encode($user);
        } catch (Exception $exception) {
            return json_encode(["error" => $exception->getMessage()]);
        }
    }
}