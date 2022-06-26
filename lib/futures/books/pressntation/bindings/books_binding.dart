import 'package:book_store/futures/books/data/repsitories/local_repository_books.dart';
import 'package:get/instance_manager.dart';

import '../../data/repsitories/remote_repository_books.dart';
import '../../domain/usecases/get_books_usecases.dart';
import '../controllers/books_controller.dart';

class BooksBinding extends Bindings {
  @override
  void dependencies() {
    Get.put<RemoteRepositoryBooks>(RemoteRepositoryBooks(
        dioRemoteDataSource: Get.find(),
        checkNetwork: Get.find(),
        getStorageLocalDataSource: Get.find()));

    Get.put<GetBooksUseCases>(
        GetBooksUseCases(remoteRepositoryBooks: Get.find()));

    Get.put<BooksController>(BooksController(getBooksUseCases: Get.find()));
  }
}
