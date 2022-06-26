import 'dart:convert';

import 'package:book_store/futures/books/domain/entites/book.dart';

class BookModel extends Book {
  const BookModel(
      {required super.id,
      required super.title,
      required super.author,
      required super.content,
      required super.totalpages,
      required super.rate,
      required super.img,
      required super.audio,
      required super.tags,
      required super.catigories,
      required super.file});

  factory BookModel.fromJson(Map<String, dynamic> jsonIteam) => BookModel(
        id: jsonIteam["id"] ?? 0,
        title: jsonIteam["title"] ?? "",
        author: jsonIteam["author"] ?? "",
        content: jsonIteam["content"] ?? "",
        rate: jsonIteam["rate"],
        img: jsonIteam["img"] ?? "",
        audio: jsonIteam["audio"] ?? "",
        tags: json.decode(jsonIteam["tags"]) ?? [],
        catigories: json.decode(jsonIteam["categories"]) ?? [],
        file: jsonIteam["file"] ?? "",
        totalpages: jsonIteam["totalpages"] ?? 0,
      );

  Map<String, dynamic> toJson(BookModel book) => {
        "id": book.id,
        "title": book.title,
        "content": book.content,
        "author": book.author,
        "rate": book.rate,
        "totalpages": book.totalpages,
        "img": book.img,
        "audio": book.audio,
        "tags": json.encode(book.tags),
        "file": book.file
      };

  @override
  List<Object?> get props =>
      [title, content, author, rate, img, audio, file, totalpages];
}
