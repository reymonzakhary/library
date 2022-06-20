import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:dartz/dartz.dart';

abstract class BaseLocalDataSource {
  Future<List<BookModel>> getcacheData();
  Future<Unit> cacheData(List<BookModel> books);
}
