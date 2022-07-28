<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPePub\Core\EPub;
use TonchikTm\PdfToHtml\Pdf;
use PHPePub\Helpers\CalibreHelper;

class EpubService
{
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
        $pdf = new Pdf('/var/www/html/public/files/Anne-of-Green-Gables-By-Lucy-Maud-Montgomery-Retold-by-Anne-Collins-book-PDF.pdf', [
            'pdftohtml_path' => '/usr/bin/pdftohtml',
            'pdfinfo_path' => '/usr/bin/pdfinfo'
        ]);
        // $allPages = $pdf->getHtml()->getAllPages();
        // dd($allPages);
        $html = Storage::disk('public')->get('Anne-of-Green-Gables.html');
        // dd($html);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_use_internal_errors($internalErrors);
        foreach ($this->getElementsByClassName($dom, 'page', 'div') as $node) {
            $allPages[] = $dom->saveHTML($node);
        }

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
        $doc = new \DOMDocument();
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
        $cssData = "body .page { background-color:white; position:relative; z-index:0; }
        .vector { position:absolute; z-index:1; }
        .image { position:absolute; z-index:2; }
        .text { position:absolute; z-index:3; opacity:inherit; white-space:nowrap; }
        .annotation { position:absolute; z-index:5; }
        .control { position:absolute; z-index:10; }
        .annotation2 { position:absolute; z-index:7; }
        .dummyimg { vertical-align: top; border: none; }
        }\n";
        $book->addCSSFile("styles.css", "css1", $cssData);
        foreach ($chapters as $num => $chapter) {
            $patterns = array('/style=[^>]*/', '/<p[^>]*>(?:\s|&nbsp;)*<\/p>/');
            $content =  preg_replace($patterns, '', $chapter);
            // dd(implode($chapter));
            // $modify =preg_replace('/<span class="text">(.*?)<\/span>/', '<p class="calibre1">', $content);

            // dd($modify);
            $book->addChapter("Chapter " . $num, "chapter" . $num . ".html", $content_start . implode($chapter) . $bookEnd);
        }
        $book->buildTOC();
        $book->finalize();
        $zipData = $book->sendBook("ExampleBook1_test");
    }

    public function pdfConverter()
    {
        $source_pdf = ('/var/www/html/public/files/Anne-of-Green-Gables-By-Lucy-Maud-Montgomery-Retold-by-Anne-Collins-book-PDF.pdf');
        $output_folder = storage_path('app/public/html');
        if (!file_exists($output_folder)) {
            mkdir($output_folder, 0777, true);
        }
        // $allPages = file_get_contents($output_folder.'/new_file_names.html');
        $file = Storage::disk('public')->get('html/new_file_names.html');
        echo $file;
        // $dom = new \DOMDocument();
        // $dom->loadHTML($file);
        // // $xpath = new \DOMXPath($dom);
        // // $xpath->registerNamespace("xml", "http://www.w3.org/1999/xhtml");
        // // $html = '';
        // // $body = $xpath->query("//a");
        // $array = array();
        // foreach ($dom->getElementsByTagName('style') as $node) {
        //     if ($node->tagName != 'body' && $node->tagName != 'html') {
        //         $array[] = $dom->saveHTML($node);
        //         dd($file);
        //     }
        // }
        // print_r($array);
        // // foreach ($body->childNodes as $node) {
        // //     $html .= $dom->saveHTML($node);
        // // }
        // // unset($dom, $xpath, $body, $content);
        // // $trimmed = trim($html);
        // // dd($body);
        // // $body = $dom->getElementsByTagName('a');
        // // dd($body);
        // // return view('viewer')->with('allPages', $file);
        // foreach ($dom->getElementsByTagName('hr') as $node) {
        //     $title = $dom->saveHTML($node);
        //     $content[$title] = array();
        //     while (($node = $node->nextSibling) && $node->nodeName !== 'a') {
        //         $content[$title] = $dom->saveHTML($node);
        //     }
        // preg_match_all("/[\s]+name=\d+></a>\+((.+?)<hr />)?/is",  html_entity_decode($file), $matches);
        // dd($matches[2]);
        // }
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
                    Storage::disk('local')->put('convertedpdf.html', $html);
                    return response()->download(storage_path() . '/app/convertedpdf.html')->deleteFileAfterSend(true);
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
            'source_file' => '/var/www/html/public/files/1657203562_Get_Started_With_Smallpdf.pdf',
            'target_format' => '.epub'
        ]);

        // Wait for the job to complete (the default timeout is 60 seconds)
        $job->waitForCompletion([
            'timeout' => 60
        ]);

        // Download the converted files 
        $job->downloadTargetFiles([
            'download_path' => '/var/www/html/public/files'
        ]);

        // Delete the source and target files on Zamzar's servers
        $job->deleteAllFiles();
    }
}
