part of 'books_bloc.dart';

@immutable
abstract class BooksEvent extends Equatable {
  const BooksEvent();
  @override
  List<Object?> get props => [];
}

class GetBooks extends BooksEvent {}
class RefreshBooks extends BooksEvent{}
