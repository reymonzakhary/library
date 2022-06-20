import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/domain/entites/book.dart';
import 'package:book_store/futures/books/domain/repsitories/base_remote_repsitory.dart';
import 'package:dartz/dartz.dart';

class GetBooksUseCases {
  final BaseRemoteRepsitory remoteRepositoryBooks;

  GetBooksUseCases({required this.remoteRepositoryBooks});

  Future<Either<Failure, List<Book>>> call() async =>
      await remoteRepositoryBooks.getBooks();
}
