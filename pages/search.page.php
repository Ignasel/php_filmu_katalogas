<h2>Filmo paieškos laukelis </h2>

<?php
allMovies()
?>


<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Įveskite filmo pavadinimą</label>
        <input type="text" class="form-control" list="searchByTitle"  placeholder="Filmo pavadinimas" name="titleForSearch">
        <datalist id="searchByTitle">
            <?php foreach ($filmai as $filmas):?>
                <option value="<?=$filmas['pavadinimas'];?>"></option>
            <?php endforeach;?>
        </datalist>
    </div>
    <button type="submit" class="btn btn-primary" name="searchForIT">Submit</button>
</form>


<?php
    if (isset($_POST['searchForIT'])) :?>

<?php
$searchIT = $_POST['titleForSearch'];
$filmams = movieSearch($searchIT);

?>

<table class="table table-bordered">
    <tr>
        <th>Filmo ID</th>
        <th>Filmo pavadinimas</th>
        <th>Filmo metai</th>
        <th>Režisierius</th>
        <th>Filmo IMDB įvertinimas</th>
        <th>Aprašymas</th>
    </tr>
    <tr>
        <?php
        foreach ($filmams as $filmas):?>
    </tr>

    <tr>
        <td><?=$filmas['id'];?></td>
        <td><?=$filmas['pavadinimas'];?></td>
    <td><?=$filmas['metai'];?></td>
    <td><?=$filmas['rezisierius'];?></td>
    <td><?=$filmas['imdb'];?></td>
    <td><?=$filmas['aprasymas'];?></td>
    </tr>
    <?php endforeach;?>
</table>


<?php endif;?>