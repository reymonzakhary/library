import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/Repositries/ExampleData.dart';
import 'package:flutter/cupertino.dart';
import 'package:get/get.dart';

class HomeController extends GetxController {
  List<Book> books = [];
  final pageController = PageController();
  final notiferPAgeController = ValueNotifier(0.0);

  _lisenerPageController() {
    notiferPAgeController.value = pageController.page!;
    update();
  }

  @override
  void onInit() {
    books = ExampleData.books;
    pageController.addListener(_lisenerPageController);
    super.onInit();
  }

  @override
  void onClose() {
    pageController.removeListener(_lisenerPageController);
    pageController.dispose();
    super.onClose();
  }
}
