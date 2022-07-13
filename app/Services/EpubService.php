<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;
use PHPePub\Core\EPub;
use TonchikTm\PdfToHtml\Pdf;
use TonchikTm\PdfToHtml;

class EpubService
{


    public function convertToHtml()
    {
        $pdf = new Pdf('/var/www/html/public/files/1657721951_c4611_sample_explain.pdf', [
            'pdftohtml_path' => '/usr/bin/pdftohtml',
            'pdfinfo_path' => '/usr/bin/pdfinfo'
        ]);
        // // get pdf info
        $pdfInfo = $pdf->getInfo();

        // get count pages
        $countPages = $pdf->countPages();

        // get content from one page
        $contentFirstPage = $pdf->getHtml()->getPage(1);
        
        // get content from all pages and loop for they
        foreach ($pdf->getHtml()->getAllPages() as $page) {
            echo $page . '<br/>';
        }
    }
}
