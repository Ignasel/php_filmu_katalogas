<?php
connectDB();
        $thisId = $_GET['id'];
        $filmai = MoviebyId($thisId);
if (isset($_POST['submit'])) {
    DeleteFilm($thisId);
    header('Location:/Igno2/?page=visi');
}
?>


<h3>Ar tikrai norite ištrinti šį filmą?</h3>
<table class="table table-bordered">
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

<form method="post">
<button type="submit" class="btn btn-primary" name="submit">Ištrinti</button>
</form>
