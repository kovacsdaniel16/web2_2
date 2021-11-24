<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mindentudás Egyeteme</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body>
        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
            <h1 class="header">Mindentudás Egyeteme</h1>
            <img src="./images/mte.jpg" alt="logo"/>
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
        <footer>&copy; Kovács Dániel <?= date("Y") ?></footer>
    </body>
</html>
