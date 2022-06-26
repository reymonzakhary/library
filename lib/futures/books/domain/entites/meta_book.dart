import 'package:equatable/equatable.dart';

import 'link_book.dart';

abstract class Meta extends Equatable {
  int? currentPage;
  int? from;
  int? lastPage;
  List<Link>? links;
  String? path;
  int? perPage;
  int? to;
  int? total;

  Meta(
      {this.currentPage,
      this.from,
      this.lastPage,
      this.links,
      this.path,
      this.perPage,
      this.to,
      this.total});

  @override
  List<Object?> get props =>
      [currentPage, from, lastPage, links, path, perPage, to, total];
}
