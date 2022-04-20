import 'package:flutter/material.dart';
import 'package:get/get.dart';

class  AppSearchBar extends GetView{
  @override
  Widget build(BuildContext context) {
   return Container(
        height: 50,
        padding: EdgeInsets.all(8),
        child: TextField(
            // controller: controller.searchPlacesTextController,
            // onTap: () => controller.openSearchPage(),
            onChanged: (s) => print(s),
            // onSubmitted: (value)=> controller.openSearchPage(),
            decoration: InputDecoration(
                fillColor: Colors.grey.shade200,
                filled: true,
                prefixIcon: Icon(Icons.search,
                    color: Colors.grey.shade500, size: 15),
                    suffixIcon: Icon(Icons.menu , color: Colors.grey.shade500),
                hintStyle: TextStyle(
                    color:  Colors.grey.shade500,
                    fontSize: 13,
                    fontWeight: FontWeight.w300),
                hintText: 'Search....',
                border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(30),
                    borderSide: BorderSide.none),
                contentPadding: EdgeInsets.zero)));
  }
}
