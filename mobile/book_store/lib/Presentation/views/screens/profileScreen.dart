
import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:book_store/Presentation/views/screens/viewerTesting.dart/pdfViewer.dart';
import 'package:book_store/Presentation/views/screens/viewerTesting.dart/sfdViewer.dart';
import 'package:book_store/Presentation/views/screens/viewerTesting.dart/viewerScreenFull.dart';
import 'package:epub_viewer/epub_viewer.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class ProfileScreen extends GetView<HomeController> {
  final Book book;
  ProfileScreen({required this.book});
  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
      init: HomeController(),
      builder: (controller) => LayoutBuilder(
          builder: (BuildContext context, BoxConstraints constraints) {
        final width = constraints.maxWidth;
        final height = constraints.maxHeight;
        return Scaffold(
          body: Stack(
            alignment: Alignment.bottomCenter,
            children: [
              Positioned(
                height: height * 0.6,
                width: width,
                top: height * -0.1,
                child: Container(
                  child: Hero(
                      tag: book.image,
                      child: Image.asset(
                        book.image,
                        fit: BoxFit.fitWidth,
                      )),
                ),
              ),

                   Positioned(
                      left: 0,
                      right: 0,
                      bottom:100,
                      child: RawMaterialButton(
                          fillColor: blueColor,
                          child: Center(
                            child: Text("VIEW"),
                          ),
                          onPressed: ()  =>
                   Get.to(()=>ViewerScreenFull())
                   ))
         , Positioned(
                      left: 0,
                      right: 0,
                      bottom: 50,
                      child: RawMaterialButton(
                          fillColor: blueColor,
                          child: Center(
                            child: Text("VIEW 1"),
                          ),
                          onPressed: () async =>
                    await EpubViewer.openAsset(
                      'assets/cleanCode.epub',
                      lastLocation: EpubLocator.fromJson({
                        "bookId": "2239",
                        "href": "/OEBPS/ch06.xhtml",
                        "created": 1539934158390,
                        "locations": {
                          "cfi": "epubcfi(/0!/4/4[simple_book]/2/2/6)"
                        }
                      }),
                    )
                   ))
                   ,
                   Positioned(
                      left: 0,
                      right: 0,
                      bottom: 0,
                      child: RawMaterialButton(
                          fillColor: blueColor,
                          child: Center(
                            child: Text("VIEW 3"),
                          ),
                          onPressed: ()  => Get.to(()=>sfPDFVIEWER())
                   ))

            ],
          ),
        );
      }),
    );
  }
}
