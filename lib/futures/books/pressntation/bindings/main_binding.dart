import 'package:book_store/core/networks/check_network.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/base_local_dataSource.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/getStorage_local_DataSource.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/dio_remote_dataSource.dart';
import 'package:book_store/futures/books/data/repsitories/local_repository_books.dart';
import 'package:book_store/futures/books/data/repsitories/remote_repository_books.dart';
import 'package:book_store/futures/books/domain/usecases/get_books_usecases.dart';
import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:get/instance_manager.dart';
import 'package:get_storage/get_storage.dart';
import 'package:internet_connection_checker/internet_connection_checker.dart';

class MainBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<DioRemoteDataSource>(() => DioRemoteDataSource());
    Get.lazyPut<GetStorageLocalDataSource>(
        () => GetStorageLocalDataSource(storage: GetStorage()));

    Get.lazyPut<CheckNetwork>(() => CheckNetwork(internetConnectionChecker: InternetConnectionChecker()));
  }
}
