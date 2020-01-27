<?php
$conn = connectDB();

function connectDB(){
    global $host, $db, $username, $password, $options;
    $dsn= "mysql:host=$host; dbname=$db";
    try{
        $conn = new PDO($dsn, $username, $password, $options);

}catch (PDOException $e){

    echo $e->getMessage();
        exit;
}
    return ($conn);
}

    function allMovies(){
        $conn = connectDB();
        try {
                if ($conn) {
                    $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id");
                    $filmai = $stmt->fetchAll();
                }
            }catch (PDOException $e) {
                echo $e->getMessage();
            exit;}


            return $filmai;

        }
    function allGenres()
    {
        $conn = connectDB();
        try {
            if ($conn) {
                if($conn){
                    $stmt = $conn->query("SELECT pavadinimas, id FROM zanrai");
                    $zanrai = $stmt->fetchAll();
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $zanrai;
}

    function moviesByGenre($value)
    {
        $conn = connectDB();
        try {
            if ($conn) {
                if ($conn) {
                    $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        WHERE zanrai_id = $value ");
                    $films_by_genre = $stmt->fetchAll();
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $films_by_genre;
    }

function MoviebyId($thisId)
{
    $conn = connectDB();
    try {
        if ($conn) {
            if ($conn) {
                $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        WHERE filmai.id=$thisId");
                $filmai = $stmt->fetchAll();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $filmai;
}

function DeleteFilm($thisId){
    $conn = connectDB();
    try {
        if ($conn) {
            if ($conn) {
                $stmt = $conn->query("DELETE FROM filmai WHERE id=$thisId");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function GenresById($thisId)
{
    $conn = connectDB();
    try {
        if ($conn) {
            if ($conn) {
                $stmt = $conn->query("SELECT * FROM zanrai
                                        WHERE id=$thisId");
                $zanrai = $stmt->fetchAll();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $zanrai;
}

function DeleteGenre($thisId){
    $conn = connectDB();
    try {
        if ($conn) {
            if ($conn) {
                $stmt = $conn->query("DELETE FROM zanrai WHERE id=$thisId");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function allUsers()
    {
        $conn = connectDB();
        try {
            if ($conn) {
                if($conn){
                    $stmt = $conn->query("SELECT * FROM users");
                    $users = $stmt->fetchAll();
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $users;
    }











    ?>




