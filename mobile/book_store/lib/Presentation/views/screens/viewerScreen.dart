import 'package:book_store/Presentation/controller/viewerController.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:get/get.dart';

class ViewerScreen extends GetView<ViewerController> {
  @override
  Widget build(BuildContext context) {
    return GetBuilder<ViewerController>(
        init: ViewerController()..handelDownloadDevicePlatform(),
        builder: (controller)=>
        Scaffold(

        ));
  }
}
