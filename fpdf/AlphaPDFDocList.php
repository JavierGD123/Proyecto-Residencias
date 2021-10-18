<?php
//require('fpdf.php');

class AlphaPDF extends FPDF
{
    protected $extgstates = array();

    // alpha: real value from 0 (transparent) to 1 (opaque)
    // bm:    blend mode, one of the following:
    //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
    //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
    function SetAlpha($alpha, $bm='Normal')
    {
        // set alpha for stroking (CA) and non-stroking (ca) operations
        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
        $n = count($this->extgstates)+1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
            $this->PDFVersion='1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++)
        {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_put('<</Type /ExtGState');
            $parms = $this->extgstates[$i]['parms'];
            $this->_put(sprintf('/ca %.3F', $parms['ca']));
            $this->_put(sprintf('/CA %.3F', $parms['CA']));
            $this->_put('/BM '.$parms['BM']);
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_put('/ExtGState <<');
        foreach($this->extgstates as $k=>$extgstate)
            $this->_put('/GS'.$k.' '.$extgstate['n'].' 0 R');
        $this->_put('>>');
    }

    function _putresources()
    {
        $this->_putextgstates();
        parent::_putresources();
    }

    // Cabecera de página
  function Header()
  {
        // Logo
    $this->Image('img/LogoCabecera.jpg',20,6,24,24);
     
        // /$this->Image('logo.png',10,8,33);
        // Arial bold 15
           // $this->SetFont('Arial','B',15);
        // Movernos a la derecha
       // $this->Cell(80);
        // Título
            //$this->Cell(30,10,'Title',1,0,'C');

     //$this->SetXY(50,45);
     //$this->Image('img/LogoCabecera.jpg',85,7,35,35);

     //$this->Line(30,42,180,42);


     // $this->SetFont('Arial','B',12); //Establecemos tipo de fuente, negrita y tamaño 16
     // $this->SetXY(50,45);
     // $this->Cell(0,0,utf8_decode('SINDICATO DE EMPLEADOS DEL H. AYUNTAMIENTO
     //  '),0,1);
     // $this->SetXY(73,50) ;
     // $this->Cell(0,0,utf8_decode('DE LÁZARO CÁRDENAS, MICH.'),0,1);

        // Salto de línea
    $this->Ln(20);

    //  $this->SetAlpha(0.1);
    // $this->Image('img/logocrede.png',70,50,160);
    // $this->SetAlpha(1);


}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    // $this->SetFont('Arial','',8);
    // //
    //     // $this->SetTextColor(0,0,0);
    // $this->Line(30,280,180,280);
    // $this->Cell(0,2,utf8_decode('And. Chihuahua #14, Col. Primer  Sector de Fidelac, Cd. Lázaro Cárdenas,Michoacán'),0,1,'C');

    // $this->SetX(85);
    // $this->Cell(1,6,utf8_decode('Teléfonos  '),0,0,'C');

    // $this->SetFont('Arial','B',8);
    // $this->SetX(115);
    // $this->Cell(1,6,utf8_decode('753 53 7 91 22   y   753 53 7 68 32'),0,0,'C');

        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


class PDF extends FPDF
{
// Cabecera de página

}


?>