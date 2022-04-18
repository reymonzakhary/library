import 'dart:math';

import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Data/utilities/textStyle.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class HomeScreen extends GetView<HomeController> {
  final bookImageHeight = 200.0;
  final bookImageWidth = 180.0;
  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
        init: HomeController(),
        builder: (controller) => Scaffold(
              body: CustomScrollView(
                slivers: [
                    _appBarSliver(),
                    _bodySliver()
                ],
              
              ),
            ));
  }
  _appBarSliver()=> SliverAppBar(
    flexibleSpace: _pageView(),
    automaticallyImplyLeading: false,
    toolbarHeight: Get.height*0.4,
  );
  _bodySliver()=> SliverList(delegate: SliverChildBuilderDelegate((context , index){
    if(index ==0 ){
      return _topSeller();
    }
    if(index ==1 ){
      return _Recent();
    }
        if(index ==2 ){
      return _Recent();
    }
        if(index ==3 ){
      return _Recent();
    }
   if(index ==4 ){
      return _Recent();
    }
  },
  childCount: 5
  ));

  _pageView() => Container(
        width: Get.width,

        color: Colors.grey.shade200,
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
              return SizedBox(
                width: Get.width,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
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
                    Opacity(
                      opacity: 1 - rotate,
                      child: Text(book.name),
                    ),
                    Text(book.author),
                  ],
                ),
              );
            })),
      );
  _topSeller() => Column(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Container(
        padding:EdgeInsets.all(8),
      
        child:
         Text("TOP SELLER", style: TextStyle(color: blueColor400 , fontSize: 18 , fontWeight: FontWeight.w800),)),
     
      Container(
    decoration: BoxDecoration(
                              color: Colors.grey.shade200,
                              boxShadow: [
                                 BoxShadow(
                                    color: Colors.black26,
                                    blurRadius: 20,
                                    offset: Offset(5.0, 5.0),
                                    spreadRadius: 10)
                              ]),
    height:140, 
    child: ListView.builder(
    scrollDirection: Axis.horizontal,
    itemBuilder: (context , index){
      return Container(padding: EdgeInsets.all(8), child: Image.asset(controller.books[index].image , width: 100, height: 120,),);
    },
    itemCount: controller.books.length,),)
    ],
  );
  
  _Recent() => Column(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Container(
        padding:EdgeInsets.all(8),
      
        child:
         Text("RECENT", style: TextStyle(color: blueColor400 , fontSize: 18 , fontWeight: FontWeight.w800),)),
     
      Container(
    decoration: BoxDecoration(
                              color: Colors.grey.shade200,
                              boxShadow: [
                                 BoxShadow(
                                    color: Colors.black26,
                                    blurRadius: 20,
                                    offset: Offset(5.0, 5.0),
                                    spreadRadius: 10)
                              ]),
    height:140, 
    child: ListView.builder(
    scrollDirection: Axis.horizontal,
    itemBuilder: (context , index){
      return Container(padding: EdgeInsets.all(8), child: Image.asset(controller.books[index].image , width: 100, height: 120,),);
    },
    itemCount: controller.books.length,),)
    ],
  );
}
