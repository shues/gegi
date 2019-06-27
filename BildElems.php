<?php
    require_once('DataModule.php');

    class BildElems{

        private $dm;
        private $graphTypes;

        function __construct(){
            $this->dm = new DataModule();
            $this->graphTypes = [];
            $this->graphTypes['cubicCurve'] = 'Cubic curve';
            $this->graphTypes['overlayBar'] = 'Overlay bar';
        }

        function setHeaders(){
            $headersList = [];
            $headersList = $this->dm->getHeaders();
            $res = "";
            forEach($headersList as $key=>$val){
                $res .= '<input type="checkbox" name="';
                $res .= $val;
                $res .= '"';
                if(isSet($_GET[$val])){
                   $res .= ' checked'; 
                }
                $res .= ">$val<br>";
            }
            return $res;
        }

        function setGraphTypes(){
            $res = '<select class="graphType" name="graphType">';
            forEach($this->graphTypes as $key=>$value){
                $res .= '<option value="'.$key.'"';
                if(isSet($_GET['graphType'])){
                    if($_GET['graphType'] == $key){
                        $res .= " selected>";
                    }else{
                        $res .= ">";
                    }
                    $res .= $value.'</option>';
                }
                else{
                    $res .= ">$value</option>";
                }
            }
            return $res;
        }

        function buildTable(){
            $table = '';
            $tabHead = '';
            $tabBody = '';
            forEach($this->dm->getColumns() as $key=>$value){
                $tabHead .= '<th class="dataCol">'.$value.'</th>';
            }

            forEach($this->dm->getRows() as $key=>$row){
                $tabBody .= "<tr><td>$key</td>";
                forEach($row as $num=>$value){
                    $tabBody .= "<td>$value</td>";
                }
                $tabBody .= '</tr>';
            }
            $table = '<table><thead><tr><th class="firstCol"></th>';
            $table .= $tabHead;
            $table .= '</tr></thead>';
            $table .= '<tbody>';
            $table .= $tabBody;
            $table .= '</tbody></table>';

            return $table;
        }
    }
?>
