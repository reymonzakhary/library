import 'package:book_store/Presentation/controller/homeController.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class ViewerScreen extends GetView<HomeController> {
  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
        init: HomeController()..download(),
        builder: ((controller) => Scaffold(
              body: controller.loading.value
                  ? Center(child: CircularProgressIndicator())
                  : Container(),
            )));
  }
}
