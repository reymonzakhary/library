import 'dart:math';

import 'package:book_store/Data/utilities/constant.dart';
import 'package:book_store/Data/utilities/textStyle.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class HomeScreen extends GetView<HomeController> {
  final bookImageHeight = 240.0;
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
    toolbarHeight: 270,
  );
  _bodySliver()=> SliverToBoxAdapter(
   child: Column(
       children: [
            _topSeller(),
            _Recent(),
            _topSeller(),
            _Recent(),
            _topSeller(),
            _Recent(),
       ],
   ),
  );

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
              return Container(
                width: Get.width,
                 padding: EdgeInsets.only(top: 10 , left: 10),
                 child: Row(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                      Column(
                          children: [
                           Opacity(
                      opacity: 1 - rotate,
                      child:Text("${controller.books[index].name}",
                       style: TextStyle(color: brownColor ,
                       fontSize: 20 , fontWeight: FontWeight.w800),
                        textAlign: TextAlign.start),


                    ),
                          Container(width: 140, child: Text("Description of catigories of to expaln how can you get here \n to make idea we m4 store book m4 hat2dr te8amed 3enek \n afred masln masln any 5asmetk yom.",
                       style: TextStyle(color: brownColor400 ,
                       fontSize: 12 , fontWeight: FontWeight.w300),
                        textAlign: TextAlign.start),)

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
  _topSeller() => Column(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Container(
        padding: const EdgeInsets.all(8),

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
    height:180,
    child: ListView.builder(
    scrollDirection: Axis.horizontal,
    itemBuilder: (context , index){
      return Container(padding: EdgeInsets.all(8), child: _bookBody(index));
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
          width: Get.width,
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
    child: CarouselSlider.builder(
        itemCount: controller.books.length,
        itemBuilder: (context , index , x){
            return Container(padding: EdgeInsets.all(8), child: Image.asset(controller.books[index].image , width: 100, height: 120,),);
        }, options: CarouselOptions(
            viewportFraction: .5,
            enlargeCenterPage: true,
            autoPlay: true,
            pauseAutoPlayInFiniteScroll: true,
            )) )
    ],
  );
  _bookBody(index)=>Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
       Image.asset(controller.books[index].image , width: 100, height: 120,),
       SizedBox(height: 10),
       Text("${controller.books[index].name}", style: TextStyle(color: brownColor400 , fontSize: 14 , fontWeight: FontWeight.w600), textAlign: TextAlign.center),
              Text("by: ${controller.books[index].author}", style: TextStyle(color: brownColor100 , fontSize: 14 , fontWeight: FontWeight.w600), textAlign: TextAlign.center)
      ],
  );

}
