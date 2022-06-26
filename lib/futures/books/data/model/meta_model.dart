import 'package:book_store/futures/books/domain/entites/meta_book.dart';

import 'link_model.dart';

class MetaModel extends Meta {
  MetaModel(
      {required currentPage,
      required from,
      required lastPage,
      // required links,
      required path,
      required perPage,
      required to,
      required total})
      : super(
            currentPage: currentPage,
            from: from,
            lastPage: lastPage,
            // links: links,
            path: path,
            perPage: perPage,
            to: to,
            total: total);

  factory MetaModel.fromJson(Map<String, dynamic> json) => MetaModel(
        currentPage: json['current_page'],
        from: json['from'],
        lastPage: json['last_page'],
        // links: LinkModel.fromJson(json['links']),
        path: json['path'],
        perPage: json['per_page'],
        to: json['to'],
        total: json['total'],
      );
}
