import 'package:book_store/core/routes/delivery.dart';
import 'package:book_store/core/routes/delivery_pages.dart';
import 'package:book_store/core/themes/app_theme.dart';
import 'package:book_store/futures/books/pressntation/bindings/main_binding.dart';
import 'package:book_store/futures/books/pressntation/screens/home_screen.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      theme: themeApp,
      initialBinding: MainBinding(),
      getPages: DeliveryPage.pages,
      initialRoute: Delivery.home,
    );
  }
}
