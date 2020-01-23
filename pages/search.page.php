<h2>Filmo paieškos laukelis </h2>

<?php
$dsn= "mysql:host=$host; dbname=$db";
try{
    $conn = new PDO($dsn, $username, $password);
    if($conn){
        $stmt = $conn->query("SELECT * FROM filmai");
        $filmai = $stmt->fetchAll();

    }
}catch (PDOException $e){

    echo $e->getMessage();
}?>


<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Įveskite filmo pavadinimą</label>
        <input type="text" class="form-control" id="searchByTitle"  placeholder="Filmo pavadinimas" name="titleForSearch">
    </div>

    <button type="submit" class="btn btn-primary" name="searchForIT">Submit</button>
</form>


<?php
    if (isset($_POST['searchForIT'])) :?>

<?php
$searchIT = $_POST['titleForSearch'];
        $uzklausa = $conn->query ("SELECT id, pavadinimas, metai, rezisierius, imdb,
                                        aprasymas FROM filmai
                                        WHERE pavadinimas like '%$searchIT%'");
        $filmams = $uzklausa->fetchAll();
        $uzklausa->bindValue(1, "%$searchIT%", PDO::PARAM_STR); // Ką reiškia ši eilutė?

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