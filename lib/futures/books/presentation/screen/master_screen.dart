import 'dart:math';

import 'package:book_store/core/themes/divider_app.dart';
import 'package:book_store/futures/books/presentation/bloc/books_bloc.dart';
import 'package:carousel_slider/carousel_options.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:get/instance_manager.dart';
import 'package:smooth_page_indicator/smooth_page_indicator.dart';
import 'package:get/get.dart';
import '../../../../core/constants/strings.dart';
import '../../../../core/themes/colors.dart';
import '../../../../core/themes/text_app.dart';
import '../../domain/entites/book.dart';
import '../../pressntation/widgets/horz_list_books.dart';

class MasterScreen extends StatefulWidget {
  const MasterScreen({Key? key}) : super(key: key);

  @override
  State<MasterScreen> createState() => _MasterScreenState();
}

class _MasterScreenState extends State<MasterScreen> {
  final pageController = PageController();
  final notiferPAgeController = ValueNotifier(0.0);
  @override
  void initState() {
    pageController.addListener(_lisenerPageController);
    super.initState();
  }

  _lisenerPageController() {
    notiferPAgeController.value = pageController.page!;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: pagesPadding,
        child: BlocBuilder<BooksBloc, BooksState>(builder: (c, state) {
          if (state is BooksLoading) {
            return Center(child: CircularProgressIndicator());
          } else if (state is BooksFailed) {
            return Center(
              child: Text("${state.msg}"),
            );
          } else if (state is BooksSuccess) {
            return _buildScreen(state.books);
          }
          return Center(child: CircularProgressIndicator());
        }),
      ),
    );
  }

  Widget _buildScreen(List<Book> books) => Scaffold(body: _buildBody(books));

  Widget _buildBody(List<Book> books) => NestedScrollView(
        headerSliverBuilder: ((context, innerBoxIsScrolled) =>
            [_appBarSliver(books)]),
        body: Container(
          padding: pagesPadding,
          color: Colors.white,
          width: double.infinity,
          height: double.infinity,
          child: SingleChildScrollView(
            physics: BouncingScrollPhysics(),
            child: Column(
              children: [
                _autoScrollCarouseIteams(books),
                HorzintalListBooks(
                  books: books,
                  title: "Top Viewed",
                ),
                HorzintalListBooks(
                  books: books,
                  title: "Recent",
                ),
                HorzintalListBooks(
                  books: books,
                  title: "News",
                ),
              ],
            ),
          ),
        ),
      );

  _autoScrollCarouseIteams(List<Book> books) => Column(
        children: [
          //   _headerHorizntalList("Popular", books),
          CarouselSlider.builder(
            itemCount: books.length,
            itemBuilder: (context, index, x) {
              return Container(
                width: 220,
                height: 100,
                decoration: BoxDecoration(
                    border: Border.all(color: shadowColor),
                    borderRadius: const BorderRadius.all(Radius.circular(5))),
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
                          _rateSection(books[index], 9.0),
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
            ),
          )
        ],
      );

  _headerHorizntalList(String src, List<Book> books) => SizedBox(
        width: double.infinity,
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            TextApp(src).subTitleTextStyle(),
            IconButton(
                onPressed: () => null,
                // onPressed: () => Get.to(() => SearchScreen(books)),
                icon: Icon(
                  Icons.more_horiz,
                  color: iconColor,
                  size: 20,
                ))
          ],
        ),
      );

  _appBarSliver(List<Book> books) => SliverPersistentHeader(
      pinned: true,
      delegate: DelegateAppSliver(
          books: books,
          pageController: pageController,
          notiferPAgeController: notiferPAgeController));

  _rateSection(Book book, double size) => Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          RatingBar.builder(
            initialRating: book.rate.toDouble(),
            minRating: 1,
            direction: Axis.horizontal,
            allowHalfRating: true,
            unratedColor: Colors.amber.withAlpha(50),
            itemCount: 5,
            itemSize: size,
            itemPadding: EdgeInsets.symmetric(horizontal: 1.0),
            itemBuilder: (context, _) => Icon(
              Icons.star,
              color: Colors.amber,
            ),
            onRatingUpdate: (rating) {},
          ),
          SizedBox(width: 4),
          TextApp("${book.rate}")
              .generalTextStyle(iconColor, size, FontWeight.w400)
        ],
      );
}

Future<void> _onRefresh(BuildContext context) async {
  BlocProvider.of<BooksBloc>(context)..add(RefreshBooks());
}

class DelegateAppSliver extends SliverPersistentHeaderDelegate {
  final List<Book> books;
  final PageController pageController;
  final ValueNotifier notiferPAgeController;

  final bookImageHeight = 320.0;
  final bookImageWidth = 260.0;

  DelegateAppSliver(
      {required this.books,
      required this.pageController,
      required this.notiferPAgeController});

  @override
  Widget build(
      BuildContext context, double shrinkOffset, bool overlapsContent) {
    return _pageView(books);
  }

  @override
  double get maxExtent => 500;

  @override
  double get minExtent => 80;

  @override
  bool shouldRebuild(covariant SliverPersistentHeaderDelegate oldDelegate) =>
      false;

  _rateSection(Book book, double size) => Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          RatingBar.builder(
            initialRating: book.rate.toDouble(),
            minRating: 1,
            direction: Axis.horizontal,
            allowHalfRating: true,
            unratedColor: Colors.amber.withAlpha(50),
            itemCount: 5,
            itemSize: size,
            itemPadding: EdgeInsets.symmetric(horizontal: 1.0),
            itemBuilder: (context, _) => Icon(
              Icons.star,
              color: Colors.amber,
            ),
            onRatingUpdate: (rating) {},
          ),
          SizedBox(width: 4),
          TextApp("${book.rate}")
              .generalTextStyle(iconColor, size, FontWeight.w400)
        ],
      );

  _pageView(List<Book> books) => Stack(
        children: [
          Container(
            width: double.infinity,
            decoration: BoxDecoration(
              gradient: LinearGradient(
                  colors: [Colors.white, Colors.grey.shade300],
                  begin: Alignment.bottomRight,
                  end: Alignment.topLeft),
            ),
            // padding: EdgeInsets.only(top: 60, left: 14),
          ),
          Positioned(
              top: 60,
              bottom: 0,
              right: 0,
              left: 20,
              child: _buildPageView(books)),
          Positioned(
              left: 0,
              bottom: 0,
              child: Container(
                width: double.infinity,
                height: 40,
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                      colors: [Colors.white, Colors.grey.shade200],
                      begin: Alignment.bottomRight,
                      end: Alignment.topLeft),
                ),
                padding: iteamsInnerPadding,
                child: SmoothPageIndicator(
                  controller: pageController,
                  count: books.length > 7 ? 7 : books.length,
                  effect: WormEffect(
                      dotWidth: 20,
                      dotHeight: 10,
                      dotColor: Colors.white,
                      activeDotColor: selectorColor),
                ),
              )),
          Positioned(
            bottom: 40,
            right: 10,
            child: Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                    borderRadius:
                        BorderRadius.only(topLeft: Radius.circular(25))),
                child: Center(
                    child: TextApp(Strings.splitString20(
                            books[notiferPAgeController.value.toInt()].author))
                        .subTitleTextStyle3())),
          ),
          Positioned(
              bottom: 10,
              right: 40,
              child: _rateSection(
                  books[notiferPAgeController.value.toInt()], 14.0)),
          Positioned(
              top: 30,
              left: 20,
              child: Icon(
                Icons.menu_book_outlined,
                color: iconColor,
                size: 25,
              )),
          Positioned(
              bottom: 50, left: 25, child: _build_ninteAngle_withTwoColors())
        ],
      );
  _build_ninteAngle_withTwoColors() => Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            height: 45,
            width: 1,
            color: titleTextColor,
          ),
          SizedBox(height: 2),
          Container(
            height: 1,
            width: 45,
            color: primaryColor,
          ),
        ],
      );

  _buildPageView(List<Book> books) => PageView.builder(
      controller: pageController,
      itemCount: books.length,
      scrollDirection: Axis.horizontal,
      itemBuilder: ((context, index) {
        final current = index - notiferPAgeController.value;
        final rotate = current.clamp(0.0, 1.0);
        final fixRotate = pow(rotate, 0.35);
        return Container(
          width: double.infinity,
          padding: const EdgeInsets.only(top: 12),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.start,
            children: [
              RotatedBox(
                quarterTurns: 1,
                child: Opacity(
                    opacity: 1 - rotate as double,
                    child: TextApp(Strings.splitString50(books[index].title))
                        .titleTextStyle()),
              ),
              SizedBox(width: 10),
              Stack(
                children: [
                  Container(
                    width: bookImageWidth,
                    height: bookImageHeight,
                    decoration:
                        BoxDecoration(color: Colors.grey.shade200, boxShadow: [
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
      }));
}
