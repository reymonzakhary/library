import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/repsitories/remote_repository_books.dart';
import 'package:book_store/futures/books/domain/entites/book.dart';
import 'package:book_store/futures/books/domain/entites/book_response.dart';
import 'package:book_store/futures/books/domain/repsitories/base_remote_repsitory.dart';
import 'package:dartz/dartz.dart';

class GetBooksUseCases {
  final RemoteRepositoryBooks remoteRepositoryBooks;

  GetBooksUseCases({required this.remoteRepositoryBooks});

  Future<Either<Failure, List<Book>>> call() async =>
      await remoteRepositoryBooks.getBooks();

  Future<Either<Failure, BookResponse>> refresh() async =>
      await remoteRepositoryBooks.refreshBooks();
}
