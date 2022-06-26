import 'package:equatable/equatable.dart';

import 'book.dart';
import 'link_book.dart';
import 'meta_book.dart';

abstract class BookResponse extends Equatable {
  final List<Book> books;
  final Meta meta;
  final Link link;

  const BookResponse(
      {required this.link, required this.books, required this.meta});
  @override
  List<Object?> get props => [books, meta, link];
}
