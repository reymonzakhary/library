import 'package:equatable/equatable.dart';

abstract class Book extends Equatable {
  final int id;
  final String title;
  final String content;
  final String author;
  final dynamic rate;
  final int totalpages;
  final String img;
  final String audio;
  final List<dynamic> tags;
  final List<dynamic> catigories;
  final String file;

  const Book(
      {required this.id,
      required this.title,
      required this.author,
      required this.content,
      required this.rate,
      required this.totalpages,
      required this.img,
      required this.audio,
      required this.tags,
      required this.catigories,
      required this.file});

  @override
  List<Object?> get props =>
      [title, content, author, rate, img, audio, file, totalpages];
}
