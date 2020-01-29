<h2>Filmai pagal žanrą</h2>
<?php
   $zanrai = allGenres();
if (isset($_GET['id'])) {
    $value = $_GET['id'];
    $films_by_genre = moviesByGenre($value);
}
?>

<ul>
<?php
foreach ($zanrai as $zanras):?>
        <li>
        <a href="?page=zanrai&id=<?=$zanras['id']?>"><?=$zanras['pavadinimas']?></a>
        </li>
<?php endforeach;?>
</ul>


<?php if (isset($_GET['id'])) :?>
<table class="table table-bordered">
    <tr>
        <th>Filmo žanras</th>
        <th>Filmo ID</th>
        <th>Filmo pavadinimas</th>
        <th>Filmo metai</th>
        <th>Režisierius</th>
        <th>Filmo IMDB įvertinimas</th>
        <th>Aprašymas</th>
    </tr>
    <tr>
        <?php
        foreach ($films_by_genre as $filmas_zanro):?>
    </tr>

    <tr>
        <td><?=$filmas_zanro['genre_name'];?></td>
        <td><?=$filmas_zanro['movies_id'];?></td>
        <td><?=$filmas_zanro['pavadinimas'];?></td>
    <td><?=$filmas_zanro['metai'];?></td>
    <td><?=$filmas_zanro['rezisierius'];?></td>
    <td><?=$filmas_zanro['imdb'];?></td>
    <td><?=$filmas_zanro['aprasymas'];?></td>
    </tr>
    <?php endforeach;?>
</table>

<?php endif;?>

