
import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:book_store/Presentation/views/screens/viewerScreenFull.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class ProfileScreen extends GetView<HomeController> {
  final Book book;
  ProfileScreen({required this.book});
  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
      init: HomeController()..download(),
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
              controller.loading.value
                  ? CircularProgressIndicator()
                  : Positioned(
                      left: 0,
                      right: 0,
                      bottom: 40,
                      child: RawMaterialButton(
                          fillColor: blueColor,
                          child: Center(
                            child: Text("VIEW"),
                          ),
                          onPressed: ()  =>
                   Get.to(()=>ViewerScreenFull())
                   ))
            ],
          ),
        );
      }),
    );
  }
}
