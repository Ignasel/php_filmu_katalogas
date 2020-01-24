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
            include ('pages/control.page.php');
            break;
        case 'add_movies.php':
            include ('pages/add_movie.page.php');
            break;
        case 'update_film':
            include ('pages/update_film.page.php');
            break;
        case 'delete_film':
            include ('pages/delete_film.page.php');
            break;
        default:
    }
}else{
    include ('pages/main.page.php')
;}