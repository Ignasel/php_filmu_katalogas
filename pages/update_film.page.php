<h2>Filmo redagavimas</h2>
<?php
$dsn= "mysql:host=$host; dbname=$db";
try{
    $conn = new PDO($dsn, $username, $password);
    if($conn){
    $thisId = $_GET['id'];

        $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        WHERE filmai.id=$thisId");
        $filmai = $stmt->fetch();

    }
}catch (PDOException $e){

    echo $e->getMessage();

}?>

<?php
$validation_errors=[];
if (isset($_POST['submit'])) {
    if (!preg_match('/\w{1,45}$/',
        trim(htmlspecialchars($_POST['movie_title'])))) {
        $validation_errors[] = "Vedant filmo pavadinimą, negalima vesti specialiuju simboliu.";
    }if (!preg_match('/\w{1,45}$/',
        trim(htmlspecialchars($_POST['director'])))) {
        $validation_errors[] = "Įveskite tik režisieriaus vardą ir pavardę";
    }
$sql ="UPDATE filmai
          SET pavadinimas = :pavadinimas, metai=:metai, rezisierius = :rezisierius, imdb=:imdb, zanrai_id = :zanrai_id,
          aprasymas = :aprasymas
           WHERE filmai.id=:id";

$stmt = $conn->prepare($sql);
$stmt ->bindParam(':pavadinimas', $_POST['movie_title'], PDO::PARAM_STR);
$stmt ->bindParam(':rezisierius', $_POST['director'], PDO::PARAM_STR);
$stmt ->bindParam(':metai', $_POST['movie_date'], PDO::PARAM_STR);
$stmt ->bindParam(':imdb', $_POST['movie_rating'], PDO::PARAM_STR);
$stmt ->bindParam(':zanrai_id', $_POST['genres_id'], PDO::PARAM_STR);
$stmt ->bindParam(':aprasymas', $_POST['about'], PDO::PARAM_STR);
$stmt ->bindParam(':id', $thisId, PDO::PARAM_STR);
$stmt ->execute();

}
?>


<form method="post">
    <div class="form-group">
        <label for="Movie_name">Pavadinimas</label>
        <input type="text" class="form-control" id="pavadinimas" value="<?=$filmai['pavadinimas']?>" name="movie_title">
    </div>
    <div class="form-group">
        <label for="director">Director</label>
        <input type="text" class="form-control" id="Director" value="<?=$filmai['rezisierius']?>" name="director">
    </div>
    <div class="form-group">
        <label for="movie_rating">Metai</label>
        <select class="form-control form-control-sm"  name="movie_date">
            <option><?=$filmai['metai']?></option>
            <?php
            for ($i=1900; $i<2021; $i++):?>
                <option><?=$i?></option>
            <?php endfor;?>
        </select>
        <div class="form-group">
            <label for="Movie_date">IMDB</label>
            <select class="form-control form-control-sm" name="movie_rating">
                <option><?=$filmai['imdb']?></option>
                <?php
                for ($i=10; $i<=100; $i++):?>
                    <option><?=$i/10?></option>
                <?php endfor;?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="about">Pasirinkite žanrą</label>
        <select class="form-control form-control-sm" name="genres_id">
            <option><?=$filmai['genre_name']?></option >
          <?php
            $stmt = $conn->query("SELECT * FROM zanrai");
            $zanrai = $stmt->fetchAll();
            foreach ($zanrai as $zanras):?>
                <option value="<?=$zanras['id']?>"><?=$zanras['pavadinimas']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="about">Filmo aprašymas</label>
        <input type="text" class="form-control" id="about" value="<?=$filmai['aprasymas']?>" name="about">
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>



<?php if($validation_errors) :?>
    <div class="errors">
        <ul>
            <?php foreach($validation_errors as $error) :?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>



