<h2>Filmai pagal žanrą</h2>
<?php
$dsn= "mysql:host=$host; dbname=$db";
try{
    $conn = new PDO($dsn, $username, $password);
    if($conn){
        $stmt = $conn->query("SELECT pavadinimas, id FROM zanrai");
        $zanrai = $stmt->fetchAll();

    }
}catch (PDOException $e){

    echo $e->getMessage();
}?>

<ul>
<?php

foreach ($zanrai as $zanras):?>
        <li>
        <a href="?page=zanrai&id=<?=$zanras['id']?>"><?=$zanras['pavadinimas']?></a>
        </li>
<?php endforeach;?>
</ul>

<?php
if (isset($_GET['id'])){
            $value=$_GET['id'];
            $stmt = $conn->query("SELECT filmai.id as movies_id, filmai.pavadinimas, filmai.metai, filmai.rezisierius, filmai.imdb,
                                        filmai.aprasymas, filmai.zanrai_id, zanrai.id, zanrai.pavadinimas as genre_name FROM filmai
                                        INNER JOIN  zanrai ON filmai.zanrai_id=zanrai.id
                                        WHERE zanrai_id = $value ");
        $films_by_genre = $stmt->fetchAll();

}?>


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

