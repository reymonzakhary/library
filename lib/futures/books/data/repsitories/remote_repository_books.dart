import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/dio_remote_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:dartz/dartz.dart';

import '../../domain/repsitories/base_remote_repsitory.dart';

class RemoteRepositoryBooks extends BaseRemoteRepsitory {
  final DioRemoteDataSource dioRemoteDataSource;

  RemoteRepositoryBooks({required this.dioRemoteDataSource});

  @override
  Future<Either<Failure, List<BookModel>>> getBooks() async {
    try {
      List<BookModel> books = await dioRemoteDataSource.getBooks();
      return Right(books);
    } on ExceptionService {
      return Left(FaluireService());
    }
  }

  @override
  Future<Either<Failure, BookResponseModel>> refreshBooks() async {
    try {
      BookResponseModel bookResponseModel =
          await dioRemoteDataSource.getResponseBook();
      return Right(bookResponseModel);
    } on ExceptionService {
      return Left(FaluireService());
    }
  }
}
