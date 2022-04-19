import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class ProfileScreen extends GetView<HomeController>{
  final Book book ;
  ProfileScreen({required this.book});
  @override
  Widget build(BuildContext context) {
   return Scaffold(
       body: Stack(
           children: [
                Container(
                    child: Hero(tag: book.name,
                    child: Image.asset(book.image , fit: BoxFit.fitWidth)),
                )

           ],
       ),
   );
  }
}
