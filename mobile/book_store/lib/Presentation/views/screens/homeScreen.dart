import 'dart:math';
import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:book_store/Presentation/views/widgets/appSearchBar.dart';
import 'package:book_store/Presentation/views/widgets/horizantialSection.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:smooth_page_indicator/smooth_page_indicator.dart';

class HomeScreen extends GetView<HomeController> {
  final bookImageHeight = 215.0;
  final bookImageWidth = 170.0;
  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
        init: HomeController(),
        builder: (controller) => Scaffold(
            appBar: AppBar(
                title: AppSearchBar(),
                 leading:  Container(
               child: const Icon(Icons.menu_book , color: Colors.black , size: 20,),
                     ),
                centerTitle: true,
                backgroundColor: Colors.white,
                elevation: 0,),
              body: CustomScrollView(
                slivers: [_appBarSliver(), _bodySliver()],
              ),
            ));
  }

  _appBarSliver() => SliverAppBar(
        flexibleSpace: _pageView(),
        automaticallyImplyLeading: false,
        toolbarHeight: 270,
      );
  _bodySliver() => SliverToBoxAdapter(
        child: Column(
          children: [
            // _Recent(),
            HorizantalScetion(title: "POPULAR", books: controller.books),
            // _topRate(),
            HorizantalScetion(title: "MOST VIEWED", books: controller.books),
            HorizantalScetion(title: "MOST DOWNLOADED", books: controller.books),
           ],
        ),
      );

  _pageView() => Container(
        width: Get.width,
        color: Colors.grey.shade100,
        padding: const EdgeInsets.all(14),
        child: PageView.builder(
            controller: controller.pageController,
            itemCount: controller.books.length,
            scrollDirection: Axis.horizontal,
            itemBuilder: ((context, index) {
              final current = index - controller.notiferPAgeController.value;
              final rotate = current.clamp(0.0, 1.0);
              final book = controller.books[index];
              final fixRotate = pow(rotate, 0.35);
              return Container(
                width: Get.width,
                padding: EdgeInsets.only(top: 10),
                child: Row(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Opacity(
                            opacity: 1 - rotate,
                            child: Text("${book.name}",
                                textAlign: TextAlign.start,
                                style: GoogleFonts.abrilFatface(
                                  textStyle: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18,
                                    fontWeight: FontWeight.w600,
                                    letterSpacing: .5,
                                  ),
                                ))),
                        SizedBox(height: 10),
                        Container(
                          width: 140,
                          child: Text(
                              "Description of catigories of to expaln how can you get here \n to make idea we m4 store book m4 hat2dr te8amed 3enek \n afred masln masln any 5asmetk yom.",
                             style: GoogleFonts.abhayaLibre(
                                  textStyle: TextStyle(
                                    color: Colors.black,
                                    fontSize: 14,
                                    fontWeight: FontWeight.w500,
                                    letterSpacing: .5,
                                  ),
                                ),
                              textAlign: TextAlign.start),
                        )
                           ,SizedBox(height: 20,)
                          ,  SmoothPageIndicator(
                           controller: controller.pageController,
                             count: controller.categories.length,
                             effect: WormEffect(
                                 dotWidth: 10,
                                 dotHeight: 10,
                                 dotColor: Colors.grey.shade300,
                                 activeDotColor: Colors.black
                             ),)
                      ],
                    ),
                    SizedBox(width: 40),
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
                                    offset: Offset(5.0, 5.0),
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
                          child: Image.asset(
                            book.image,
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
      );
 _pageView2() => Container(
        width: Get.width,
        color: Colors.grey.shade100,
        padding: const EdgeInsets.all(14),
        child: PageView.builder(
            controller: controller.pageController,
            itemCount: controller.books.length,
            scrollDirection: Axis.horizontal,
            itemBuilder: ((context, index) {
              final current = index - controller.notiferPAgeController.value;
               final rotate = current.clamp(0.0, 1.0);
              final book = controller.books[index];
              final fixRotate = pow(rotate, 0.35);
              return Container(
                width: Get.width,
                padding: EdgeInsets.only(top: 10),
                child:    Center(
                  child: Column(
                      children: [
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
                                      offset: Offset(5.0, 5.0),
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
                            child: Image.asset(
                              book.image,
                              width: bookImageWidth,
                              height: bookImageHeight,
                              fit: BoxFit.fill,
                            ),
                          ),
                        ],
                      ),
                       SmoothPageIndicator(
                           controller: controller.pageController,
                             count: controller.books.length,
                             effect: WormEffect(
                                 dotWidth: 12,
                                 dotHeight: 12,
                                 dotColor: Colors.white,
                                 activeDotColor: Colors.blueAccent.shade400
                             ),)
                      ],
                  )
                ),
              );
            })),
      );


  _Recent() => Container(
        color: Colors.grey.shade200,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
                padding: EdgeInsets.all(8),
                child: Text(
                  "RECENT",
                  style: TextStyle(
                      color: blueColor400,
                      fontSize: 18,
                      fontWeight: FontWeight.w800),
                )),
            CarouselSlider.builder(
                itemCount: controller.books.length,
                itemBuilder: (context, index, x) {
                  return Container(
                    child: Image.asset(
                      controller.books[index].image,
                      width: 120,
                      height: 120,
                    ),
                  );
                },
                options: CarouselOptions(
                  height: 100,
                  aspectRatio: 16 / 9,
                  viewportFraction: .5,
                  enlargeCenterPage: true,
                  autoPlay: true,
                  pauseAutoPlayInFiniteScroll: true,
                ))
          ],
        ),
      );
  _topRate() => Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
              padding: const EdgeInsets.all(8),
              child: Text("TOP RATE",
                  textAlign: TextAlign.start,
                  style: GoogleFonts.abrilFatface(
                    textStyle: TextStyle(
                      color: Colors.black,
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                      letterSpacing: .5,
                    ),
                  ))),
          Container(
              height: 180,
              padding: const EdgeInsets.only(left: 8, right: 8),
              child: GridView.count(
                scrollDirection: Axis.horizontal,
                crossAxisSpacing: 4,
                mainAxisSpacing: 8,
                crossAxisCount: 2,
                childAspectRatio: 1 / 3,
                children: List.generate(
                    controller.books.length,
                    (index) => Container(
                          decoration: BoxDecoration(
                              border: Border.all(
                                  color: Colors.grey.shade400, width: 1)),
                          child: Row(
                            children: [
                              Image.asset(controller.books[index].image,
                                  fit: BoxFit.cover),
                              const SizedBox(width: 10),
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text("${controller.books[index].name}",
                                      textAlign: TextAlign.start,
                                      style: GoogleFonts.abrilFatface(
                                        textStyle: TextStyle(
                                          color: Colors.black,
                                          fontSize: 12,
                                          fontWeight: FontWeight.w400,
                                          letterSpacing: .5,
                                        ),
                                      )),
                                  Expanded(
                                      child: Container(
                                          width: 180,
                                          child: Text(
                                              "to make idea we m4 store book m4 hat2dr te8amed 3enek afred masln masln any 5asmetk yom.",
                                              style: TextStyle(
                                                color: Colors.grey.shade600,
                                                fontSize: 10,
                                                fontWeight: FontWeight.w300,
                                              )))),
                                  Row(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      RatingBar.builder(
                                        initialRating: 3,
                                        minRating: 1,
                                        direction: Axis.horizontal,
                                        allowHalfRating: true,
                                        unratedColor:
                                            Colors.amber.withAlpha(50),
                                        itemCount: 5,
                                        itemSize: 12.0,
                                        itemPadding: EdgeInsets.symmetric(
                                            horizontal: 4.0),
                                        itemBuilder: (context, _) => Icon(
                                          Icons.star,
                                          color: Colors.amber,
                                        ),
                                        onRatingUpdate: (rating) {
                                          print(rating);
                                        },
                                        updateOnDrag: true,
                                      ),
                                      Text("4.5",
                                          textAlign: TextAlign.start,
                                          style: GoogleFonts.abrilFatface(
                                            textStyle: TextStyle(
                                              color: Colors.black,
                                              fontSize: 12,
                                              fontWeight: FontWeight.w400,
                                              letterSpacing: .5,
                                            ),
                                          ))
                                    ],
                                  ),
                                ],
                              )
                            ],
                          ),
                        )),
              ))
        ],
      );

}
