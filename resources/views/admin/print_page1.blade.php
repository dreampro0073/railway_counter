<?php 
        @require(app_path().'/libraries/fpdf183/fpdf.php');

	// class PDF extends FPDF 
	// { 
	//     // Page header 
	//     function Header() 
	//     { 
	//         // GFG logo image 
	//         // $this->Image('geeks.png', 30, 8, 20); 
	          
	//         // // GFG logo image 
	//         // $this->Image('geeks.png', 160, 8, 20); 
	          
	//         // Set font-family and font-size 
	//         $this->SetFont('Times','B',20); 
	          
	//         // Move to the right 
	//         $this->Cell(80); 
	          
	//         // Set the title of pages. 
	//         $this->Cell(30, 20, 'Welcome to GeeksforGeeks', 0, 2, 'C'); 
	          
	//         // Break line with given space 
	//         $this->Ln(5); 
	//     } 
	       
	//     // Page footer 
	//     function Footer() 
	//     { 
	//         // Position at 1.5 cm from bottom 
	//         $this->SetY(-15); 
	          
	//         // Set font-family and font-size of footer. 
	//         $this->SetFont('Arial', 'I', 8); 
	          
	//         // set page number 
	//         $this->Cell(0, 10, 'Page ' . $this->PageNo() . 
	//               '/{nb}', 0, 0, 'C'); 
	//     } 
	// } 

 //    $filename = "AppName_Day_"."_gen_".date("Y-m-d_H-i").".pdf";
	   
	// header("Content-Type: application/pdf");
	// header("Pragma: public");
	// header("Expires: 0");
	// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	// header("Content-Type: application/force-download");
	// header("Content-Type: application/octet-stream");
	// header("Content-Type: application/download");
	// header('Content-Disposition: attachment; filename="'.$filename.'"');
	// header("Content-Transfer-Encoding: binary ");
	// $pdf = new FPDF("P","mm","A4");
	// $pdf->AddPage();
	
	// $pdf->Output();
?>