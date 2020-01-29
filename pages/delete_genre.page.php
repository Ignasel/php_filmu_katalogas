<?php
$thisid = $_GET['id'];
$zanrai = moviesByGenre($thisid);
if (isset($_POST['submit'])) {
    DeleteGenre($thisid);
    header('Location:/Igno2/?page=zanru-valdymas');
}
?>

<h3>Ar tikrai norite ištrinti šį žanrą?</h3>
<table class="table table-bordered">
    <tr>
        <?php
        foreach ($zanrai as $zanras):?>
    </tr>
    <tr>
        <td><?=$zanras['id'];?></td>
        <td><?=$zanras['pavadinimas'];?></td>
    <?php endforeach;?>
</table>
<form method="post">
    <button type="submit" class="btn btn-primary" name="submit">Ištrinti</button>
</form>
