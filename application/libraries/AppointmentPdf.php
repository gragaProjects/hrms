<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once  dirname(__FILE__) . '/tcpdf/examples/tcpdf_include.php';
class AppointmentPdf extends TCPDF {

    public $header_img = '';
    public $footer_img = '';
    public $watermark_img = '';

   public function Header()
    {
        // Logo
        $image_file = ($this->watermark_img) ? $this->watermark_img : FCPATH . 'assets/images/logo/logo-white.png';
        $image = ($this->header_img) ? $this->header_img : FCPATH . 'assets/images/header.png';


    if($this->header_img & $this->footer_img & $this->watermark_img){
       
    // print_r('Test'); die();
    $this->Image($image, 10, 1, 190, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false); //6 : png

    // Move the cursor below the image
    $this->SetY($this->GetY() + 25);


    $this->SetLineWidth(0.5);
    // Add a line below the image
    $this->Cell(190, 0, '', 'T');


   
    }else{
       // First name
        $this->SetMargins(10, 10, 10, true);
        $this->SetFooterMargin(0);
        $this->setHtmlVSpace(array(
            'h1' => array(0 => array('h' => '', 'n' => 0), 1 => array('h' => '', 'n' => 0)),
            'p' => array(0 => array('h' => '', 'n' => 0), 1 => array('h' => '', 'n' => 0)),
            ));
        $html = <<<EOD
        <table cellpadding="5" style="text-align:center;">
        <tr>
             <td width="80%" align="" style="border-bottom:2px solid black;">
           <p></p>
            <p style="font-size:24px; text-align:left">Graga Technologies Co WLL</p>
            </td>
            <td style="border-bottom:2px solid black;" width="20%" class="text-right">
            <p></p>
            <img src="$image_file"  style="width: 100px;" /></td>
               
             <td width="2%"></td>
        </tr>
    </table>
EOD;
    }

   //   echo $this->header_img;  echo "<br>";
   //  echo $this->footer_img; echo "<br>";
   //  echo $this->watermark_img;
   // die();



        // First name
//         $this->SetMargins(10, 10, 10, true);
//         $this->SetFooterMargin(0);
//         $this->setHtmlVSpace(array(
//             'h1' => array(0 => array('h' => '', 'n' => 0), 1 => array('h' => '', 'n' => 0)),
//             'p' => array(0 => array('h' => '', 'n' => 0), 1 => array('h' => '', 'n' => 0)),
//             ));
//         $html = <<<EOD
//         <table cellpadding="5" style="text-align:center;">
//         <tr>
//              <td width="80%" align="" style="border-bottom:2px solid black;">
//            <p></p>
//             <p style="font-size:24px; text-align:left">Graga Technologies Co WLL</p>
//             </td>
//             <td style="border-bottom:2px solid black;" width="20%" class="text-right">
//             <p></p>
//             <img src="$image_file"  style="width: 100px;" /></td>
               
//              <td width="2%"></td>
//         </tr>
//     </table>
// EOD;



// Print text using writeHTMLCell()
      $this->writeHTML($html, true, false, true, false, '');

        // Set margins to position content below header on all pages
    $this->SetMargins(10, 30, 10, true); 


     //water mark

       // Set the alpha value for transparency
        $this->SetAlpha(0.2);

        // Set the position and size of the watermark image
        $this->Image( $image_file, 30, 100, 150, 0, '', '', '', false, 300);

        // Reset alpha value
        $this->SetAlpha(1);

     //water mark

    }
    public function Footer() {
    
    // Position at 15 mm from bottom
    $this->SetY(-20);

    // Set font
    $this->SetFont('helvetica', 'I', 12);

    
    // Output a line above the footer
    $this->SetLineWidth(0.5);
    $this->Line(10, $this->GetY() - 1, $this->getPageWidth() - 10, $this->GetY() - 1);
      $this->SetX(10);

       if($this->header_img & $this->footer_img & $this->watermark_img){
      $this->Image($this->footer_img, 10, 276, 190,20,  "", "", "T", false, 300, "", false, false, 0, false, false, false);//png
       }else{

              // Start the HTML table
        $html = '<table width="100%" style="border-collapse: collapse;">';

        // Left-aligned cell
        $html .= '<tr><td style=""  width="10%"> </td>';

        // Centered cell
        $html .= '<td style="text-align: center; font-size:12px" width="80%">Office No. 412, Bldg. No. 21, Road No. 357, Block No. 304, Manama, Kingdom of Bahrain</td>';

        // Right-aligned cell
        $html .= '<td width="10%"></td></tr>';

        // Left-aligned cell
        $html .= '<tr><td width="10%"> </td>';

        // Centered cell
        $html .= '<td style="text-align: center;font-size:12px" width="80%">Contact Us - Mob: +973 365 14655, +966 50 123 8187, +966 53 43 10577</td>';

        // Right-aligned cell
        $html .= '<td style="text-align: right;"></td></tr>';

        // Left-aligned cell
        $html .= '<tr><td width="10%"> </td>';

        // Centered cell
        $html .= '<td style="text-align: center;font-size:12px" width="80%">Website: <a href="www.agmtechnical.com"> www.agmtechnical.com  </a> | Email is: <a href="mailto: info@agmtechnical.com"> info@agmtechnical.com</a></td>';

        // Right-aligned cell
        $html .= '<td width="10%"></td></tr>';

         


        // Close the HTML table
        $html .= '</table>';
        
        $this->writeHTML($html, true, false, true);

       }

  

    // Output the page number on the right
    // $this->SetX($this->getPageWidth() - 10);
    // $this->Cell(0, 10, 'Page -' . $this->getAliasNumPage(), 0, 0, 'R');



 }
}
 ?>