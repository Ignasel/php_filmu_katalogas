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
                $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        WHERE filmai.id=$thisId");
                $filmai = $stmt->fetch();
                $conn = null;
            }
    } catch (PDOException $e) {
        echo $e->getMessage();
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

function controlMovies()
{
    $conn = connectDB();
    try {
    if($conn){
        $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        ORDER BY movies_id");
        $filmai = $stmt->fetchAll();
    }
}catch (PDOException $e){
    echo $e->getMessage();
    }
    return $filmai;
}

function insertGenre()
{
    $conn = connectDB();
    try {
        if($conn){
            $sql = "INSERT INTO zanrai (pavadinimas)
              VALUES (:pavadinimas)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pavadinimas', $_POST['genre_name'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:/Igno2/?page=zanru-valdymas');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function movieSearch($searchIT)
{
    $conn = connectDB();
    try {
        if ($conn) {
            $uzklausa = $conn->query("SELECT id, pavadinimas, metai, rezisierius, imdb,
                                        aprasymas FROM filmai
                                        WHERE pavadinimas like '%$searchIT%'");

            $uzklausa->bindValue(1, "%$searchIT%", PDO::PARAM_STR);
            $uzklausa->execute();
            $filmams = $uzklausa->fetchAll();
        }
    } catch (PDOException $e) {
            echo $e->getMessage();
            exit;}

            return $filmams;
}

function addMovie()
{
$conn = connectDB();
    try {
        if ($conn){
            $sql = "INSERT INTO filmai (pavadinimas, metai, rezisierius, imdb, zanrai_id, aprasymas)
              VALUES (:pavadinimas, :metai, :rezisierius, :imdb, :zanrai_id, :aprasymas)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pavadinimas', $_POST['movie_title'], PDO::PARAM_STR);
            $stmt->bindParam(':metai', $_POST['movie_date'], PDO::PARAM_STR);
            $stmt->bindParam(':rezisierius', $_POST['director'], PDO::PARAM_STR);
            $stmt->bindParam(':imdb', $_POST['movie_rating'], PDO::PARAM_STR);
            $stmt->bindParam(':zanrai_id', $_POST['genres_id'], PDO::PARAM_STR);
            $stmt->bindParam(':aprasymas', $_POST['about'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:/Igno2/?page=visi');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;}

}

function updateMovie($pavadinimas, $rezisierius, $metai, $imdb, $zanrai_id, $aprasymas, $thisId)
{
    $conn = connectDB();
    try {
        if ($conn) {
            $sql = "UPDATE filmai
          SET pavadinimas = :pavadinimas, metai=:metai, rezisierius = :rezisierius, imdb=:imdb, zanrai_id = :zanrai_id,
          aprasymas = :aprasymas
           WHERE filmai.id=:id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pavadinimas', $pavadinimas, PDO::PARAM_STR);
            $stmt->bindParam(':rezisierius', $rezisierius, PDO::PARAM_STR);
            $stmt->bindParam(':metai', $metai, PDO::PARAM_STR);
            $stmt->bindParam(':imdb', $imdb, PDO::PARAM_STR);
            $stmt->bindParam(':zanrai_id', $zanrai_id, PDO::PARAM_STR);
            $stmt->bindParam(':aprasymas', $aprasymas, PDO::PARAM_STR);
            $stmt->bindParam(':id', $thisId, PDO::PARAM_STR);
            $stmt->execute();
            header('Location:/Igno2/?page=filmu-valdymas');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

function allUsers($input)
{
    $conn = connectDB();
    try {
        if($conn){
            $stmt = $conn->prepare("SELECT * FROM users
                                            WHERE username LIKE ?");
            $stmt->bindValue(1, "%input%", PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetchAll();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $users;
}


?>




