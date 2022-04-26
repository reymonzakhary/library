import 'dart:async';
import 'dart:io';

import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/Repositries/ExampleData.dart';

import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:path_provider/path_provider.dart';

class HomeController extends GetxController {
  List<Book> books = [];
  List<Book> categories = [];
  final pageController = PageController();
  final notiferPAgeController = ValueNotifier(0.0);
  RxString pathFile = "".obs;

  _lisenerPageController() {
    notiferPAgeController.value = pageController.page!;
    update();
  }

  Future<File> createFileOfPdfUrl ()async {
    Completer<File> completer = Completer();
    print("Start download file from internet!");
    try{
        final url = "http://www.pdf995.com/samples/pdf.pdf";
        final fileName = url.substring(url.lastIndexOf("/")+1);
        print(fileName);
        var request = await HttpClient().getUrl(Uri.parse(url));
        var response = await request.close();
        var bytes = await consolidateHttpClientResponseBytes(response);
      var dir = await getApplicationDocumentsDirectory();
      print("Download files");
      print("${dir.path}/$fileName");
      File file = File("${dir.path}/$fileName");
     await file.writeAsBytes(bytes, flush: true);
      completer.complete(file);
    }catch(e){
        throw Exception('Error parsing asset file! ${e.toString()}');
    }
    return completer.future;
   }

  @override
  void onInit() {

    books = ExampleData.books;
    categories = ExampleData.categories;

    pageController.addListener(_lisenerPageController);
    super.onInit();
  }

  @override
  void onClose() {
    pageController.removeListener(_lisenerPageController);
    pageController.dispose();
    super.onClose();
  }
}
