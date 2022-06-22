
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:get/get.dart';

import '../../../../core/themes/colors.dart';
import '../../../../core/themes/divider_app.dart';
import '../../../../core/themes/text_app.dart';
import '../../domain/entites/book.dart';

class SearchScreen extends GetView {
  final List<Book> books ;

  SearchScreen(this.books);
  @override
  Widget build(BuildContext context) {
   return Scaffold(
      backgroundColor: backgroundColor,
        appBar: AppBar(
          elevation: 0,
          backgroundColor: backgroundColor,
          // title: AppSearchBar(books),
          leadingWidth: 40,
          centerTitle: true,
          leading: Row(
            children: [
              SizedBox(width: 14),
              ContainerApp(pressed: ()=>Get.back()).headerButton(Icons.arrow_back, () => Get.back(), false),
            ],
          ),
          ),
     body: Padding(padding: pagesPadding,
     child: ListView.builder(
              shrinkWrap: true,
            itemCount: books.length,
           itemBuilder: (context , index)=>
            _searchIteam(books[index]),
            ),
        ),
   );
  }
    _descriptionBody(Book book)=>SizedBox(
     width: 240,
    child: GridView.builder(
      shrinkWrap: true,
      itemCount: book.tags.length,
      physics: const NeverScrollableScrollPhysics(),
      itemBuilder: (_, index)=>ContainerApp(src: book.tags[index] , pressed: ()=> print("iteam")).containerBaseStyle(),
      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
      crossAxisCount: 3,
      crossAxisSpacing: 4,
      mainAxisSpacing: 4,
      childAspectRatio: 80/25),
      
        
      ),
  );
_searchIteam(Book book){ 
 String desc = book.content.length >= 125 ? "${book.content.substring(0,125)}...":book.content;
  return InkWell(
    // onTap: ()=> Get.to(()=> ProfileScreen(book)),
    child: Material(
    elevation: 10,
    child:   Container(
                  padding: iteamsInnerPadding,
                   width: Get.width,
                   margin: EdgeInsets.only(bottom: 12),
                   height: 150,
                   decoration: BoxDecoration(
                     color: backgroundColor,
                     border: Border.all(color: shadowColor),
                     borderRadius: BorderRadius.all(Radius.circular(5)),
                     boxShadow: [
                       BoxShadow(
                         color: shadowColor,
                         offset: Offset(0, 2),
                         blurRadius: 2,
                       ),
                     ],
                   ),
                 child: Row(
                   crossAxisAlignment: CrossAxisAlignment.start,
                   children: [
                        ClipRRect(
                           borderRadius: BorderRadius.all(Radius.circular(5)),
                          child: Image.network( book.img, fit: BoxFit.fill, width: 90, height: 140,)),
                  Container(
                    padding: iteamsInnerPadding,
                  
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,              
                      children: [
                        TextApp(book.title).titleTextStyle2(),
                        SizedBox(height: 4),
                        TextApp(book.author).subTitleTextStyle2(),
                       SizedBox(height: 4),
                        SizedBox(width: 260, child: TextApp(desc).descriptionTextStyle()),
                         SizedBox(height: 4),
                         _descriptionBody(book),
                         SizedBox(height: 4),
                         Row(
                         children: [
                           RatingBar.builder(
                          initialRating: 3,
                          minRating: 1,
                           direction: Axis.horizontal,
                            allowHalfRating: true,
                            unratedColor:Colors.amber.withAlpha(50),
                            itemCount: 5,
                            itemSize: 9.0,
                            itemPadding: EdgeInsets.symmetric(
                            horizontal: 1.0),
                            itemBuilder: (context, _) => Icon(
                                          Icons.star,
                                          color: Colors.amber,
                                        ),
                                        onRatingUpdate: (rating) {
                                          print(rating);
                                        },
                                        updateOnDrag: true,
                                      ),
                                  SizedBox(width: 4),
                         TextApp("3.5").generalTextStyle(generalTextColor, 9, FontWeight.normal)
                         ],
                           ),
                        // Container(width: 40, child: TextApp(books[index].content).descriptionTextStyle(),) 
                      ],
                    ),
                  ),
              
                   ],
                 ),
         
               ),
  ),
  );
}       


}