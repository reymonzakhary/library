<?php

namespace App\Services;

use PHPePub\Core\EPub;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPePub\Helpers\CalibreHelper;
use Illuminate\Support\Facades\Storage;
class EpubService
{
    /**
     * Converts pdf file to html pages.
     */
    public function pdfToHtmlConverter()
    {
        //Converts pdf file and send it to a new folder
        $source_pdf = ('/var/www/html/public/files/Three-Men-in-a-Boat-By-Jerome-K.-Jerome-Book-PDF.pdf');
        $pdf_name = basename($source_pdf);
        $output_folder = storage_path('app/public/html/converted-' . $pdf_name);
        if (!file_exists($output_folder)) {
            mkdir($output_folder, 0777, true);
        }
        $a = exec("pdftohtml $source_pdf $output_folder/new_file_name", $b);
        
        //Opens the html file.
        $file = Storage::disk('public')->get('/html/converted-' . $pdf_name . '/new_file_names.html');
        
        //Extracts html content between <body> </body>
        $dom = new \DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($file);
        libxml_use_internal_errors($internalErrors);
        $xpath = new \DOMXPath($dom);
        $div = $xpath->query('//body');
        $div = $div->item(0);
        $html = $dom->saveXML($div);
        $content = explode('<a name', $html);
        unset($content[0]);

        $content[count($content) - 1] = Str::replace('</body>', '', $content[count($content) - 1]);

        //Looks for images in html and replaces the src attribute to base64 hash.
        foreach ($content as $element) {
            $src = preg_match_all('/<img [^>]*src=["|\']([^"|\']+)/i', $element, $matches);
            foreach (optional($matches)[1] as $value) {
                $type = pathinfo($value, PATHINFO_EXTENSION);
                $data = file_get_contents($value);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $element = preg_replace('#' . $value . '#', $base64, $element);
            }
            $patterns = array('/<hr\/>/', '/="[0-9]+"\/>/'); //to remove unwanted tags
            $allPages[] = preg_replace($patterns, '<br/>', $element);
        }
        return view('viewer')->withTitle($pdf_name)->withAllPages($allPages);
    }

    /** 
    * Collect html pages and combine them as a chapter.
    */
    public function chapterSeparator(Request $request)
    {
        $chapters = $request->chapters; //to get first page of each chapter
        $htmlPages = $this->pdfToHtmlConverter()->allPages;
        $values = [];

        //get pages of each chapter to be combined as a chapter
        for ($i = 0; $i < count($chapters) - 1; $i++) {
            $values[] = range($chapters[$i], $chapters[$i + 1] - 1);
        }
        $chapterCollection = [];
        foreach ($values as $chapter) {
            $chapterCollection[] = collect($htmlPages)->filter(fn ($i, $index) => in_array($index, $chapter))->toArray();
        }

        $this->convertToEpub($chapterCollection, $request->title);
    }

    /** 
     * Convert given html to .epub
     * @param $chapters array of html pages to be used in addChapter function.
     * @param $title book title to be used in setTitle function.
     */
    public function convertToEpub($chapters, $title)
    {
        $doc = new \DOMDocument();
        $content_start =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
            . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
            . "<head>"
            . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
            . "<link href=\"stylesheet.css\" rel=\"stylesheet\" type=\"text/css\"/>\n"
            . "<link href=\"page_styles.css\" rel=\"stylesheet\" type=\"text/css\"/>\n"
            . "<title>Test Book</title>\n"
            . "</head>\n"
            . "<body class='main'>\n";

        $bookEnd = "</body>\n</html>\n";

        $book = new EPub(); // no arguments gives us the default ePub 2, lang=en and dir="ltr"
        $book_title = pathinfo($title, PATHINFO_FILENAME);
        $book->setTitle($book_title);
        $book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBookSimple.html", EPub::IDENTIFIER_URI); // Could also be the ISBN number, preferrd for published books, or a UUID.
        $book->setLanguage("en"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
        $book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
        $book->setAuthor("John Doe Johnson", "Johnson, John Doe");
        $book->setPublisher("John and Jane Doe Publications", "http://JohnJaneDoePublications.com/"); // I hope this is a non existent address :)
        $book->setDate(time()); // Strictly not needed as the book date defaults to time().
        $book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
        $book->setSourceURL("http://JohnJaneDoePublications.com/books/TestBookSimple.html");
        CalibreHelper::setCalibreMetadata($book, "PHPePub Test books", "5");
        
        foreach ($chapters as $num => $chapter) {
            $book->addChapter("Chapter " . $num, "chapter" . $num . ".html", $content_start . implode($chapter) . $bookEnd);
        }
        
        $book->buildTOC();
        $book->finalize();
        $zipData = $book->sendBook($book_title);
    }

}
