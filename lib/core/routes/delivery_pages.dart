import 'package:book_store/core/routes/delivery.dart';
import 'package:book_store/futures/books/pressntation/bindings/books_binding.dart';
import 'package:book_store/futures/books/pressntation/screens/home_screen.dart';
import 'package:get/route_manager.dart';

class DeliveryPage {
  static final pages = [
    GetPage(name: Delivery.home, page: ()=> HomeScreen() , binding: BooksBinding()),
  ];
}
