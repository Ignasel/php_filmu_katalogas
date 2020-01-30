<?php
session_start();
if($_SESSION['username'] == "admin"):?>
<?php
connectDB();
$zanrai = allGenres();

    if (isset($_POST['submit'])){
        header('Location:/Igno2/?page=add_genre');
    }
?>



<h2>Žanrų valdymas</h2>
<form method="post">
    <button type="submit" class="btn btn-primary" name="submit">pridėti naują žanrą</button>
</form>
<table class="table table-bordered">
    <tr>
        <th>Žanro ID</th>
        <th>Žanro pavadinimas</th>
    </tr>
    <tr>
        <?php
        foreach ($zanrai as $zanras):?>
    </tr>
    <tr>
        <td><?=$zanras['id'];?></td>
        <td><?=$zanras['pavadinimas'];?></td>
        <td><a href="?page=delete_genre&id=<?=$zanras['id']?>">Šalinti</a></td>
    </tr>
    <?php endforeach;?>
</table>

<?php else:?>
    <?php header('Location:/Igno2/?page=login')
    ?>
<?php endif;?>