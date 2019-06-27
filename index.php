<?php
    require_once('BildElems.php');
    $be = new BildElems();


?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test task</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="settings">
            <form action="index.php" method="GET">
                <?php echo $be->setHeaders(); ?>

                <?php echo $be->setGraphTypes(); ?>
                </select>
                <br>
                <input class="button" type="submit" value="bild">
            </form>
        </div>
        <div class="content">
            <p id="tableCont">
                <?php echo $be->buildTable() ?>
            </p>
            <p id="graphCont">
            </p>
                <script src="./makeImg.js"></script>
        </div>
    </body>
    </html>
