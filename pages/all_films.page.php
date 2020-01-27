<h2>Visi filmai</h2>
<?php
    connectDB();
   $filmai = allMovies();
?>
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
    </tr>
    <?php endforeach;?>
</table>
