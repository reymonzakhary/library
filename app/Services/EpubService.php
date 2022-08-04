<?php

namespace App\Services;

use PHPePub\Core\EPub;
use \Convertio\Convertio;
use \ConvertApi\ConvertApi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use TonchikTm\PdfToHtml\Pdf;
use PHPePub\Helpers\CalibreHelper;
use Illuminate\Support\Facades\Storage;

class EpubService
{
    private $images;
    function getElementsByClassName($dom, $ClassName, $tagName = null)
    {
        if ($tagName) {
            $Elements = $dom->getElementsByTagName($tagName);
        } else {
            $Elements = $dom->getElementsByTagName("*");
        }
        $Matched = array();
        for ($i = 0; $i < $Elements->length; $i++) {
            if ($Elements->item($i)->attributes->getNamedItem('class')) {
                if ($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
                    $Matched[] = $Elements->item($i);
                }
            }
        }
        return $Matched;
    }

    public function htmlConverter()
    {
        $pdf = new Pdf('/var/www/html/public/files/sample-pdf-with-images.pdf', [
            'pdftohtml_path' => '/usr/bin/pdftohtml',
            'pdfinfo_path' => '/usr/bin/pdfinfo'
        ]);
        // $allPages = $pdf->getHtml()->getAllPages();
        //  $allPages;
        // dd($allPages);
        $html = Storage::disk('public')->get('sample_pdf_with_imgs.html');
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_use_internal_errors($internalErrors);
        foreach ($this->getElementsByClassName($dom, 'page', 'div') as $node) {
            $allPages[] = $dom->saveHTML($node);
        }
        // echo $html;
        return view('viewer')->with('allPages', $allPages);
    }

    public function pdfConverter()
    {
        $source_pdf = ('/var/www/html/public/files/petherbridge.pdf');
        $pdf_name = basename($source_pdf);
        $output_folder = storage_path('app/public/html/converted-' . $pdf_name);
        if (!file_exists($output_folder)) {
            mkdir($output_folder, 0777, true);
        }
        // $a = passthru("pdftohtml $source_pdf $output_folder/new_file_name", $b);
        $file = Storage::disk('public')->get('/html/converted-' . $pdf_name . '/new_file_names.html');
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

        foreach ($content as $element) {
            $src = preg_match_all('/<img [^>]*src=["|\']([^"|\']+)/i', $element, $matches);
            foreach (optional($matches)[1] as $value) {
                $parts = explode('/', $value);
                $img_name = $parts[count($parts) - 1];
                $element = preg_replace('#' . $value . '#', $img_name, $element);
            }
            $allPages[] = preg_replace('/="[0-9]+"\/>/', '', $element);
        }
        return view('viewer')->withTitle($pdf_name)->withAllPages($allPages);
    }

    public function chapterSeparator(Request $request)
    {
        $chapters = $request->chapters; //get start of each chapter
        $htmlPages = $this->pdfConverter()->allPages;
        $values = [];

        //get pages of each chapter to be combined as a chapter
        for ($i = 0; $i < count($chapters) - 1; $i++) {
            $values[] = range($chapters[$i], $chapters[$i + 1] - 1);
        }
        $chapterCollection = [];
        foreach ($values as $chapter) {
            $chapterCollection[] = collect($htmlPages)->filter(fn ($i, $index) => in_array($index, $chapter))->toArray();
        }
        $this->convert($chapterCollection, $request->title);
    }

    //convert given html to .epub
    public function convert($chapters, $title)
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
        $images = Storage::disk("public")->allFiles('html/converted-' . $title);
        foreach ($images as $image) {
            $name = basename($image);
            $path = storage_path('app/public/' . $image);
            $mimeType = mime_content_type($path);
            $book->addFile($name, '1', file_get_contents($path), $mimeType);
        }
        foreach ($chapters as $num => $chapter) {
            // dd($chapter);
            // $patterns = array('/<div class="vector".*?<\/div>/', '/style=[^>]*/', '/<p[^>]*>(?:\s|&nbsp;)*<\/p>/');
            $patterns = array('/<div class="vector".*?<\/div>/', '/style=[^>]*/', '/<p[^>]*>(?:\s|&nbsp;)*<\/p>/');
            $content = preg_replace($patterns, '', $chapter);
            // $content = preg_replace("/<img[^>]+\>/i", "<img src=''>", $removeStyle, '/class="vector" ><img [^>]*/',);
            // $content = strip_tags(implode($modify),'<div class="vector"'); 
            // dd($content);
            $book->addChapter("Chapter " . $num, "chapter" . $num . ".html", $content_start . implode($content) . $bookEnd);
        }
        $book->buildTOC();
        $book->finalize();
        $zipData = $book->sendBook($title);
    }

    public function convertByApi()
    {
        $apiKey = $_POST["apiKey"]; // The authentication key (API Key). Get your own by registering at https://app.pdf.co
        $pages = "";
        if (isset($_POST["pages"])) {
            $pages = $_POST["pages"];
        }

        $plainHtml = false;
        if (isset($_POST["plainHtml"])) {
            $plainHtml = $_POST["plainHtml"];
        }

        $columnLayout = false;
        if (isset($_POST["columnLayout"])) {
            $columnLayout = $_POST["columnLayout"];
        }

        // 1. RETRIEVE THE PRESIGNED URL TO UPLOAD THE FILE.
        // * If you already have the direct PDF file link, go to the step 3.

        // Create URL
        $url = "https://api.pdf.co/v1/file/upload/get-presigned-url" .
            "?name=" . urlencode($_FILES["file"]["name"]) .
            "&contenttype=application/octet-stream";
        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // Execute request
        $result = curl_exec($curl);
        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                // Get URL to use for the file upload
                $uploadFileUrl = $json["presignedUrl"];
                // Get URL of uploaded file to use with later API calls
                $uploadedFileUrl = $json["url"];

                // 2. UPLOAD THE FILE TO CLOUD.

                $localFile = $_FILES["file"]["tmp_name"];
                $fileHandle = fopen($localFile, "r");

                curl_setopt($curl, CURLOPT_URL, $uploadFileUrl);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/octet-stream"));
                curl_setopt($curl, CURLOPT_PUT, true);
                curl_setopt($curl, CURLOPT_INFILE, $fileHandle);
                curl_setopt($curl, CURLOPT_INFILESIZE, filesize($localFile));

                // Execute request
                curl_exec($curl);

                fclose($fileHandle);

                if (curl_errno($curl) == 0) {
                    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if ($status_code == 200) {
                        // 3. CONVERT UPLOADED PDF FILE TO HTML

                        $this->PdfToHtml($apiKey, $uploadedFileUrl, $pages, $plainHtml, $columnLayout);
                    } else {
                        // Display request error
                        echo "<p>Status code: " . $status_code . "</p>";
                        echo "<p>" . $result . "</p>";
                    }
                } else {
                    // Display CURL error
                    echo "Error: " . curl_error($curl);
                }
            } else {
                // Display service reported error
                echo "<p>Status code: " . $status_code . "</p>";
                echo "<p>" . $result . "</p>";
            }

            curl_close($curl);
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
    }

    function PdfToHtml($apiKey, $uploadedFileUrl, $pages, $plainHtml, $columnLayout)
    {
        // Create URL
        $url = "https://api.pdf.co/v1/pdf/convert/to/html";

        // Prepare requests params
        $parameters = array();
        $parameters["url"] = $uploadedFileUrl;
        $parameters["pages"] = $pages;

        if ($plainHtml) {
            $parameters["simple"] = $plainHtml;
        }

        if ($columnLayout) {
            $parameters["columns"] = $columnLayout;
        }

        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);
        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                if (!isset($json["error"]) || $json["error"] == false) {
                    $resultFileUrl = $json["url"];
                    // Display link to the file with conversion results
                    $html = file_get_contents($resultFileUrl);
                    Storage::disk('local')->put('converted2pdf.html', $html);
                    return response()->download(storage_path() . '/app/converted2pdf.html')->deleteFileAfterSend(true);
                    echo "<div><h2>Conversion Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                } else {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>";
                }
            } else {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>";
                echo "<p>" . $result . "</p>";
            }
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

        // Cleanup
        curl_close($curl);
    }

    public function api()
    {

        //gives timeout for many requests  

        // Connect to the Production API using an API Key
        $zamzar = new \Zamzar\ZamzarClient("e43d419266bf9c337a13a440e2703dfd7427db26");

        // Submit a conversion job
        $job = $zamzar->jobs->submit([
            'source_file' => '/var/www/html/public/files/file-example_PDF_1MB.pdf',
            'target_format' => 'epub'
        ]);

        // Wait for the job to complete (the default timeout is 60 seconds)
        $job->waitForCompletion([
            'timeout' => 120
        ]);

        // Download the converted2 files 
        $job->downloadTargetFiles([
            'download_path' => '/var/www/html/public/files'
        ]);

        // Delete the source and target files on Zamzar's servers
        $job->deleteAllFiles();
    }

    public function Convertio()
    {

        $API = new \Convertio\Convertio("56d46c0409b16e1fe40953fced4105a7");           // You can obtain API Key here: https://convertio.co/api/
        $API->start('/var/www/html/public/files/Anne-of-Green-Gables-By-Lucy-Maud-Montgomery-Retold-by-Anne-Collins-book-PDF.pdf', 'epub')
            ->wait()
            ->download('/var/www/html/public/download/english_stories.epub')
            ->delete();
    }

    public function convertApi()
    {
        ConvertApi::setApiSecret('xrKR4yYI8EA24Hji');
        // $result = ConvertApi::convert(
        //     'pdf',
        //     ['File' => '/var/www/html/public/files/english-short-stories-free.pdf'],
        //     'docx'
        // );
        $result = ConvertApi::convert(
            'pdf',
            [
                'File' => '/var/www/html/public/files/english-short-stories-free.pdf',
            ],
            'pdf'
        );
        $result->saveFiles('/var/www/html/public/download');
    }
}
