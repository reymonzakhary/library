import 'dart:math';
import 'package:book_store/futures/books/pressntation/screens/search_screen.dart';
import 'package:carousel_slider/carousel_slider.dart';

import 'package:book_store/core/screens/core_screen.dart';
import 'package:book_store/core/themes/divider_app.dart';
import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:book_store/futures/books/pressntation/widgets/appBar.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:get/get.dart';
import 'package:smooth_page_indicator/smooth_page_indicator.dart';

import '../../../../core/themes/colors.dart';
import '../../../../core/themes/text_app.dart';
import '../../domain/entites/book.dart';

class HomeScreen extends CoreScreen<BooksController> {
  final bookImageHeight = 280.0;
  final bookImageWidth = 160.0;
  @override
  Widget build(BuildContext context) => _buildScreen();

  Widget _buildScreen() => Scaffold(
        body: _buildBody(),
      );

  Widget _buildBody() => controller.obx((state) => RefreshIndicator(
        onRefresh: () => controller.refreshAllBooks(),
        child: CustomScrollView(
          slivers: [_buildheaderBody(state!), _buildsubBody(state!)],
        ),
      ));

  _buildheaderBody(List<Book> books) => SliverAppBar(
        flexibleSpace: _pageView(books),
        automaticallyImplyLeading: false,
        toolbarHeight: Get.height * 0.7,
      );
  _buildsubBody(List<Book> books) => SliverToBoxAdapter(
        child: Container(
          padding: pagesPadding,
          color: titleTextColor,
          width: Get.width,
          height: Get.height,
          child: SingleChildScrollView(
            child: Column(
              children: [
                _headerHorizntalList("TOP", books),
                CarouselSlider.builder(
                    itemCount: controller.books.length,
                    itemBuilder: (context, index, x) {
                      return Container(
                        width: 220,
                        height: 100,
                        decoration: BoxDecoration(
                            color: Colors.white,
                            // border: Border.all(color: shadowColor),
                            borderRadius: BorderRadius.all(Radius.circular(5))),
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Container(
                              padding: iteamsInnerPadding,
                              width: 120,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  TextApp(books[index].title).generalTextStyle(
                                      generalTextColor, 10, FontWeight.bold),

                                  TextApp(books[index].author).generalTextStyle(
                                      descriptonTextColor,
                                      9,
                                      FontWeight.normal),
                                  SizedBox(height: 2),
                                  Row(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      RatingBar.builder(
                                        initialRating: 3,
                                        minRating: 1,
                                        direction: Axis.horizontal,
                                        allowHalfRating: true,
                                        unratedColor:
                                            Colors.amber.withAlpha(50),
                                        itemCount: 5,
                                        itemSize: 9.0,
                                        itemPadding: EdgeInsets.symmetric(
                                            horizontal: 1.0),
                                        itemBuilder: (context, _) => Icon(
                                          Icons.star,
                                          color: Colors.amber,
                                        ),
                                        onRatingUpdate: (rating) {
                                          print(rating);
                                        },
                                        updateOnDrag: true,
                                      ),
                                      SizedBox(width: 4),
                                      TextApp("3.5").generalTextStyle(
                                          generalTextColor,
                                          9,
                                          FontWeight.normal)
                                    ],
                                  ),
                                  // Container(width: 40, child: TextApp(books[index].content).descriptionTextStyle(),)
                                ],
                              ),
                            ),
                            Expanded(
                              child: ClipRRect(
                                  borderRadius: BorderRadius.only(
                                      topRight: Radius.circular(4),
                                      bottomRight: Radius.circular(4)),
                                  child: Image.network(
                                    books[index].img,
                                    fit: BoxFit.fill,
                                  )),
                            ),
                          ],
                        ),
                      );
                    },
                    options: CarouselOptions(
                      height: 100,
                      aspectRatio: 16 / 9,
                      viewportFraction: .5,
                      enlargeCenterPage: true,
                      autoPlay: true,
                      autoPlayInterval: Duration(seconds: 6),
                      pauseAutoPlayInFiniteScroll: true,
                    ))
              ],
            ),
          ),
        ),
      );

  _pageView(List<Book> books) => Stack(
        children: [
          Container(
            width: Get.width,
            decoration: BoxDecoration(
              gradient: LinearGradient(
                  colors: [Colors.white, Colors.grey.shade400],
                  begin: Alignment.bottomRight,
                  end: Alignment.topLeft),
            ),
            padding: EdgeInsets.only(top: 60, right: 14, left: 14, bottom: 14),
            child: PageView.builder(
                controller: controller.pageController,
                itemCount: controller.books.length,
                scrollDirection: Axis.horizontal,
                itemBuilder: ((context, index) {
                  final current =
                      index - controller.notiferPAgeController.value;
                  final rotate = current.clamp(0.0, 1.0);
                  final fixRotate = pow(rotate, 0.35);
                  return Container(
                    width: Get.width,
                    padding: EdgeInsets.only(top: 8),
                    child: Row(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      mainAxisAlignment: MainAxisAlignment.start,
                      children: [
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Opacity(
                                    opacity: 1 - rotate,
                                    child: TextApp(books[index].title)
                                        .titleTextStyle()),
                                defaultVerticalSpace,
                                Container(
                                  width: 140,
                                  child: TextApp(books[index].content)
                                      .descriptionTextStyle(),
                                )
                              ],
                            ),
                          ],
                        ),
                        SizedBox(width: 10),
                        Stack(
                          children: [
                            Container(
                              width: bookImageWidth,
                              height: bookImageHeight,
                              decoration: BoxDecoration(
                                  color: Colors.grey.shade200,
                                  boxShadow: [
                                    const BoxShadow(
                                        color: Colors.black26,
                                        blurRadius: 20,
                                        offset: Offset(5.0, 20.0),
                                        spreadRadius: 10)
                                  ]),
                            ),
                            Transform(
                              alignment: Alignment.centerLeft,
                              transform: Matrix4.identity()
                                ..setEntry(3, 2, 0.002)
                                ..rotateY(1.8 * fixRotate)
                                ..translate(-rotate * Get.size.width * 0.8)
                                ..scale(1 + rotate),
                              child: Image.network(
                                books[index].img,
                                width: bookImageWidth,
                                height: bookImageHeight,
                                fit: BoxFit.fill,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  );
                })),
          ),
          Positioned(
              left: 0,
              bottom: 0,
              child: Container(
                color: Color.fromARGB(255, 3, 35, 61),
                width: Get.width,
                height: 40,
                padding: iteamsInnerPadding,
                child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      SmoothPageIndicator(
                        controller: controller.pageController,
                        count: books.length > 7 ? 7 : books.length,
                        effect: WormEffect(
                            dotWidth: 20,
                            dotHeight: 10,
                            dotColor: Colors.white,
                            activeDotColor: selectorColor),
                      ),
                    ]),
              )),
          Positioned(
              right: 0,
              bottom: 0,
              child: Container(
                padding: iteamsInnerPadding,
                width: 200,
                child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Container(
                        width: 12,
                        height: 12,
                        decoration: BoxDecoration(
                            color: Colors.green,
                            borderRadius:
                                BorderRadius.all(Radius.circular(25))),
                      ),
                      TextApp(books[0].author).generalTextStyle(
                          descriptonTextColor, 9, FontWeight.normal),
                    ]),
              ))
        ],
      );
  _headerHorizntalList(String src, List<Book> books) => SizedBox(
        width: Get.width,
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            TextApp(src).subTitleTextStyle(),
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
  _searchIteam(List<Book> books) => Column(
        children: [
          _headerHorizntalList("TOP", books),
          CarouselSlider.builder(
              itemCount: controller.books.length,
              itemBuilder: (context, index, x) {
                return Container(
                  width: 220,
                  height: 100,
                  decoration: BoxDecoration(
                      border: Border.all(color: shadowColor),
                      borderRadius: BorderRadius.all(Radius.circular(5))),
                  child: Row(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Container(
                        padding: iteamsInnerPadding,
                        width: 120,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            TextApp(books[index].title).generalTextStyle(
                                generalTextColor, 10, FontWeight.bold),

                            TextApp(books[index].author).generalTextStyle(
                                descriptonTextColor, 9, FontWeight.normal),
                            SizedBox(height: 2),
                            Row(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                RatingBar.builder(
                                  initialRating: 3,
                                  minRating: 1,
                                  direction: Axis.horizontal,
                                  allowHalfRating: true,
                                  unratedColor: Colors.amber.withAlpha(50),
                                  itemCount: 5,
                                  itemSize: 9.0,
                                  itemPadding:
                                      EdgeInsets.symmetric(horizontal: 1.0),
                                  itemBuilder: (context, _) => Icon(
                                    Icons.star,
                                    color: Colors.amber,
                                  ),
                                  onRatingUpdate: (rating) {
                                    print(rating);
                                  },
                                  updateOnDrag: true,
                                ),
                                SizedBox(width: 4),
                                TextApp("3.5").generalTextStyle(
                                    generalTextColor, 9, FontWeight.normal)
                              ],
                            ),
                            // Container(width: 40, child: TextApp(books[index].content).descriptionTextStyle(),)
                          ],
                        ),
                      ),
                      Expanded(
                        child: ClipRRect(
                            borderRadius: BorderRadius.only(
                                topRight: Radius.circular(4),
                                bottomRight: Radius.circular(4)),
                            child: Image.network(
                              books[index].img,
                              fit: BoxFit.fill,
                            )),
                      ),
                    ],
                  ),
                );
              },
              options: CarouselOptions(
                height: 100,
                aspectRatio: 16 / 9,
                viewportFraction: .5,
                enlargeCenterPage: true,
                autoPlay: true,
                autoPlayInterval: Duration(seconds: 6),
                pauseAutoPlayInFiniteScroll: true,
              ))
        ],
      );
}
