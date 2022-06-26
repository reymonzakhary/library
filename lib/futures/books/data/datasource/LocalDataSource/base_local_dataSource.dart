import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:dartz/dartz.dart';

abstract class BaseLocalDataSource {
  Future<BookResponseModel> getcacheData();
  Future<Unit> cacheData(BookResponseModel books);
}
