import 'package:book_store/core/controllers/core_controller.dart';
import 'package:book_store/core/errors/exception/exception.dart';
import 'package:book_store/core/errors/failure/failure.dart';
import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/domain/entites/book_response.dart';
import 'package:book_store/futures/books/domain/usecases/get_books_usecases.dart';
import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../../domain/entites/book.dart';

class BooksController extends CoreController with StateMixin {
  final GetBooksUseCases getBooksUseCases;

  BooksController({required this.getBooksUseCases});
  List<Book> books = [];

  final pageController = PageController();
  final notiferPAgeController = ValueNotifier(0.0);
  RxList<String> selectedCatigories = <String>[].obs;
  ScrollController scrollController = ScrollController();
  @override
  void onInit() {
    pageController.addListener(_lisenerPageController);
    getAllBooks();

    super.onInit();
  }

  _lisenerPageController() {
    notiferPAgeController.value = pageController.page!;
    update();
  }

  getAllBooks() async {
    change(books, status: RxStatus.loading());

    final result = await getBooksUseCases.call();

    result.fold((failure) {
      FaluireService();
    }, (booksList) {
      books = booksList.books;
      change(books, status: RxStatus.success());
    });
  }

  // refreshAllBooks() async {
  //   final result = await getBooksUseCases.refresh();
  //   final options = BaseOptions(
  //     headers: {
  //       "Accept": "application/json",
  //       "Content-Type": "application/json",
  //     },
  //   );
  //   Dio dio = Dio(options);

  //   result.fold((failure) => FaluireService(), (response) async {
  //     if (response.meta.currentPage == response.meta.lastPage) {
  //       print("it is last");
  //     } else {
  //       print("else book");
  //       change(books, status: RxStatus.loading());
  //       try {
  //         final nextResopnse = await dio.get("${response.link.next}");
  //         if (nextResopnse.statusCode == 200) {
  //           print(200);
  //           BookResponse bookResponse =
  //               BookResponseModel.fromJson(nextResopnse.data);
  //           print(bookResponse.books);
  //           books.addAll(bookResponse.books);
  //           change(books, status: RxStatus.success());
  //         } else {
  //           print(nextResopnse.statusCode);
  //         }
  //       } catch (e) {
  //         print(e.toString());
  //       }
  //     }
  //   });
  // }

  // _topRateBooks() async {
  //   top_rate_books = books.where((book) => book.rate.toInt() > 4).toList();
  //   change(top_rate_books, status: RxStatus.success());
  //   if (top_rate_books.length > 6) {
  //     change(top_rate_books.getRange(0, 6).toList(),
  //         status: RxStatus.success());
  //   } else {
  //     change(top_rate_books, status: RxStatus.success());
  //   }
  // }
}
