<?php
if (isset($_GET['page'])){
    switch (htmlspecialchars($_GET['page'])) {
        case 'visi':
            include('pages/all_films.page.php');
            break;
        case 'zanrai':
            include('pages/genres.page.php');
            break;
        case 'paieska':
            include('pages/search.page.php');
            break;
        case 'apie':
            include('pages/about.page.php');
            break;
        case 'filmu-valdymas':
            include ('pages/add_movie.page.php');
        default:
    }
}else{
    include ('pages/main.page.php')
;}