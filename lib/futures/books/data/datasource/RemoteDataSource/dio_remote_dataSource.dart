import 'dart:convert';

import 'package:book_store/core/constants/strings.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/base_remote_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/domain/entites/book_response.dart';
import 'package:dio/dio.dart';

import '../../../../../core/errors/exception/exception.dart';

class DioRemoteDataSource extends BaseRemoteDataSource {
  late Dio dio;

  DioRemoteDataSource() {
    final options = BaseOptions(
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      baseUrl: BASE_URL,
    );
    dio = Dio(options);
  }
  @override
  Future<List<BookModel>> getBooks() async {
    final response = await dio.get(ALL_BOOKS);
    if (response.statusCode == 200) {
      List<BookModel> books = List<BookModel>.from(
              response.data["data"]?.map((book) => BookModel.fromJson(book)))
          .toList();
      return Future.value(books);
    } else {
      throw ExceptionService();
    }
  }

  @override
  Future<BookResponseModel> getResponseBook() async {
    final response = await dio.get(ALL_BOOKS);
    if (response.statusCode == 200) {
      BookResponseModel bookResponse =
          BookResponseModel.fromJson(response.data);
      return Future.value(bookResponse);
    } else {
      throw ExceptionService();
    }
  }
}
