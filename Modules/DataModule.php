<?php
class DataModule{
    private $inpData=[];

    function __construct($mode='file', $src='data.json'){
        $res = '';
        switch($mode){
            case 'file':
                $res = $this->loadFromFile($src);
            break;
            default:
                $res = $this->loadFromFile($src);
            break;
        }
        $this->inpData = $res;
    }

    function loadFromFile($fileName){
        $fp = @fopen('../src/'.$fileName);
        $res = json_decode(fgets($fp));
        return $res;
    }

    function getProgramsHeaders(){
        $res = [];
        forEach($this->inpData->Rows as $programName){
            $res[] = $programName;
        }
        return $res;
    }
}
?>
