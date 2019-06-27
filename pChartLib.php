<?php
    require_once("./lib/pChart/pData.class");
    require_once("./lib/pChart/pChart.class");
    require_once("./lib/pChart/pCache.class");

    require_once("./DataModule.php");

class pChartLib{
    private $DataSet;
    private $Test;

    private $TotalHeight;
    private $TotalWidth;
    private $BorderWidth;
    private $GraphAreaHeight;
    private $GraphAreaWidth;
    private $HeaderFontSize;
    private $LegendFontSize;
    private $LabelsFontSize;
    private $GraphName;
    private $GraphType;

    function __construct(){
        $this->GetParameters();
        $this->SetData();
        $this->initGraph();
        $this->DrawGraph();
        $this->FinishGraph();
    }

    private function getParameters(){
//        echo "get\n";
        if(isSet($_GET['th'])){
            $this->TotalHeight = $_GET['th'];
        }else{
            $this->TotalHeight = 230;
        }
 
        if(isSet($_GET['tw'])){
            $this->TotalWidth = $_GET['tw'];
        }else{
            $this->TotalWidth = 700;
        }

        if(isSet($_GET['bw'])){
            $this->BorderWidth = $_GET['bw'];
        }else{
            $this->BorderWidth = 5;
        }   
        
        if(isSet($_GET['gah'])){
            $this->GraphAreaHeight = $_GET['gah'];
        }else{
            $this->GraphAreaHeight = 150;
        }  
        
        if(isSet($_GET['gaw'])){
            $this->GraphAreaWidth = $_GET['gaw'];
        }else{
            $this->GraphAreaWidth = 540;
        } 
        
        if(isSet($_GET['hfs'])){
            $this->HeaderFontSize = $_GET['hfs'];
        }else{
            $this->HeaderFontSize = 10;
        } 
        
        if(isSet($_GET['lgfs'])){
            $this->LegendFontSize = $_GET['lgfs'];
        }else{
            $this->LegendFontSize = 8;
        } 
        
        if(isSet($_GET['lbfs'])){
            $this->LabelsFontSize = $_GET['lbfs'];
        }else{
            $this->LabelsFontSize = 8;
        }

        if(isSet($_GET['gn'])){
            $this->GraphName = $_GET['gn'];
        }else{
            $this->GraphName = "MyGraph";
        }

        if(isSet($_GET['gt'])){
            $this->GraphType = $_GET['gt'];
        }else{
            $this->GraphType = "cubicCurve";
        }
    }

    private function setData(){
        $dm = new DataModule();
        $sd = $dm->getRows();
        print_r($sd);
        $labels = $dm->pChartLabelsData();

        $this->DataSet = new pData();
        forEach($sd as $rowName => $rowData){
            $this->DataSet->AddPoint($rowData,$rowName);
        }
        $this->DataSet->AddPoint($labels,"months");
        $this->DataSet->AddAllSeries();
//        $this->DataSet->SetAbsciseLabelSerie();
        $this->DataSet->SetAbsciseLabelSerie("months");
    }

    private function initGraph(){
//        echo "init\n";
        $this->Test = new pChart($this->TotalWidth,$this->TotalHeight);
        $this->Test->setFontProperties("Fonts/tahoma.ttf",$this->LabelsFontSize);
        $this->Test->setGraphArea(  50,
                                    30,
                                    50+$this->GraphAreaWidth,
                                    30+$this->GraphAreaHeight);
        $this->Test->drawFilledRoundedRectangle(
                                1+$this->BorderWidth,
                                1+$this->BorderWidth,
                                $this->TotalWidth - 1 - $this->BorderWidth,
                                $this->TotalHeight - 1 - $this->BorderWidth,
                                5,240,240,240);
        $this->Test->drawRoundedRectangle(0,0,
                                        $this->TotalWidth-1,
                                        $this->TotalHeight-1,
                                        5,230,230,230);
        $this->Test->drawGraphArea(255,255,255,TRUE);
        $this->Test->drawScale( $this->DataSet->GetData(),
                                $this->DataSet->GetDataDescription(),
                                SCALE_NORMAL,150,150,150,TRUE,0,1);
        $this->Test->drawGrid(4,TRUE,230,230,230,50);
    }
    
    
    private function drawGraph(){
//        echo "draw\n";
//        echo $this->GraphType;
        switch($this->GraphType){
            case "cubicCurve":
                $this->drawCubicCurveGraph();
                break;
            case "overlayBar":
                $this->drawOverlayBarGraph();
                break;
            default:
                $this->drawCubicCurveGrapg();
                break;
        }
    }

    private function drawCubicCurveGraph(){
//        echo "cubic\n";
        $this->DataSet->RemoveSerie("months");
        $this->Test->drawCubicCurve($this->DataSet->GetData(),
                                    $this->DataSet->GetDataDescription());
    }


    private function drawOverlayBarGraph(){
//        echo "bar\n";
        $this->DataSet->RemoveSerie("months");
        $this->Test->drawOverlayBarGraph($this->DataSet->GetData(),
                                  $this->DataSet->GetDataDescription(),TRUE);

    }


    private function finishGraph(){
//        echo "fin\n";
        $this->Test->setFontProperties("Fonts/tahoma.ttf",$this->LegendFontSize);
        $this->Test->drawLegend($this->GraphAreaWidth + 80,
                                30,
                                $this->DataSet->GetDataDescription(),
                                255,255,255);
        $this->Test->setFontProperties("Fonts/tahoma.ttf",$this->HeaderFontSize);
        $this->Test->drawTitle(50,22, $this->GraphName,50,50,50,585);
        $this->Test->Stroke("$this->GraphName.png");
    }
}   
$pCL = new pChartLib();
?>
