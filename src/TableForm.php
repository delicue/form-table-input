<?php
namespace CueForm;
class TableForm {
    private array $headerRows = [];
    public array $bodyInputs = [];
    private array $footerRows = [];
    private int $bodyColCount = 0;

    public $class = 'custom-table';
    public int $headerRowspan = 1;

    public function __construct(public array $headers, public int $bodyRowsCount, public array|null $footers,) {
        //push all headers to headerRows
        $this->createHeaderRows($this->headers);
        // $this->createFooterRows($this->footers);
    }

    private function createHeaderRows(array $headers): void {
        array_push($this->headerRows, $headers);
        $subheaders = [];

        //Find all headers that contain subheaders
        foreach($headers as $header) {
            if(is_array($header->subheaders)) {
                if(count($header->subheaders) > 0) {
                    $header->scope = 'colgroup';
                    $subheaders = array_merge($subheaders, $header->subheaders);
                }
            }
            else {
                if($header->rowspan > $this->headerRowspan)
                    $this->headerRowspan = $header->rowspan;
                array_push($subheaders, null);
            }
        }
        
        if(count($subheaders)){
            $this->createHeaderRows($subheaders);
        }
    }

    public function __toString(): string
    {
        //Header Rows
        $headers = "<thead>\n";
        foreach($this->headerRows as $row){
            $headers .= "<tr>\n";
            foreach($row as $header){
                //If the header column has no subheaders, increase rowspan
                if(!$header->subheaders){
                    $header->rowspan++;
                    $this->bodyColCount++;
                }
                $headers .= "{$header}\n";
            }
            $headers .= "</tr>\n";
        }
        $headers .= "</thead>\n";

        //Body Rows
        $body = "<tbody>\n";
        for($row = 0; $row < $this->bodyRowsCount; $row++){
            $body .= "<tr id='bodyRow{$row}'>\n";
            for($col = 0; $col < $this->bodyColCount; $col++){
                $body .= "<td><input name='bodyRow{$row}Input{$col}' type='text'></td>\n";
                $this->bodyInputs[$row][$col] = "bodyRow{$row}Input{$col}";
            }
            $body .= "</tr>\n";
        }
        $body .= "</tbody>\n";

        //Footer Rows
        $footer = "<tfoot>";
        $footer .= "</tfoot>";

        return "<form action='./src/submit.php' method='post'><table class='{$this->class}'>\n{$headers}{$body}</table><input type='submit'></form>";
    }
};