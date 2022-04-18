class Book {
  final int id;
  final String name;
  final String image;
  final String author;
  final double rate;
  final int seller;
  final int download; //reder
  final int recent;

  Book(
      {required this.id,
      required this.name,
      required this.image,
      required this.author,
      required this.rate,
      required this.download,
      required this.recent,
      required this.seller
      });
}
