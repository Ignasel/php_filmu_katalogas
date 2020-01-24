<h2>Valdyti filmus</h2>
<?php
$dsn= "mysql:host=$host; dbname=$db";
try{
    $conn = new PDO($dsn, $username, $password);
    if($conn){
        $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        ORDER BY movies_id");
        $filmai = $stmt->fetchAll();

    }
}catch (PDOException $e){

    echo $e->getMessage();
}?>
<form>
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
