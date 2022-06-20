import 'package:book_store/core/controllers/core_controller.dart';
import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/dio_remote_dataSource.dart';
import 'package:book_store/futures/books/data/repsitories/remote_repository_books.dart';
import 'package:book_store/futures/books/domain/usecases/get_books_usecases.dart';

import '../../domain/entites/book.dart';

class BooksController extends CoreController {
  GetBooksUseCases getBooksUseCases = GetBooksUseCases(
      remoteRepositoryBooks:
          RemoteRepositoryBooks(dioRemoteDataSource: DioRemoteDataSource()));
  List<Book> books = [];
  @override
  void onInit() {
    _getAllBooks();
    super.onInit();
  }

  _getAllBooks() async {
    final result = await getBooksUseCases.call();
    result.fold((failure) => FaluireService(), (booksList) {
      books = booksList;
      update();
    });
  }
}
