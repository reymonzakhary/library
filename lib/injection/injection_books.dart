import 'package:book_store/core/networks/check_network.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/getStorage_local_DataSource.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/dio_remote_dataSource.dart';
import 'package:book_store/futures/books/domain/usecases/get_books_usecases.dart';
import 'package:get_it/get_it.dart';
import 'package:get_storage/get_storage.dart';

// import 'package:http/http.dart' as http;
import 'package:internet_connection_checker/internet_connection_checker.dart';

import '../futures/books/data/repsitories/remote_repository_books.dart';
import '../futures/books/presentation/bloc/books_bloc.dart';

final getIt = GetIt.instance;

Future<void> init() async {
//Bloc

  getIt.registerFactory(() => BooksBloc(getBooksUseCases: getIt()));

// repository

  getIt.registerLazySingleton<RemoteRepositoryBooks>(() =>
      RemoteRepositoryBooks(
          checkNetwork: getIt(),
          dioRemoteDataSource: getIt(),
          getStorageLocalDataSource: getIt()));

// usecases

  getIt.registerLazySingleton(
      () => GetBooksUseCases(remoteRepositoryBooks: getIt()));

//data source

  getIt.registerLazySingleton<DioRemoteDataSource>(() => DioRemoteDataSource());

  getIt.registerLazySingleton<GetStorageLocalDataSource>(
      () => GetStorageLocalDataSource(storage: getIt()));

//core

  getIt.registerLazySingleton<CheckNetwork>(
      () => CheckNetwork(internetConnectionChecker: getIt()));

// Extra injection

//   final sharedPreferences = await SharedPreferences.getInstance();
//   getIt.registerLazySingleton(() => sharedPreferences);
//   getIt.registerLazySingleton(() => http.Client());
  getIt.registerLazySingleton(() => InternetConnectionChecker());
  getIt.registerLazySingleton(() => GetStorage());
}
