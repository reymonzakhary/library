<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\BookControllers;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use PHPePub\Core\EPub;

Route::get('/', function () {
    return view('layout/welcome');
});

Auth::routes();
Route::view('/login', 'layout/login');

Route::group(['prefix' => '/admin'], function () {
    //books
    Route::resource('/books', BookController::class);
    Route::post('/books/search', [BookController::class, 'index'])->name('search.book');
    //categories
    Route::resource('/categories', CategoryController::class);
});

Route::group(['prefix' => '/api'], function () {
    Route::get('books', [BookControllers::class, 'index']);
    Route::get('book/{id}', [BookControllers::class, 'show']);
});
Route::get('/epub', [BookController::class, 'convertEpub']);
Route::get('/html', [BookController::class, 'convertHtml']);
Route::post('/html', [BookController::class, 'updateHtml'])->name('update.html');

// route to generate epub file
Route::get('/epu2b', function () {

    $book = new EPub();
    $content_start =
        "<?xml "
        . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
        . "\"http://www.w3.org/TR/xhtml11\">\n"
        . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
        . "<head>"
        . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
        . "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
        . "<title>Test Book</title>\n"
        . "</head>\n"
        . "<body>\n";

    $book->setTitle("Test book");
    $book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBook.html", EPub::IDENTIFIER_URI); // Could also be the ISBN number, preferred for published books, or a UUID.
    $book->setLanguage("en"); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
    $book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
    $book->setAuthor("John Doe Johnson", "Johnson, John Doe");
    $book->setPublisher("John and Jane Doe Publications", "http://JohnJaneDoePublications.com/"); // I hope this is a non existent address :)
    $book->setDate(time()); // Strictly not needed as the book date defaults to time().
    $book->setRights("Copyright and licence information specific for the book."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
    $book->setSourceURL("http://JohnJaneDoePublications.com/books/TestBook.html");
    // $book->addDublinCoreMetadata(DublinCore::CONTRIBUTOR, "PHP");

    $book->setSubject("Test book");
    $book->setSubject("keywords");
    $book->setSubject("Chapter levels");
    $bookEnd = "</body>\n</html>\n";
    //  $book->sendBook("ExampleBook1");
    $chapter1 = $content_start . "<h1>Chapter 1</h1>\n"
        . "<h2>Lorem ipsum</h2>\n"
        . "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec magna lorem, mattis sit amet porta vitae, consectetur ut eros. Nullam id mattis lacus. In eget neque magna, congue imperdiet nulla. Aenean erat lacus, imperdiet a adipiscing non, dignissim eget felis. Nulla facilisi. Vivamus sit amet lorem eget mauris dictum pharetra. In mauris nulla, placerat a accumsan ac, mollis sit amet ligula. Donec eget facilisis dui. Cras elit quam, imperdiet at malesuada vitae, luctus id orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque eu libero in leo ultrices tristique. Etiam quis ornare massa. Donec in velit leo. Sed eu ante tortor.</p>\n"
        . "<p><img src=\"http://www.grandt.com/ePub/AnotherHappilyMarriedCouple.jpg\" alt=\"Test Image retrieved off the internet: Another happily married couple\" />Nullam at tempus enim. Nunc et augue non lectus consequat rhoncus ac a odio. Morbi et tellus eget nisi volutpat tincidunt. Curabitur tristique neque tincidunt purus blandit bibendum. Maecenas eleifend sem quis magna semper id pulvinar nisi porttitor. In in lectus accumsan eros tristique pharetra sit amet ac nulla. Nam vitae felis et orci congue porta nec non ipsum. Donec pretium blandit accumsan. In aliquam lacinia nisi, ut venenatis mauris condimentum ut. Morbi rutrum orci et nisl accumsan euismod. Etiam viverra luctus sem pellentesque suscipit. Aliquam ultricies egestas risus at eleifend. Ut lacinia, tortor non varius malesuada, massa diam aliquet augue, vitae tempor metus tellus eget diam. Nulla vel augue eu elit adipiscing egestas. Duis et nulla est, ac congue arcu. Phasellus semper, ipsum et blandit rutrum, erat ante semper quam, at iaculis quam tellus sed neque.</p>\n"
        . "<p>Pellentesque vulputate sollicitudin justo, at faucibus nisl convallis in. Nulla facilisi. Curabitur nec mauris eu justo ultricies ultricies gravida eu ipsum. Pellentesque at nunc velit, vitae congue nisl. Nam varius imperdiet leo eu accumsan. Nullam elementum fermentum diam euismod porttitor. Etiam sed pellentesque ante. Donec in est elementum mi tempor consectetur. Fusce orci lorem, mollis at tincidunt eget, fringilla sed nunc. Ut consectetur condimentum condimentum. Phasellus sed felis non massa gravida euismod ut in tellus. Curabitur suscipit pharetra sapien vitae dignissim. Morbi id arcu nec ante viverra lobortis vitae nec quam. Mauris id gravida odio. Nunc non sem nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque hendrerit volutpat nisl id elementum. Vivamus lobortis iaculis nisi, sit amet tristique risus porttitor vel. Suspendisse potenti.</p>\n"
        . "<p>Quisque aliquet sapien leo, vitae eleifend dolor. Fusce quis tincidunt nunc. Nam nec purus nulla, ac eleifend lorem. Curabitur eu quam et nibh egestas mattis. Maecenas eget felis augue. Integer scelerisque commodo urna, a pulvinar tortor euismod et. Praesent in nunc sapien. Ut iaculis auctor neque, sit amet rutrum est faucibus vitae. Sed a sagittis quam. Quisque interdum luctus fringilla. Vestibulum vitae nunc in felis luctus ultricies at id magna. Nam volutpat sapien ac lorem interdum pellentesque. Suspendisse faucibus, leo vitae laoreet interdum, mi mi pulvinar neque, sit amet tristique sapien nulla nec dolor. Etiam non ligula augue.</p>\n"
        . "<p>Vivamus purus elit, ornare eget accumsan ut, luctus et orci. Sed vestibulum turpis ut quam vehicula id hendrerit velit suscipit. Pellentesque pulvinar, libero vitae sagittis scelerisque, felis ante faucibus risus, ut viverra velit mi at tortor. Aliquam lacinia condimentum felis, eu elementum ligula laoreet vitae. Sed placerat tempus turpis a fringilla. Etiam porta accumsan feugiat. Phasellus et cursus magna. Suspendisse vitae odio sit amet urna vulputate consectetur. Vestibulum massa magna, sagittis at dictum vitae, sagittis scelerisque erat. Donec viverra tincidunt lacus. Maecenas fermentum erat et mauris tincidunt sed eleifend quam tempus. In at augue mi, in tincidunt arcu. Duis dapibus aliquet mi, ac ullamcorper est semper quis. Sed nec nulla nec odio malesuada viverra id sed nulla. Donec lobortis euismod aliquam. Praesent sit amet dolor quis lacus auctor lobortis. In hac habitasse platea dictumst. Sed at nisi sed nisi ullamcorper pellentesque. Vivamus eget enim sem, non laoreet leo. Sed vel odio lacus.</p>\n"
        . $bookEnd;
    $viewer = view('viewer', [
        'book_test' => 'test send data to viewer',
        'chapter4' => $chapter1,
        'bookEnd' => $bookEnd
    ],)->render();
    $book->addChapter("Chapter 1", $chapter1, true);
    $book->finalize();
    $book->sendBook("ExampleBook1");
    return $viewer;
});
