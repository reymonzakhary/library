import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/domain/entites/book_response.dart';

abstract class BaseRemoteDataSource {
  Future<List<BookModel>> getBooks();
  Future<BookResponseModel> getResponseBook();
}
