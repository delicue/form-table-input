<?php
namespace CueForm;
class TableForm {
    private array $headerRows = array();
    private array $bodyRows = array();
    private array $footerRows = array();
    private int $bodyColCount = 0;

    public $class = 'custom-table';
    public int $headerRowspan = 1;

    public function __construct(public array $headers, public int $bodyRowsCount, public array|null $footers,) {
        //push all headers to headerRows
        $this->createHeaderRows($this->headers);
        // $this->createBodyRows($this->bodyRowsCount);
        // $this->createFooterRows($this->footers);
    }

    private function createHeaderRows(array $headers): void {
        array_push($this->headerRows, $headers);
        $subheaders = array();

        //Find all headers that contain subheaders
        foreach($headers as $header) {
            if(is_array($header->subheaders)) {
                if(count($header->subheaders) > 0) {
                    $header->scope = 'colgroup';
                    $subheaders = array_merge($subheaders, $header->subheaders);
                }
            }
            else {
                // $header->rowspan++;
                if($header->rowspan > $this->headerRowspan)
                    $this->headerRowspan = $header->rowspan;
                array_push($subheaders, null);
            }
        }
        
        if(count($subheaders)){
            $this->createHeaderRows($subheaders);
        }
    }

    private function createBodyRows(int $body): void {
        
    }

    private function createFooterRows(array $footers): void {

    }

    public function __toString(): string
    {
        //Header Rows
        $headers = '<thead>';
        foreach($this->headerRows as $row){
            $headers .= "<tr>";
            foreach($row as $header)
                $headers .= $header;
            $headers .= "</tr>";
        }
        $headers .= '</thead>';

        //Body Rows
        $body = '<tbody>';
        for($i = 0; $i < $this->bodyRowsCount; $i++){
            $body .= "<tr><input type='text'></tr>";
        }
        $body .= '</tbody>';

        //Footer Rows
        $footer = '<tfoot>';
        $footer .= '</tfoot>';

        return "<table class='$this->class'>" . $headers . "</table>";
    }
};
?>