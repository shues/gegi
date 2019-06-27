<?php
    use PHPUnit\Framework\TestCase;
    require_once '../Modules/DataModule.php';

    class DataModuleTests extends TestCase{
        private $dataModule;

        public function testPackData(){
            $dm = new DataModule();
            $inp = ["Rows"=>["a"=>["a1","a2","a3"],"b"=>["b1","b2","b3"]],"Columns"=>["k1","k2","k3"]]; 
            $this->assertEquals([
                "a"=>["k1"=>"a1","k2"=>"a2","k3"=>"a3"],
                "b"=>["k1"=>"b1","k2"=>"b2","k3"=>"b3"],
                "Columns"=>["k1","k2","k3"]
                ],$dm->packData($inp));
        }

        public function testGetHeaders(){
            $dm = new DataModule();
            $arr = ["a"=>[1,2,3],"b"=>[2,3,4],"Columns"=>[6,7,8]];
            $this->assertEquals(array("a","b"),$dm->getHeaders($arr));
        }

        public function testGetColumns(){
            $dm = new DataModule();
            $arr = ["Rows"=>["a","b"], "Columns"=>["c","d","e"]];
            $this->assertEquals(array("c","d","e"),$dm->getColumns($arr));
        }
        
        public function testPChartLabelsData(){
            $dm = new DataModule();
            $arr = ["a"=>[1,2,3],"b"=>[4,5,6], "Columns"=>["c","d","e"]];
            $this->assertEquals(array("c","c","d","d","e","e"),$dm->pChartLabelsData($arr));

        } 
    }

