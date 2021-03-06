import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class TextStyleApp {

  static textStyleRoboto(String msg , FontWeight weight , double size , FontStyle style , TextAlign align , Color color , bool? underLine){
    return Text(
      msg,
      style: GoogleFonts.roboto(
        textStyle: TextStyle(
          fontFamily: "Roboto",
           fontSize: size,
           fontStyle: style,
           fontWeight: weight,
           color: color,
           decoration: underLine== true? TextDecoration.underline:null
        ),
      ),
      textAlign: align,
    );
  }

    static textStyleCairo(String msg , FontWeight weight , double size , FontStyle style ,Color colorText ,TextAlign align){
    return Text(
      msg,
      style: GoogleFonts.cairo(
        textStyle: TextStyle(
          fontFamily: "cairo",
           fontSize: size,
           fontStyle: style,
           fontWeight: weight,
           color: colorText,
        ),
      ),
      textAlign: align,
    );
  }
   static textStyleBellota(String msg , FontWeight weight , double size , FontStyle style ,Color colorText ,TextAlign align){
    return Text(
      msg,
      style: GoogleFonts.bellotaText(
        textStyle: TextStyle(
          fontFamily: "bellotaText",
           fontSize: size,
           fontStyle: style,
           fontWeight: weight,
           color: colorText,
        ),
      ),
      textAlign: align,
    );
  }
 static textStyleTitle(String msg ,TextAlign align , bool? underLine){
    return Text(
      msg,
      style: GoogleFonts.abrilFatface(
        textStyle: TextStyle(
          fontFamily: "abrilFatface",
           fontSize: 12,
           fontStyle: FontStyle.normal,
           fontWeight: FontWeight.w600,
           letterSpacing: .5,
           color: Colors.black,
           decoration: underLine== true? TextDecoration.underline:null
        ),
      ),
      textAlign: align,
    );
  }
   static textStyledesc(String msg ,TextAlign align , bool? underLine){
    return Text(
      msg,
      style: GoogleFonts.abhayaLibre(
        textStyle: TextStyle(

           fontSize: 10,
           fontStyle: FontStyle.normal,
           fontWeight: FontWeight.w400,
           letterSpacing: .5,
           color: Colors.black,
           decoration: underLine== true? TextDecoration.underline:null
        ),
      ),
      textAlign: align,
    );
  }


}

