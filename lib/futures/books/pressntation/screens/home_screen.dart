import 'package:book_store/core/screens/core_screen.dart';
import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class HomeScreen extends CoreScreen<BooksController> {
  @override
  Widget build(BuildContext context) => _buildScreen();

  Widget _buildScreen() => Scaffold(
        appBar: _buildAppBar(),
        body: _buildBody(),
      );
  AppBar _buildAppBar() => AppBar();
  Widget _buildBody() => GetBuilder<BooksController>(
      init: BooksController(),
      builder: (controller) => Container(
            child: ListView.builder(
                itemCount: controller.books.length,
                itemBuilder: (c, index) =>
                    Text("${controller.books[index].title}")),
          ));
}
