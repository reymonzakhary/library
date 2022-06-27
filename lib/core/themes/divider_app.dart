// padding and space
import 'package:book_store/core/themes/colors.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

const pagesPadding = EdgeInsets.all(14);
const iteamsOuterPadding = EdgeInsets.all(4);
const iteamsInnerPadding = EdgeInsets.all(6);
const verticalIteamPadding = EdgeInsets.symmetric(vertical: 8, horizontal: 0);
const horzantialIteamPadding = EdgeInsets.symmetric(vertical: 0, horizontal: 4);

//raduis
const raduisIteam = 5.0;
const raduisCircleIteam = 25.0;
const raduisSecoundrayIteam = 12.0;

//defaut space vertical
const defaultVerticalSpace = SizedBox(height: 8);

//defaut divider
class Divders {
  Widget get defaultDivder => Container(
        margin: EdgeInsets.only(top: 6, bottom: 6),
        height: 1,
        width: Get.width,
        decoration: BoxDecoration(
          gradient: LinearGradient(colors: [
            primaryColor,
            selectorColor,
          ], begin: Alignment.centerLeft, end: Alignment.centerRight),
        ),
      );
}
