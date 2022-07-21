<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;
use PHPePub\Core\EPub;
use TonchikTm\PdfToHtml\Pdf;
use PHPePub\Helpers\CalibreHelper;

class EpubService
{
    public function htmlConverter()
    {
        $pdf = new Pdf('/var/www/html/public/files/file-example_PDF_500_kB.pdf', [
            'pdftohtml_path' => '/usr/bin/pdftohtml',
            'pdfinfo_path' => '/usr/bin/pdfinfo'
        ]);

        $allPages = $pdf->getHtml()->getAllPages();
        return view('viewer')->with('allPages', $allPages);
    }

    public function chapterSeparator(Request $request)
    { 
        $chapters = $request->chapters; //get start of each chapter
        $htmlPages = $this->htmlConverter()->allPages;
        $values = []; 
        
        //get pages of each chapter to be combined as a chapter
        for ($i = 0; $i < count($chapters) - 1; $i++) {
            $values[] = range($chapters[$i], $chapters[$i + 1] - 1);
        }
        $chapterCollection = [];
        foreach ($values as $chapter) {
            $chapterCollection[] = collect($htmlPages)->filter(fn ($i, $index) => in_array($index, $chapter))->toArray();
         }

        $this->convert($chapterCollection);
         
    }
        //convert given html to .epub
    public function convert($chapters)
    {
        $content_start =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
            . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
            . "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
            . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
            . "<head>"
            . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
            . "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
            . "<title>Test Book</title>\n"
            . "</head>\n"
            . "<body>\n<div>";

        $bookEnd = "</div></body>\n</html>\n";
        // setting timezone for time functions used for logging to work properly
        date_default_timezone_set('Europe/Berlin');
        $fileDir = './PHPePub';
        $book = new EPub(); // no arguments gives us the default ePub 2, lang=en and dir="ltr"
        $book->setTitle("Simple Test book");
        $book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBookSimple.html", EPub::IDENTIFIER_URI); // Could also be the ISBN number, preferrd for published books, or a UUID.
        $book->setLanguage("en"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
        $book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
        $book->setAuthor("John Doe Johnson", "Johnson, John Doe");
        $book->setPublisher("John and Jane Doe Publications", "http://JohnJaneDoePublications.com/"); // I hope this is a non existent address :)
        $book->setDate(time()); // Strictly not needed as the book date defaults to time().
        $book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
        $book->setSourceURL("http://JohnJaneDoePublications.com/books/TestBookSimple.html");
        CalibreHelper::setCalibreMetadata($book, "PHPePub Test books", "5");
        $cssData = "body {\n  margin-left: .5em;\n  margin-right: .5em;\n  text-align: justify;\n}\n\np {\n  font-family: serif;\n  font-size: 10pt;\n  text-align: justify;\n  text-indent: 1em;\n  margin-top: 0px;\n  margin-bottom: 1ex;\n}\n\nh1, h2 {\n  font-family: sans-serif;\n  font-style: italic;\n  text-align: center;\n  background-color: #6b879c;\n  color: white;\n  width: 100%;\n}\n\nh1 {\n    margin-bottom: 2px;\n}\n\nh2 {\n    margin-top: -2px;\n    margin-bottom: 2px;\n}\n";
        $book->addCSSFile("styles.css", "css1", $cssData);
        $doc = new \DOMDocument();
        foreach($chapters as $num => $chapter){
            foreach($chapter as $key => $page){
                $doc->loadHTML($page);
                $body = $doc->getElementsByTagName('body');
                $book->addChapter("Notices ".$num , "Cover".$num.$key.".html", $content_start.$body->item(0)->textContent.$bookEnd); 
            } 
        }
        $book->finalize();
        $zipData = $book->sendBook("ExampleBook1_test");
    }

    public function pdfConverter()
    {
        $source_pdf = ('/var/www/html/public/files/1657721951_c4611_sample_explain.pdf');
        $output_folder = storage_path('app/public/html');

        if (!file_exists($output_folder)) {
            mkdir($output_folder, 0777, true);
        }
        $a = passthru("pdftohtml $source_pdf $output_folder/sample_explain", $b);
    }
}
