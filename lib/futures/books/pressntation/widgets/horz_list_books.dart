import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:get/get.dart';

import '../../domain/entites/book.dart';

class HorzintalListBooks extends GetView<BooksController> {
  final List<Book> books;

  HorzintalListBooks(this.books);
  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        SizedBox(
          height: 140,
          child: ListView.builder(
              scrollDirection: Axis.horizontal,
              shrinkWrap: true,
              itemCount: books.length,
              itemBuilder: (_, index) => Padding(
                    padding: EdgeInsets.only(right: 8),
                    child: InkWell(
                        // onTap: () => Get.to(() => ProfileScreen(books[index])),
                        child: Container(
                      height: 120,
                      width: 80,
                      decoration: BoxDecoration(
                          image: DecorationImage(
                              image: NetworkImage(books[index].img))),
                    )),
                  )),
        ),
      ],
    );
  }
}
