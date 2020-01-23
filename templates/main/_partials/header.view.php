<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Start Bootstrap </div>
    <div class="list-group list-group-flush">
        <?php foreach ($navigation['leftSide'] as $href => $title):?>
                <a class="nav-link" href="?page=<?=$href;?>"><?=$title;?> <span class="sr-only">(current)</span></a>
                <?php endforeach;?>
    </div>
</div>