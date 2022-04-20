import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Data/utilities/textStyle.dart';
import 'package:book_store/Presentation/views/screens/profileScreen.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class HorizantalScetion extends GetView {
final  String title;
final List<Book> books;
  HorizantalScetion({required this.title ,required this.books});
  @override
  Widget build(BuildContext context) {
    return Container(
        height: heightHorizantlSection,
                child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Divider(),
            Container(
              padding: const EdgeInsets.only(left: 8, right: 8),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  TextStyleApp.textStyleTitle(title ,TextAlign.start , false),
                  Row(
                    children: [
                    TextStyleApp.textStyledesc("Sell All" , TextAlign.center , false),
                     const  SizedBox(width: 5),
                      const Icon(
                        Icons.more_horiz,
                        color: Colors.grey,
                      )
                    ],
                  ),
                ],
              ),
            ),
            Container(
              height: 180,
              child: ListView.builder(
                scrollDirection: Axis.horizontal,
                itemBuilder: (context, index) {
                  return Container(
                      padding: EdgeInsets.all(8), child: _bookBody(index));
                },
                itemCount: books.length,
              ),
            ),
            Divider(),
          ],
        ),

    );
  }
   _bookBody(index) => InkWell(
      onTap: () => Navigator.of(Get.context!).push(
            PageRouteBuilder(
                transitionDuration: const Duration(milliseconds: 550),
                reverseTransitionDuration:const  Duration(milliseconds: 550),
                pageBuilder: (c, animation, a) {
                  return FadeTransition(
                    opacity: animation,
                    child: ProfileScreen(book: books[index]),
                  );
                }),
          ),
      child: Image.asset(
       books[index].image,
        width: 100,
        height: 120,
      ));

}
