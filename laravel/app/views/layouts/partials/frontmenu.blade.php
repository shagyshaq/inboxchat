<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <?php if (!empty($menus['mainMenu'])) {
                ?>
                <ul class="nav navbar-nav">
                    <?php foreach ($menus['mainMenu'] as $main) { ?>

                        <li class="active dropdown">
                            <a href="#">{{$main}}</a>     
                            <?php foreach ($menus['childMenu'] as $child) {
                                if (array_search($main, $menus['mainMenu']) == array_search($child, $menus['childMenu'])) {
                                    ?>

                                    <ul class="dropdown-menu">
                                        <?php foreach ($child as $childTitle) { ?>
                                            <li class="dropdown">
                                                <a href="#">{{$childTitle}}</a> 
                                            </li>
                                        <?php } ?>
                                        </ul>
                            <?php }} ?>  
                        </li>
    
                       <?php } ?>

                </ul>
              <?php } ?>   
        </div>
    </div>
</nav>