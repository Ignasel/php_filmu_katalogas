<?php
connectDB();
$validation_errors=[];
if (isset($_POST['submit'])) {
    if (!preg_match('/\w{1,45}$/',
        trim(htmlspecialchars($_POST['genre_name'])))) {
        $validation_errors[] = "Vedant žanro pavadinimą, negalima vesti specialiuju simboliu.";
    }
}
if (isset($_POST['submit']) && !$validation_errors) {
    insertGenre();
}
?>

<h2>Žanro pridėjimas</h2>
<form method="post">
    <div class="form-group">
        <label for="Movie_name">Pavadinimas</label>
        <input type="text" class="form-control" id="pavadinimas" placeholder="pavadinimas" name="genre_name">
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


