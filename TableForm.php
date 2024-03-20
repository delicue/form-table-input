<?php

class TableForm {
    private array $headerRows = array();
    private array $bodyRows = array();
    private int $rows = 4;
    public $class = 'custom-table';

    public function __construct(array $headers, int $rows) {
        //push all headers to headerRows
        array_push($this->headerRows, $headers);
        $this->parseHeaderRows($headers);
        $this->rows = $rows;
    }

    private function parseHeaderRows(array $headers) {
        $subheaders = array();

        //Find all headers that contain subheaders
        foreach($headers as $header){
            if(is_array($header->subheaders) && sizeof($header->subheaders) > 0){
                $header->scope = 'colgroup';
                
                $subheaders = array_merge($subheaders, $header->subheaders);
            }
            else {
                $header->rowspan++;
                array_push($subheaders, null);
            }

            $header->colspan++;
        }
        array_push($this->headerRows, $subheaders);
        $repeat = false;
        foreach($subheaders as $sub){
            if(isset($sub->subheaders)){
                $repeat = true;
                break;
            }
        }
        $this->parseHeaderRows($subheaders);
    }

    private function parseBodyRows($rows) {

    }

    public function __toString()
    {
        $headers = '<thead>';
        foreach($this->headerRows as $row){
            $headers .= "<tr>";
            foreach($row as $header){
                $headers .= $header;
            }
            $headers .= "</tr>";
        }
        $headers .= '</thead>';
        $body = '<tbody>';
        for($i = 0; $i < $this->rows; $i++){
            $body .= "<tr><input type=></tr>";
        }
        return "<table class='$this->class'>" . $headers . "</table>";
    }
};

class Header {
    public $id = '';
    public $name = '';
    public $scope = 'col';
    public $rowspan = 1;
    public $colspan = 1;
    public $contents = '';
    public $inputType = 'text';
    public array $subheaders = array();
    public array $superheaders = array();

    public function __construct($id, $contents, $subheaders=array(), $superheaders=array())
    {
        $this->id = $id;
        $this->contents = $contents;
        $this->subheaders = $subheaders;
        $this->superheaders = $superheaders;
    }

    public function __toString()
    {
        return "<th id='$this->id' scope='$this->scope' colspan='$this->colspan' rowspan='$this->rowspan'>$this->contents</th>";
    }
};

$tableForm = new TableForm([
    new Header("bookHeader", "BookID", [
        new Header("fictionHeader","Fiction"),
        new Header("nonfictionHeader", "Non-Fiction", [
            new Header("boyHeader", "Boy")
        ])
    ]),
    new Header("authorHeader", "Author", [
        new Header("maleHeader", "Male"),
        new Header("femaleHeader", "Female")
    ]),
    new Header("titleHeader", "Title")
], 7);
echo $tableForm;
?>