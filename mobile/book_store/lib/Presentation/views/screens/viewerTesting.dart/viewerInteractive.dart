import 'package:flutter/material.dart';
import 'package:get/get.dart';

class VewerInteractive extends GetView {
  @override
  Widget build(BuildContext context) {
  return Scaffold(
      body: InteractiveViewer.builder(
          scaleEnabled: true,
           panEnabled: true,
           minScale: 0.5,

           maxScale: 5.5,
          builder:(context , quad)=> Container(child: Center(child: Text("data viewer jasdjsad \n sdsadsadaadsadadsa \n asddddddddddddddddddddddddddddd\n sdaddddddddddddddddddddddddd \n saaaaaaaaaaaaaaaaaaaaaaaaa \n Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaewf \n assssssssssssaqwwaaqqf")),)),
  );
  }
}
