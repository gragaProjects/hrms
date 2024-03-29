<?php
require_once  dirname(__FILE__) . '/tcpdf/examples/tcpdf_include.php';
class MYPDF extends TCPDF {

    //Page header
/*    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
*/
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
       $date = date("d/M/Y ");  
        $this->Cell(0, 10,$date, 0, $ln=0, 'L', 0, '', 0, false,  'T', 'M');
        // Page number
        $this->Cell(0, 10, 'This Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
 ?>