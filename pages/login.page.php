<?php session_start();
connectDB();
$users = allUsers();
if (isset($_POST['submit'])){
    foreach ($users as $user)
    if($_POST['userName'] == $user['users'] && $_POST['password'] == $user['password']){
        $_SESSION['username'] = 'admin';
        header('Location:/Igno2/?page=filmu-valdymas');
    } else{
        echo "Neteisingi prisijungimo duomenys";
    }
}
session_destroy()
?>

<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Vartotojo vardas</label>
        <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Vartotojo vardas" name="userName">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
