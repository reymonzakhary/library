import 'dart:io';

import 'package:dio/dio.dart';
import 'package:get/get.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:path_provider/path_provider.dart';


class ViewerController extends GetxController {
  bool loading = false;
  Dio dio = new Dio();
  String filePath = "";
  @override
  void onInit() {
    super.onInit();
  }
  handelDownloadDevicePlatform(){
      if(Platform.isAndroid || Platform.isIOS){
          print("divce platform is ${Platform.operatingSystem}");
      }else {
          print("use this future in mobile platform onyl");
      }
  }
  handelPermissionStorage() async{
      var permissionStatus = await Permission.storage.status;
       if(permissionStatus.isGranted){
           print("permision storage is granted ${await Permission.storage.status}");
       }else {
           await Permission.storage.request().then((value) => print(value.isGranted));
       }

  }
  createFile() async{
       Directory? appDocDir = Platform.isAndroid
        ? await getExternalStorageDirectory()
        : await getApplicationDocumentsDirectory();
       String path = appDocDir!.path + '/chair.epub';
       File file = File(path);
       
  }
  startDownloadFile(){}
}
