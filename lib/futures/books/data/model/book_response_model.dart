import 'package:book_store/futures/books/data/model/book_model.dart';
import 'package:book_store/futures/books/data/model/link_model.dart';
import 'package:book_store/futures/books/data/model/meta_model.dart';
import '../../domain/entites/book_response.dart';

class BookResponseModel extends BookResponse {
  List<BookModel> books;

  BookResponseModel({required this.books, required meta, required link})
      : super(books: books, meta: meta, link: link);

  factory BookResponseModel.fromJson(Map<String, dynamic> json) =>
      BookResponseModel(
          books: List<BookModel>.from(
              json["data"]?.map((book) => BookModel.fromJson(book))).toList(),
          meta: MetaModel.fromJson(json["meta"]),
          link: LinkModel.fromJson(json["links"]));
}
