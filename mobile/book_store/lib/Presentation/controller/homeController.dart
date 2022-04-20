import 'dart:convert';
import 'dart:io';

import 'package:book_store/Data/Model/book.dart';
import 'package:book_store/Data/Repositries/ExampleData.dart';
import 'package:dio/dio.dart';
import 'package:epub_viewer/epub_viewer.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:path_provider/path_provider.dart';
import 'package:permission_handler/permission_handler.dart';

class HomeController extends GetxController {
  List<Book> books = [];
  List<Book> categories = [];
  final pageController = PageController();
  final notiferPAgeController = ValueNotifier(0.0);

  RxBool loading = false.obs;
  Dio dio = new Dio();
  RxString filePath = "".obs;

  _lisenerPageController() {
    notiferPAgeController.value = pageController.page!;
    update();
  }

  download() async {
    if (Platform.isAndroid || Platform.isIOS) {
      print('is Android OR IOS');
      await downloadFile();
    } else {
      loading.value = false;
    }
  }

  Future downloadFile() async {
    print('download file');

    if (await Permission.storage.isGranted) {
      await Permission.storage.request();
      await startDownload();
    } else {
      print("${Permission.storage.toString()}");
      await startDownload();
    }
  }

  startDownload() async {
    Directory? appDocDir = Platform.isAndroid
        ? await getExternalStorageDirectory()
        : await getApplicationDocumentsDirectory();

    String path = appDocDir!.path + '/chair.epub';
    print("app doc dir path ${appDocDir.path}");
    File file = File(path);
//    await file.delete();

    if (!File(path).existsSync()) {
      await file.create();
      await dio.download(
        'https://github.com/FolioReader/FolioReaderKit/raw/master/Example/'
        'Shared/Sample%20eBooks/The%20Silver%20Chair.epub',
        path,
        deleteOnError: true,
        onReceiveProgress: (receivedBytes, totalBytes) {
          print((receivedBytes / totalBytes * 100).toStringAsFixed(0));
          //Check if download is complete and close the alert dialog
          if (receivedBytes == totalBytes) {
            loading.value = false;
            filePath.value = path;
          }
        },
      );
    } else {
      loading.value = false;
      filePath.value = path;
    }
  }

  perviweBook() async {
    Directory appDocDir = await getApplicationDocumentsDirectory();
    print('$appDocDir');

    String iosBookPath = '${appDocDir.path}/chair.epub';
    print(iosBookPath);
    String androidBookPath = 'file:///android_asset/3.epub';
    EpubViewer.setConfig(
        themeColor: Theme.of(Get.overlayContext!).primaryColor,
        identifier: "iosBook",
        scrollDirection: EpubScrollDirection.ALLDIRECTIONS,
        allowSharing: true,
        enableTts: true,
        nightMode: true);

    EpubViewer.locatorStream.listen((locator) {
      print('LOCATOR: ${EpubLocator.fromJson(jsonDecode(locator))}');
    });

    EpubViewer.open(
      filePath.value,
      lastLocation: EpubLocator.fromJson({
        "bookId": "2239",
        "href": "/OEBPS/ch06.xhtml",
        "created": 1539934158390,
        "locations": {"cfi": "epubcfi(/0!/4/4[simple_book]/2/2/6)"}
      }),
    );
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
