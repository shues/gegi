<?php
class DataModule {
    private $inpData;
    private static $columns = [];
    private static $rows = [];

    function __construct(){
        $fp = @fopen("data.json","r");
        $js = json_decode(fgets($fp),true);
        $this->inpData = $this->packData($js);
//        $this->setColumns();
        $this->setRows();
//        $this->inpData = $js;
    }

    private function packData($inp){
        $res = [];
        forEach($inp["Rows"] as $rowName=>$rowData){
            forEach($rowData as $key=>$value){
                $res[$rowName][$inp["Columns"][$key]] = $value;
            }
        }
        $res['Columns'] = $inp['Columns'];
        return $res;
    }

    function getHeaders($inp=''){
        $res=[];
        if($inp==''){
            $inp = $this->rows;
        }
        forEach($inp as $rowName=>$rowData){
            if($rowName != "Columns"){
                $res[] = $rowName;
            }
        }
        return $res;
    }

    function getColumns($inp=''){
        if($inp == ''){
            $inp = $this->inpData;
        }
        return $inp["Columns"];
    }

    private function setRows(){
        $res=[];
        if(count($this->rows)>0){return;}
        forEach($this->inpData as $key=>$val){
            if(isSet($_GET[$key])){
                $res[$key] = $val;
            }
        }
        if(count($res) > 0){
            $this->rows = $res;
        }
    }

    function getRows(){
        print_r($this->rows);
        return $this->rows;
    }

    function pChartSeriesData(){
        return $this->rows;
    }

    function pChartLabelsData($inp=''){
        if($inp==''){
            $inp = $this->rows;
        }
        $ret = count($inp)-1;
        $res = [];
        forEach($inp["Columns"] as $key=>$val){
            $col=0;
            while($col<$ret){
                $res[] = $val;
                $col++;
            }
        }
        print_r($res);
        return $res;
    }
}
