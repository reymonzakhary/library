import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/core/networks/check_network.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/getStorage_local_DataSource.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/dio_remote_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/data/repsitories/local_repository_books.dart';
import 'package:dartz/dartz.dart';

import '../../domain/repsitories/base_remote_repsitory.dart';

class RemoteRepositoryBooks extends BaseRemoteRepsitory {
  final DioRemoteDataSource dioRemoteDataSource;
  final GetStorageLocalDataSource getStorageLocalDataSource;
  final CheckNetwork checkNetwork;

  RemoteRepositoryBooks(
      {required this.getStorageLocalDataSource,
      required this.dioRemoteDataSource,
      required this.checkNetwork});

  @override
  Future<Either<Failure, BookResponseModel>> getBooks() async {
    if (await checkNetwork.isDeviceConnection) {
      try {
        BookResponseModel books = await dioRemoteDataSource.getBooks();
        await getStorageLocalDataSource.cacheData(books);
        return Right(books);
      } on ExceptionService {
        return Left(FaluireService());
      }
    } else {
      try {
        final cachedBooks = await getStorageLocalDataSource.getcacheData();
        return Right(cachedBooks);
      } on ExceptionEmptyCache {
        return Left(FaluireEmptyCache());
      }
    }
  }
}
