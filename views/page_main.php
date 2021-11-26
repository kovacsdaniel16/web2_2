<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mindentudás Egyeteme</title>

        <script type = "text/javascript" src="<?php echo SITE_ROOT?>js/jquery-2.1.0.min.js"></script>
        <script type = "text/javascript" src="<?php echo SITE_ROOT?>js/felsofoku.js"></script> <!--itt a JS a vezérlő, azért töltöm be előbb-->


        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css"><!--alapértelmezett formázás-->
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?><!--betöltött oldalak formázása-->
    </head>
    <body>
        <header>
            <div id="user"><em><?php
            switch ($_SESSION['userlevel']) {
                case "__1":
                    echo "Admin";
                    break;

                case "_1_":
                    echo "Regisztrált látogató";
                    break;
                
                default:
                    echo "Látogató";
                    
            }
            ?></em></div>
            <h1 class="header">Mindentudás Egyeteme</h1>
            <img src="<?php echo SITE_ROOT?>images/mte.jpg" alt="logo"/>
        </header>
        <nav>     <!--menü-->
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>   <!--oldalsó rész-->
                <br>
        </aside>
        
        <div class="render">
        <section>  <!--render-->

            <?php if($viewData['render']) include($viewData['render']); ?>

        </section>
        </div>

        <script type = "text/javascript" src="<?php echo SITE_ROOT?>js/test.js"></script>

        <footer>&copy; Kovács Dániel <?= date("Y") ?></footer>
    </body>
</html>
