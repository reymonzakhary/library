import 'package:book_store/core/constants/strings.dart';
import 'package:book_store/futures/books/data/datasource/RemoteDataSource/base_remote_dataSource.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
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
  Future<BookResponseModel> getBooks() async {
    final response = await dio.get(ALL_BOOKS);

    if (response.statusCode == 200) {

      BookResponseModel bookResponseModel =BookResponseModel.fromJson(response.data);
      return Future.value(bookResponseModel);
    } else {

      throw ExceptionService();

    }
  }
}
