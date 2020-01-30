<?php
session_start();
if($_SESSION['username'] == "admin"):?>
<?php
$filmai = controlMovies();

    if (isset($_POST['submit'])){
        header('Location:/Igno2/?page=add_movies');
    }

?>
<h2>Valdyti filmus</h2>
<form method="post">
<button type="submit" class="btn btn-primary" name="submit">pridėti naują filmą</button>
</form>


<table class="table table-bordered">
    <tr>
        <th>Filmo ID</th>
        <th>Filmo pavadinimas</th>
        <th>Filmo metai</th>
        <th>Režisierius</th>
        <th>Filmo IMDB įvertinimas</th>
        <th>Filmo žanras</th>
        <th>Aprašymas</th>
    </tr>
    <tr>
        <?php
        foreach ($filmai as $filmas):?>
    </tr>

    <tr>
        <td><?=$filmas['movies_id'];?></td>
        <td><?=$filmas['pavadinimas'];?></td>
        <td><?=$filmas['metai'];?></td>
        <td><?=$filmas['rezisierius'];?></td>
        <td><?=$filmas['imdb'];?></td>
        <td><?=$filmas['genre_name'];?></td>
        <td><?=$filmas['aprasymas'];?></td>
        <td><a href="?page=update_film&id=<?=$filmas['movies_id']?>">Redaguoti</a></td>
        <td><a href="?page=delete_film&id=<?=$filmas['movies_id']?>">Šalinti</a></td>
    </tr>
    <?php endforeach;?>
</table>

<?php else:?>
   <?php header('Location:/Igno2/?page=login')
    ?>
<?php endif;?>