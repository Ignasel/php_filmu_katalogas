<?php session_start();
connectDB();
if (isset($_POST['submit'])){
    $userName = $_POST['username'];
    $trans = allUsers($userName);
    var_dump($trans);


    if($_POST['username'] == $trans['users'] && $_POST['password'] == $trans['password']){
        $_SESSION['username'] = "admin";
        header('Location:/Igno2/?page=filmu-valdymas');
    } else{
        echo "Neteisingi prisijungimo duomenys";
    }
}

?>

<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Vartotojo vardas</label>
        <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Vartotojo vardas" name="username">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
