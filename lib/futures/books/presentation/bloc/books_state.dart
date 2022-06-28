part of 'books_bloc.dart';

@immutable
abstract class BooksState extends Equatable {}

class BooksInitial extends BooksState {
  @override
  List<Object?> get props => [];
}

class BooksLoading extends BooksState {
  @override
  List<Object?> get props => [];
}

class BooksSuccess extends BooksState {
  final List<Book> books;

  BooksSuccess({required this.books});

  @override
  List<Object?> get props => [books];
}

class BooksFailed extends BooksState {
  final String msg;

  BooksFailed({required this.msg});

  @override
  List<Object?> get props => [msg];
}
