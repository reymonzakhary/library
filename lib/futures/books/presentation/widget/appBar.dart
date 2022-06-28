import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class DefaultAppBar extends GetView<BooksController>
    implements PreferredSizeWidget {
  const DefaultAppBar({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      color: Colors.grey,
    );
  }

  @override
  Size get preferredSize => Size(Get.width, 40);
}
