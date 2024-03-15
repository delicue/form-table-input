<?php

class TableForm {
    private array $headerRows = array();

    public function __construct(array $headers) {
        $this->parseHeaderRows($headers);
    }

    private function parseHeaderRows(Array|String $headers) {
        //push all headers to headerRows
        array_push($this->headerRows, $headers);
        //Find all headers that contain subheaders
        $superheaders = array_filter($headers, function(Header $header) {
            return sizeof($header->subheaders) > 0;
        });

        $subheaders = array();

        //iterate through superheaders
        foreach($superheaders as $superheader)
            //push all the subheaders into their own array
            array_push($subheaders, $superheader->subheaders);
        //push all subheaders to headerRows
        array_push($this->headerRows, $subheaders);
    }

    public function __toString()
    {
        $headers = '';
        foreach($this->headerRows as $row){
            $headers .= "<tr>";
            foreach($row as $header){
                $headers .= $header;
            }
            $headers .= "</tr>";
        }
        return "<table>" . $headers . "</table>";
    }
};

class Header {
    public $id = '';
    public $name = '';
    public $scope = 'col';
    public $rowspan = '1';
    public $contents = '';
    public $colNum;
    public array $subheaders = array();
    public $superheaders = array();

    public function __construct($id, $contents, $subheaders=array(), $superheaders=array())
    {
        $this->id = $id;
        $this->contents = $contents;
        $this->subheaders = $subheaders;
        $this->superheaders = $superheaders;
    }

    public function __toString()
    {
        return "<th id='$this->id' scope='$this->scope' rowspan='$this->rowspan'>$this->contents</th>";
    }
};

$tableForm = new TableForm([
    new Header("bookHeader", "BookID", ["Fiction", "Non-Fiction"]),
    new Header("authorHeader", "Author", ["Male", "Female"]),
    new Header("titleHeader", "Title")
]);
echo $tableForm;
?>