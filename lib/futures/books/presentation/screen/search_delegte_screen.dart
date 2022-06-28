import 'package:book_store/futures/books/pressntation/controllers/books_controller.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:get/get.dart';

import '../../../../core/themes/colors.dart';
import '../../../../core/themes/divider_app.dart';
import '../../../../core/themes/text_app.dart';
import '../../domain/entites/book.dart';

class SearchDelegeteScreen extends SearchDelegate<String> {
  final List<Book> books;
  SearchDelegeteScreen(this.books);

  @override
  List<Widget>? buildActions(BuildContext context) {
    return [
      Padding(
        padding: const EdgeInsets.all(12),
        child: ContainerApp(pressed: () {}).headerButton(Icons.filter_list, () {
          if (query.isEmpty) {
            close(context, "");
          } else {
            query = '';
            showSuggestions(context);
          }
        }, false),
      ),
    ];
  }

  @override
  PreferredSizeWidget? buildBottom(BuildContext context) {
    return PreferredSize(
      preferredSize: Size(Get.width, 50),
      child: Container(
        height: 50,
        padding: iteamsInnerPadding,
        child: GetBuilder<BooksController>(
          init: BooksController(getBooksUseCases: Get.find()),
          builder: (homeController) => ListView.builder(
            itemCount: books[0].catigories.length,
            scrollDirection: Axis.horizontal,
            itemBuilder: (_, index) => InkWell(
                // onTap: ()=> homeController.searchForBook(books[0].catigories[index] , query),
                child: Card(
              // color:  homeController.selectedCatigories.contains(books[0].catigories[index]) == false ? Colors.white : primaryColor,
              elevation: 2,
              //   child: Padding(
              //     padding: horzantialIteamPadding,
              //     child: Center(child: TextApp(books[0].catigories[index]).generalTextStyle(homeController.selectedCatigories.contains(books[0].catigories[index]) == false ? shadowColor : backgroundColor, 10, FontWeight.w400),)),
              // ),
            )),
          ),
        ),
      ),
    );
  }

  @override
  // TODO: implement searchFieldDecorationTheme
  InputDecorationTheme? get searchFieldDecorationTheme =>
      InputDecorationTheme();
  @override
  TextInputType? get keyboardType => TextInputType.name;

  @override
  Widget? buildLeading(BuildContext context) => Padding(
      padding: EdgeInsets.all(15),
      child: ContainerApp(pressed: () {
        close(context, "");
      }).headerButton(Icons.arrow_back, () => close(context, ""), false));

  @override
  TextInputAction get textInputAction => TextInputAction.search;

  @override
  ThemeData appBarTheme(BuildContext context) {
    final ThemeData theme = Theme.of(context);
    return ThemeData(
        inputDecorationTheme: InputDecorationTheme(
          focusColor: primaryColor,
          isDense: true,
          isCollapsed: true,
          border: OutlineInputBorder(
            gapPadding: 0,
            borderSide: const BorderSide(color: shadowColor),
            borderRadius: BorderRadius.circular(25),
          ),
          focusedBorder: OutlineInputBorder(
            gapPadding: 0,
            borderSide: const BorderSide(color: primaryColor),
            borderRadius: BorderRadius.circular(5),
          ),
          labelStyle:
              TextStyle(backgroundColor: shadowColor, color: Colors.black),
          contentPadding:
              const EdgeInsets.symmetric(vertical: 10, horizontal: 12),
        ),
        appBarTheme: AppBarTheme(
          centerTitle: true,
          toolbarHeight: 60,
          elevation: 0.0,
          backgroundColor: backgroundColor,
        ));
  }

  @override
  Widget buildResults(BuildContext context) {
//         BooksController homeController = Get.put(BooksController(getBooksUseCases: Get.find()));

//     final suggiest = query.isEmpty ? books : books.where((book){
//               final bookLower = book.title.toLowerCase();
//             final queryLower = query.toLowerCase();
//             return bookLower.startsWith(queryLower);
//       }).toList();

//     final suggiestWithCatiegories = query.isEmpty ? books : books.where((book){
//               final bookLower = book.title.toLowerCase();
//             final queryLower = query.toLowerCase();
//             return bookLower.startsWith(queryLower);
//       }).where((element) {
//               final catigoriesLower = homeController.selectedCatigories[0].toLowerCase();
//             final tagLower = element.tags[0].toString().toLowerCase();
//             return catigoriesLower.contains(tagLower);
//       }).toList();
//        print(suggiestWithCatiegories);
//  return  Obx(
//    ()=> Padding(padding: pagesPadding,
//        child:  ListView.builder(
//                 shrinkWrap: true,
//               itemCount: homeController.selectedCatigories.isEmpty? suggiest.length : suggiestWithCatiegories.length,
//              itemBuilder: (context , index){
//               Book iteam = homeController.selectedCatigories.isEmpty? suggiest[index] : suggiestWithCatiegories[index];
//               return  _searchIteam(iteam);
//              }

//               ),
//           ),
//  );
    return Container();
  }

  @override
  Widget buildSuggestions(BuildContext context) {
    // HomeController homeController =
    //     Get.put(HomeController(allBooksUseCase: Get.find()));
    // final suggiest = query.isEmpty
    //     ? books
    //     : books.where((book) {
    //         final bookLower = book.title.toLowerCase();
    //         final queryLower = query.toLowerCase();
    //         return bookLower.startsWith(queryLower);
    //       }).toList();
    // final suggiestWithCatiegories = query.isEmpty
    //     ? books
    //     : books.where((book) {
    //         final bookLower = book.title.toLowerCase();
    //         final queryLower = query.toLowerCase();
    //         return bookLower.startsWith(queryLower);
    //       }).where((element) {
    //         final catigoriesLower =
    //             homeController.selectedCatigories[0].toLowerCase();
    //         final tagLower = element.tags[0].toString().toLowerCase();
    //         return catigoriesLower.contains(tagLower);
    //       }).toList();
    // print(suggiestWithCatiegories);
    // return Obx(
    //   () => Padding(
    //     padding: pagesPadding,
    //     child: ListView.builder(
    //         shrinkWrap: true,
    //         itemCount: homeController.selectedCatigories.isEmpty
    //             ? suggiest.length
    //             : suggiestWithCatiegories.length,
    //         itemBuilder: (context, index) {
    //           Book iteam = homeController.selectedCatigories.isEmpty
    //               ? suggiest[index]
    //               : suggiestWithCatiegories[index];
    //           return _searchIteam(iteam);
    //         }),
    //   ),
    // );
    return Container();
  }

  _descriptionBody(Book book) => SizedBox(
        width: 240,
        child: GridView.builder(
          shrinkWrap: true,
          itemCount: book.tags.length,
          physics: const NeverScrollableScrollPhysics(),
          itemBuilder: (_, index) =>
              ContainerApp(src: book.tags[index], pressed: () => print("iteam"))
                  .containerBaseStyle(),
          gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 3,
              crossAxisSpacing: 4,
              mainAxisSpacing: 4,
              childAspectRatio: 80 / 25),
        ),
      );
  _searchIteam(Book book) {
    String desc = book.content.length >= 125
        ? "${book.content.substring(0, 125)}..."
        : book.content;
    return InkWell(
      // onTap: () => Get.to(() => ProfileScreen(book)),
      child: Material(
        elevation: 10,
        child: Container(
          padding: iteamsInnerPadding,
          width: Get.width,
          margin: EdgeInsets.only(bottom: 12),
          height: 150,
          decoration: BoxDecoration(
            color: backgroundColor,
            border: Border.all(color: shadowColor),
            borderRadius: BorderRadius.all(Radius.circular(5)),
            boxShadow: [
              BoxShadow(
                color: shadowColor,
                offset: Offset(0, 2),
                blurRadius: 2,
              ),
            ],
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              ClipRRect(
                  borderRadius: BorderRadius.all(Radius.circular(5)),
                  child: Image.network(
                    book.img,
                    fit: BoxFit.fill,
                    width: 90,
                    height: 140,
                  )),
              Container(
                padding: iteamsInnerPadding,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    TextApp(book.title).titleTextStyle2(),
                    SizedBox(height: 4),
                    TextApp(book.author).subTitleTextStyle2(),
                    SizedBox(height: 4),
                    SizedBox(
                        width: 260,
                        child: TextApp(desc).descriptionTextStyle()),
                    SizedBox(height: 4),
                    _descriptionBody(book),
                    SizedBox(height: 4),
                    Row(
                      children: [
                        RatingBar.builder(
                          initialRating: 3,
                          minRating: 1,
                          direction: Axis.horizontal,
                          allowHalfRating: true,
                          unratedColor: Colors.amber.withAlpha(50),
                          itemCount: 5,
                          itemSize: 9.0,
                          itemPadding: EdgeInsets.symmetric(horizontal: 1.0),
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
            ],
          ),
        ),
      ),
    );
  }
}
