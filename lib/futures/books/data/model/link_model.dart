import 'package:book_store/futures/books/domain/entites/link_book.dart';

class LinkModel extends Link {
  LinkModel({required first, required last, required prev, required next})
      : super(first: first, last: last, prev: prev, next: next);

  factory LinkModel.fromJson(Map<String, dynamic> json) => LinkModel(
        first: json['first'],
        last: json['last'],
        prev: json['prev'],
        next: json['next'],
      );

  Map<String, dynamic> toJson(LinkModel linkModel) => {
        'first': linkModel.first,
        'last': linkModel.last,
        'prev': linkModel.prev,
        'next': linkModel.next,
      };
}
