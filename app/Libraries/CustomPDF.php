<?php

namespace App\Libraries;

use TCPDF;

class CustomPDF extends TCPDF
{
    // Override Header() method
    public function Header()
    {
        // Set the image path
        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        
        // Add the logo image
        $this->Image($imagePath, 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Set the font for the header
        $this->SetFont('times', '', 14);
        $this->Cell(0, 11, 'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(0, 11, 'RISET, DAN TEKNOLOGI', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 11, 'UNIVERSITAS SEBELAS MARET', 0, 3, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', 'B', 12);
        $this->Cell(0, 11, 'SEKOLAH VOKASI', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(0, 11, 'PROGRAM STUDI D3 TEKNIK INFORMATIKA (MADIUN)', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(0, 10, 'Jalan Imam Bonjol, Pandean, Mejayan, Madiun', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 10, 'Telepon (0351) 4486943 Faksimile (0351) 4486943', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 10, 'Website: https://prodi.vokasi.uns.ac.id/psdku-tekinfo/', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 10, 'Email: d3ti.vokasiuns@gmail.com', 0, 4, 'C', 0, '', 0, false, 'M', 'M');
        
        // Add a line
        $this->SetLineWidth(0.75); // Atur ketebalan garis
        $this->Line(10, 57, 200, 57); // Atur koordinat garis (x1, y1, x2, y2)
    }
}
