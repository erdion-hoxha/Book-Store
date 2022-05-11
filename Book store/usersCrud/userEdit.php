<?php
session_start();
require_once "../DBconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $person_id = (int)$_POST["id"];
    if ($person_id != (int)$_POST["First_person_id"]) {
        try {
            $stmt = $pdo->query("Select person_id from person WHERE person_id = $person_id");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result != null) {
                echo json_encode(["Return" => false, "Message" => "Useri me kete id ekziston ne database"]);
                exit;
            }
        } catch (PDOException $e) {
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
            exit;
        }
    }

    $person_name = $_POST["name"];
    $lastName = $_POST["surname"];
    $postal_code = $_POST["postal_code"];  
    $city_name = $_POST["city_name"]; 
    $password = $_POST["password"];  
    $email = $_POST["email"];

    if (isset($_POST["birthday"])) {
        $birthday = date('Y-m-d', strtotime($_POST["birthday"]));
    }

    $role = $_POST["role"];
    $pdo->beginTransaction();

    $stmt = $pdo->query("Select city_id from city where city_name = '$city_name'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $city_id = $result[0]['city_id'];
    } else {
        echo json_encode(["Return" => false, "Message" => 'qyteti nuk ekziston ka gabim']);
        exit;
    }

    $stmt = $pdo->query("Select city_id from city where city_name = '$city_name'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $city_id = $result[0]['city_id'];
    } else {
        echo json_encode(["Return" => false, "Message" => 'qyteti nuk ekziston ka gabim']);
        exit;
    }
    
    try {
        // $sql = $pdo->prepare("Update `book` SET `ISBN` = $isbn,
        // `book_name` = $book_name,
        // `publishing_house_id` = $publishing_house_id,
        // `price` = $price,
        // `quantity` = $quantity,
        // `description` = $description,
        // `FK_book_category_id` = $category_id,
        // `author_id` = $author_id
        // where `book`.`ISBN` = $isbn");
        $sql = $pdo->prepare("Update `person` SET `person_id` = ?, `name` = ?, `surname` = ? ,`role` = ? ,`postal_code` = ?,
                `city_name` = ?, = ?, `password` = ? where `person`.`person_id` = ? ");
        $sql->execute(array($person_id, $person_name, $lastName, $role, $postal_code, $city_name, $password,(int)$_POST["First_person_id"]));
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
}
           