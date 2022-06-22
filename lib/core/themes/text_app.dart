import 'package:book_store/core/themes/colors.dart';
import 'package:book_store/core/themes/divider_app.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class TextApp {
  final String src;

  TextApp(this.src);

  titleTextStyle() => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.abrilFatface(
        textStyle: const TextStyle(
          color: titleTextColor,
          fontSize: 16,
          fontStyle: FontStyle.normal,
          fontWeight: FontWeight.w500,
          letterSpacing: 0.6,
          shadows: [
            Shadow(color: shadowColor, blurRadius: 1),
          ],
          decorationThickness: 0.8,
        ),
      ));
  titleTextStyle2() => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.roboto(
        textStyle: const TextStyle(
          color: titleTextColor,
          fontSize: 12,
          fontWeight: FontWeight.bold,
          letterSpacing: 0.6,
          shadows: [
            Shadow(color: shadowColor, blurRadius: 1),
          ],
          decorationThickness: 0.8,
        ),
      ));
  subTitleTextStyle() => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.abrilFatface(
        textStyle: const TextStyle(
          color: Colors.white,
          fontSize: 14,
          fontStyle: FontStyle.normal,
          fontWeight: FontWeight.w500,
          letterSpacing: 0.4,
        ),
      ));
  subTitleTextStyle2() => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.roboto(
        textStyle: const TextStyle(
          color: subtitleTextColor,
          fontSize: 11,
          fontStyle: FontStyle.normal,
          fontWeight: FontWeight.w400,
          letterSpacing: 0.4,
        ),
      ));

  descriptionTextStyle() => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.roboto(
        textStyle: const TextStyle(
          color: descriptonTextColor,
          fontSize: 10,
          fontStyle: FontStyle.normal,
          fontWeight: FontWeight.w400,
          letterSpacing: 0.2,
          wordSpacing: 1.2,
        ),
      ));

  generalTextStyle(Color color, double size, FontWeight weight) => Text(src,
      textAlign: TextAlign.start,
      style: GoogleFonts.roboto(
        textStyle: TextStyle(
          color: color,
          fontSize: size,
          fontStyle: FontStyle.normal,
          fontWeight: weight,
          letterSpacing: 1,
        ),
      ));
}

class ContainerApp {
  final Function() pressed;
  final String? src;

  ContainerApp({this.src, required this.pressed});

  buttonBaseStyle() => InkWell(
        onTap: () {
          pressed();
        },
        child: Container(
          width: 140,
          height: 28,
          decoration: const BoxDecoration(
            borderRadius: BorderRadius.all(Radius.circular(raduisIteam)),
            color: primaryColor,
          ),
          child: Center(
              child: Padding(
            padding: iteamsInnerPadding,
            child: TextApp(src!)
                .generalTextStyle(backgroundColor, 10, FontWeight.w500),
          )),
        ),
      );
  containerBaseStyle() => InkWell(
        onTap: () {
          pressed();
        },
        child: Container(
          width: 60,
          height: 25,
          decoration: BoxDecoration(
            borderRadius: const BorderRadius.all(Radius.circular(raduisIteam)),
            color: Colors.white.withOpacity(0.6),
            border: Border.all(color: secoundryBackgroundColor),
          ),
          child: Center(
              child: Padding(
            padding: iteamsInnerPadding,
            child: TextApp(src!)
                .generalTextStyle(titleTextColor, 9, FontWeight.w500),
          )),
        ),
      );
  headerButton(IconData icon, Function() onPressed, bool isSelected) => InkWell(
        onTap: () {
          onPressed();
        },
        child: Material(
          elevation: isSelected == false ? 3 : 0,
          type: MaterialType.circle,
          color: backgroundColor,
          child: Container(
            width: 26,
            height: 26,
            decoration: BoxDecoration(
                shape: BoxShape.circle,
                border: const Border.fromBorderSide(
                  BorderSide(color: Colors.black12),
                ),
                boxShadow: isSelected == true
                    ? [
                        BoxShadow(
                            color: shadowColor.withOpacity(0.4),
                            blurRadius: 1,
                            spreadRadius: 0),
                        const BoxShadow(
                            color: Colors.white,
                            blurRadius: 10,
                            spreadRadius: 5),
                        //   BoxShadow(
                        //    color: shadowColor.withOpacity(0.8),
                        //    blurRadius:12,
                        //    spreadRadius: -12,

                        //  ),
                      ]
                    : null),
            child: Center(
              child: isSelected == false
                  ? Icon(icon, color: iconColor, size: 12)
                  : Icon(icon, color: primaryColor, size: 10),
            ),
          ),
        ),
      );
}
