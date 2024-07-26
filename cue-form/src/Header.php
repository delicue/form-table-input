<?php
namespace CueForm;
class Header {
    public $name = '';
    public $scope = 'col';
    public $rowspan = 1;
    public $colspan = 1;
    public $inputType = 'text';

    public function __construct(
        public $id,
        public $contents,
        public $subheaders=array(),
        public $superheaders=array()
    ){
        $this->colspan = count($this->subheaders);
    }

    public function __toString()
    {
        return "<th id='$this->id' scope='$this->scope' colspan='$this->colspan' rowspan='$this->rowspan'>$this->contents</th>";
    }
};
?>