<?php
class TableForm {
    private array $headerRows;

    public function __construct(array $headers=[new Header(null, null)]) {
        $hasSubheaders = false;
        
        for($i = 0; $i < sizeof($headers); ++$i){
            
        }
    }

    private function parseHeaderRows(Array|String $headers) {
        $keys = array_keys($headers);
        $firstKey = array_shift($keys);
        $firstVal = $headers[$firstKey];

        $row = "<th scope='col'>$firstVal</th>\n" . $this->parseHeaderRows($headers);
    }
};

class Header {
    public $id = '';
    public $name = '';
    public $scope = 'col';
    public $rowspan = '1';
    public $contents = '';
    public array $subheaders = array();
    public $superheaders = array();

    public function __construct($id, $contents, $subheaders=array(), $superheaders=array())
    {
        $this->id = $id;
        $this->contents = $contents;
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
//echo $tableForm;
?>