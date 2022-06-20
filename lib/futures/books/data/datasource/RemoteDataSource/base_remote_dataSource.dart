import 'package:book_store/futures/books/data/model/book_model.dart';

abstract class BaseRemoteDataSource {
 Future<List<BookModel>> getBooks();
}
