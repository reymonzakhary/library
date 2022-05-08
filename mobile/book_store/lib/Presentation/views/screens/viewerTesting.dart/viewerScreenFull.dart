import 'dart:convert';
import 'dart:io';

import 'package:dio/dio.dart';
import 'package:epub_viewer/epub_viewer.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:path_provider/path_provider.dart';
class ViewerScreenFull extends StatefulWidget {
  const ViewerScreenFull({ Key? key }) : super(key: key);

  @override
  _ViewerScreenFullState createState() => _ViewerScreenFullState();
}

class _ViewerScreenFullState extends State<ViewerScreenFull> {
    bool loading = false;
  Dio dio = new Dio();
  String filePath = "";

   @override
  void initState() {
    super.initState();
    download();
  }

  download() async {
    if (Platform.isAndroid || Platform.isIOS) {
      print('download');
      await downloadFile();
    } else {
      loading = false;
    }
  }
    Future downloadFile() async {
    print('download1');

    if (await Permission.storage.isGranted) {
      print("permision storage is granted ${await Permission.storage.status}");
      await startDownload();
    } else {
       await Permission.storage.request().then((value) => print(value.isGranted));
        print("permision storage not granted ${await Permission.storage.status}");
    //   await startDownload();
    }
    print("permision storage ${await Permission.storage.status}");
  }

  startDownload() async {
    Directory? appDocDir = Platform.isAndroid
        ? await getExternalStorageDirectory()
        : await getApplicationDocumentsDirectory();

    String path = appDocDir!.path + '/chair.epub';
    File file = File(path);
    // try{
    //     await file.delete();
    // }catch(e){
    //     print("Error Delete file ${e.toString()}");
    // }


    if (!File(path).existsSync()) {
      // check internet status
      await file.create();
      try {
    await dio.download(
        'https://github.com/FolioReader/FolioReaderKit/raw/master/Example/'
        'Shared/Sample%20eBooks/The%20Silver%20Chair.epub',
        path,
        deleteOnError: true,
        onReceiveProgress: (receivedBytes, totalBytes) {
          var download_rate = (receivedBytes / totalBytes * 100).toStringAsFixed(0);
          print(download_rate);
           //Check if download is complete and close the alert dialog
        //    print("${receivedBytes}");
           if(download_rate.contains("100")){
               print("if 100 is done");
            loading = false;
            setState(() {
              filePath = path;
            });

           }
         else{
             loading = true;
            Get.defaultDialog(title: "Downloading..." , content: CircularProgressIndicator());
          }
        },
      );

      }catch(e){
          print("Khaled Error for Download ${e.toString()}");
      }

    } else {
      loading = false;
      setState(() {
        filePath = path;
      });
    }
  }


  @override
  Widget build(BuildContext context) {
    return  Scaffold(
        appBar: AppBar(
          title: const Text('Plugin example app'),
        ),
        body: Center(
          child: loading
              ? CircularProgressIndicator()
              : FlatButton(
                  onPressed: () async {
                    Directory appDocDir =
                        await getApplicationDocumentsDirectory();
                    print('$appDocDir');

                    String iosBookPath = '${appDocDir.path}/chair.epub';
                    print(iosBookPath);
                    String androidBookPath = 'file:///android_asset/3.epub';
                    EpubViewer.setConfig(
                        themeColor: Theme.of(context).primaryColor,
                        identifier: "iosBook",
                        scrollDirection: EpubScrollDirection.ALLDIRECTIONS,
                        allowSharing: true,
                        enableTts: true,
                        nightMode: true);

                    // get current locator
                    EpubViewer.locatorStream.listen((locator) {
                      print(
                          'LOCATOR: ${EpubLocator.fromJson(jsonDecode(locator))}');
                    });

                    EpubViewer.open(
                      filePath,
                      lastLocation: EpubLocator.fromJson({
                        "bookId": "2239",
                        "href": "/OEBPS/ch07.xhtml",
                        "created": 1539934158390,
                        "locations": {
                          "cfi": "epubcfi(/0!/4/4[simple_book]/2/2/6)"
                        }
                      }),
                    );

                  },
                  child: Container(
                    child: Text('open epub'),
                  ),
                ),
        ),
      );
  }
}
