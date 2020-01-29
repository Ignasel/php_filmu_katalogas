<?php session_start();
if($_SESSION['username'] == "admin"):?>
<?php
$thisId = $_GET['id'];
$filmai = MoviebyId($thisId);


$validation_errors=[];
if (isset($_POST['submit'])) {
    if (!preg_match('/\w{1,45}$/',
        trim(htmlspecialchars($_POST['movie_title'])))) {
        $validation_errors[] = "Vedant filmo pavadinimą, negalima vesti specialiuju simboliu.";
    }if (!preg_match('/\w{1,45}$/',
        trim(htmlspecialchars($_POST['director'])))) {
        $validation_errors[] = "Įveskite tik režisieriaus vardą ir pavardę";
    }

    updateMovie($_POST['movie_title'], $_POST['director'], $_POST['movie_date'], $_POST['movie_rating'],$_POST['genres_id'],
    $_POST['about'], $thisId);

}
?>

<h2>Filmo redagavimas</h2>
<form method="post">
    <div class="form-group">
        <label for="Movie_name">Pavadinimas</label>
        <input type="text" class="form-control" id="pavadinimas" value="<?=$filmai["pavadinimas"]?>" name="movie_title">
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
            <option value="<?=$filmai['id']?>"><?=$filmai['genre_name']?></option >
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
<?php endif;?>


