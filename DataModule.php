<?php
class DataModule {
    private $inpData;

    function __construct(){
        $fp = @fopen("data.json","r");
        $this->inpData = json_decode(fgets($fp));
//        print_r($this->inpData);
    }

    function buildTable($inpData){
        $tabHead = '';
        $tabBody = '';
        forEach($this->inpData->Columns as $key=>$value){
            $tabHead .= '<th class="dataCol">'.$value.'</th>';
        }

        forEach($this->inpData->Rows as $key=>$row){
            $tabBody .= "<tr><td>$key</td>";
            forEach($row as $num=>$value){
                $tabBody .= "<td>$value</td>";
            }
            $tabBody .= '</tr>';
        }
        return '<table>
                    <thead>
                        <tr><th class="firstCol"></th>'.$tabHead.'</tr>
                    </thead>
                    <tbody>'.$tabBody.'</tbody>
                </table>';
    }

    function pChartSeriesData(){
        return $this->inpData->Rows;
    }

    function pChartLabelsData(){
        $ret = count($this->inpData->Rows);
        $res = [];
        forEach($this->inpData->Columns as $key=>$val){
            $col=0;
            while($col<$ret){
                $res[] = $val;
                $col++;
            }
        }
        return $res;
    }
}
