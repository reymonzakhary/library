import 'package:equatable/equatable.dart';

abstract class Link extends Equatable {
  String? first;
  String? last;
  String? prev;
  String? next;

  Link({this.first, this.last, this.prev, this.next});
  @override
  List<Object?> get props => [first, last, prev, next];
}
