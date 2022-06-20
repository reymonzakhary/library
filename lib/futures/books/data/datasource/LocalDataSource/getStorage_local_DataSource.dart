import 'dart:convert';

import 'package:book_store/core/constants/strings.dart';
import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/futures/books/data/datasource/LocalDataSource/base_local_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:dartz/dartz.dart';
import 'package:book_store/futures/books/domain/entites/book.dart';
import 'package:get_storage/get_storage.dart';

class GetStorageLocalDataSource extends BaseLocalDataSource {
  final GetStorage storage;

  GetStorageLocalDataSource({required this.storage});


  @override
  Future<Unit> cacheData(List<BookModel> books) {
    final bookBox = books.map((book) => book.toJson(book)).toList();
    storage.write(CACHE_BOOK, bookBox);
    return Future.value(unit);
  }


  @override
  Future<List<BookModel>> getcacheData() {
    final bookBox = storage.read(CACHE_BOOK);
    if (bookBox != null) {
      List decodeData = json.decode(bookBox);
      List<BookModel> books = decodeData.map((jsonBook) => BookModel.fromJson(jsonBook)).toList();
      return Future.value(books);
    } else {
      throw ExceptionEmptyCache();
    }
  }
}
