import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:dartz/dartz.dart';

abstract class BaseRemoteRepsitory {
  Future<Either<Failure, List<BookModel>>> getBooks();
  Future<Either<Failure, BookResponseModel>> refreshBooks();
}
