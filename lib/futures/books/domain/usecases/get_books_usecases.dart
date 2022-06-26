import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/data/repsitories/remote_repository_books.dart';

import 'package:dartz/dartz.dart';

class GetBooksUseCases {
  final RemoteRepositoryBooks remoteRepositoryBooks;

  GetBooksUseCases({required this.remoteRepositoryBooks});

  Future<Either<Failure, BookResponseModel>> call() async =>
      await remoteRepositoryBooks.getBooks();
}
