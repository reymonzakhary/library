import 'dart:convert';

import 'package:book_store/core/constants/strings.dart';
import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/base_local_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:dartz/dartz.dart';
import 'package:get_storage/get_storage.dart';

class GetStorageLocalDataSource extends BaseLocalDataSource {
  final GetStorage storage;

  GetStorageLocalDataSource({required this.storage});

  @override
  Future<Unit> cacheData(BookResponseModel bookResponseModel) {
    final bookBox =
        bookResponseModel.books.map((book) => book.toJson(book)).toList();
    storage.write(CACHE_BOOK, bookBox);
    return Future.value(unit);
  }

  @override
  Future<BookResponseModel> getcacheData() {
    final bookBox = storage.read(CACHE_BOOK);
    if (bookBox != null) {
      final decodeData = json.decode(bookBox);
      BookResponseModel responseModel =
          decodeData.map((response) => BookResponseModel.fromJson(response))
              as BookResponseModel;
      return Future.value(responseModel);
    } else {
      throw ExceptionEmptyCache();
    }
  }
}
