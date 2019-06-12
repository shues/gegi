<?php

    require_once('DataModule.php');
    $dm = new DataModule();
    $graphTypes = [];

    $graphTypes['cubicCurve'] = 'Cubic curve';
    $graphTypes['overlayBar'] = 'Overlay bar';


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
                <select class="graphType" name="graphType">
                    <?php
                        forEach($graphTypes as $key=>$value){
                            $opt = '<option value="'.$key.'"';
                            if(isSet($_GET['graphType'])){
                                if($_GET['graphType'] == $key){
                                    $opt .= " selected>";
                                }else{
                                    $opt .= ">";
                                }
                                $opt .= $value.'</option>';
                            }
                            else{
                                $opt .= ">$value</option>";
                            }
                            echo $opt;
                        }
                    ?>
                </select>
                <input type="submit" value="bild">
            </form>
        </div>
        <div class="content">
            <p id="tableCont">
                <?php echo $dm->buildTable($inpData) ?>
            </p>
            <p id="graphCont">
            </p>
                <script src="./makeImg.js"></script>
        </div>
    </body>
    </html>
