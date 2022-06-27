import 'package:book_store/core/constants/strings.dart';
import 'package:book_store/core/themes/divider_app.dart';
import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:get/get.dart';

import '../../../../core/themes/colors.dart';
import '../../../../core/themes/text_app.dart';
import '../../domain/entites/book.dart';
import '../screens/search_screen.dart';

class HorzintalListBooks extends GetView<BooksController> {
  final List<Book> books;
  final String title;
  HorzintalListBooks({required this.books, required this.title});
  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Divders().defaultDivder,
        _headerHorizntalList(title, books),
        Divders().defaultDivder,
        CarouselSlider.builder(
            options: CarouselOptions(
              height: 120,
              aspectRatio: 4 / 3,
              viewportFraction: .2,
              enlargeCenterPage: true,
            ),
            itemCount: books.length,
            itemBuilder: (context, index, x) => Padding(
                  padding: EdgeInsets.only(right: 6),
                  child: InkWell(
                      // onTap: () => Get.to(() => ProfileScreen(books[index])),
                      child: Stack(children: [
                    Container(
                      decoration: BoxDecoration(
                        image: DecorationImage(
                            fit: BoxFit.cover,
                            image: NetworkImage(books[index].img)),
                      ),
                    ),
                    Container(
                      decoration: BoxDecoration(
                        gradient: LinearGradient(
                            colors: [
                              Colors.black,
                              Colors.transparent,
                            ],
                            begin: Alignment.bottomCenter,
                            end: Alignment.topCenter),
                      ),
                    ),
                    Positioned(
                        bottom: 4,
                        right: 4,
                        left: 4,
                        child:
                            TextApp(Strings.splitString20(books[index].title))
                                .descriptionTextStyle2())
                  ])),
                )),
      ],
    );
  }

  _headerHorizntalList(String src, List<Book> books) => SizedBox(
        width: Get.width,
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                TextApp(src).subTitleTextStyle(),
                SizedBox(
                  height: 4,
                ),
                TextApp("Result: ${books.length}").descriptionTextStyle(),
              ],
            ),
            IconButton(
                onPressed: () => Get.to(() => SearchScreen(books)),
                icon: Icon(
                  Icons.more_horiz,
                  color: iconColor,
                  size: 20,
                ))
          ],
        ),
      );
}
