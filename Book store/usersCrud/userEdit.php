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
        $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
                `description` = ?,`FK_book_category_id` = ?, `author_id` = ? where `book`.`ISBN` = ? ");
        $sql->execute(array($isbn, $book_name, $publishing_house_id, $price, $quantity, $description, $category_id,$author_id,(int)$_POST["First_ISBN"]));
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
    if (!empty($_FILES["book_cover"]["name"])) {
        $book_cover_filename = $_FILES['book_cover']['name'];
        $book_cover_destination = '../book_cover/' . $book_cover_filename;
        $book_cover_extension = pathinfo($book_cover_filename, PATHINFO_EXTENSION);
        $book_cover_file = $_FILES['book_cover']['tmp_name'];
        $book_cover_size = $_FILES['book_cover']['size'];
        if (!in_array(strtolower($book_cover_extension), ['jpeg', 'jpg', 'png'])) {
            echo json_encode(["Return" => false, "Message" => "You file extension must be .jpeg, .jpg or .png"]);
            $pdo->rollBack();
            exit;
        }
        if ($book_cover_size > 50000000) { // file shouldn't be larger than 5Megabyte
            echo json_encode(["Return" => false, "Message" => "Book cover image too large!"]);
            $pdo->rollBack();
            exit;
        }
        if (file_exists('../book_cover/' . $_POST["First_book_cover"])) {
            chmod('../book_cover/' . $_POST["First_book_cover"], 0755);
            unlink('../book_cover/' . $_POST["First_book_cover"]);
        }
        if (file_exists($book_cover_destination)) {
            chmod($book_cover_destination, 0755);
            unlink($book_cover_destination);
            if (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
                echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
                exit;
            }
        } elseif (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
            echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
            exit;
        }
        $sql = $pdo->prepare("Update `book` SET `book_cover` =  ? where  `ISBN` = ?");
        $sql->execute(array($book_cover_filename, $isbn));
    }
    if (!empty($_FILES["book_file"]["name"])) {
        $book_file_filename = $_FILES['book_file']['name'];
        $book_file_destination = '../book_file/' . $book_file_filename;
        $book_file_extension = pathinfo($book_file_filename, PATHINFO_EXTENSION);
        $book_file_file = $_FILES['book_file']['tmp_name'];
        $book_file_size = $_FILES['book_file']['size'];
        if (!in_array(strtolower($book_file_extension), ['pdf'])) {
            echo json_encode(["Return" => false, "Message" => "You file extension must be .pdf"]);
            $pdo->rollBack();
            exit;
        }
        if ($book_file_size > 500000000) { // file shouldn't be larger than 50 Megabyte
            echo json_encode(["Return" => false, "Message" => "Book file image too large!"]);
            $pdo->rollBack();
            exit;
        }
        if (file_exists('../book_file/' . $_POST["First_book_file"])) {
            chmod('../book_file/' . $_POST["First_book_file"], 0755);
            unlink('../book_file/' . $_POST["First_book_file"]);
        }
        if (file_exists('../book_file/' . $_POST["First_book_file"])) {
            chmod('../book_file/' . $_POST["First_book_file"], 0755);
            unlink('../book_file/' . $_POST["First_book_file"]);
            if (!move_uploaded_file($book_file_file, $book_file_destination)) {
                echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
                exit;
            }
        } elseif (!move_uploaded_file($book_file_file, $book_file_destination)) {
            echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
            exit;
        }
        $sql = $pdo->prepare("Update `book` SET `book_file` =  ? where  `ISBN` = ?");
        $sql->execute(array($book_file_filename, $isbn));
    }
    $pdo->commit();
    echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    exit;

    
} else {
    echo json_encode(["Return" => false, "Message" => "nje nga filet eshte bosh ose forma nuk ka ardhur me post"]);
}