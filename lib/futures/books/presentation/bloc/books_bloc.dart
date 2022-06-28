import 'package:bloc/bloc.dart';
import 'package:book_store/futures/books/data/model/book_response_model.dart';
import 'package:book_store/futures/books/domain/usecases/get_books_usecases.dart';
import 'package:dartz/dartz.dart';
import 'package:equatable/equatable.dart';
import 'package:meta/meta.dart';

import '../../../../core/constants/strings.dart';
import '../../../../core/errors/failure/failure.dart';
import '../../domain/entites/book.dart';


part 'books_event.dart';
part 'books_state.dart';

class BooksBloc extends Bloc<BooksEvent, BooksState> {
  GetBooksUseCases getBooksUseCases;
  BooksBloc({required this.getBooksUseCases}) : super(BooksInitial()) {
    on<BooksEvent>((event, emit) async {
      if (event is GetBooks) {
        emit(BooksLoading());
        final booksCases = await getBooksUseCases.call();
        emit(_handelCallBackOfState(booksCases));
      } else if (event is RefreshBooks) {
        final booksCases = await getBooksUseCases.call();
        emit(_handelCallBackOfState(booksCases));
      }
    });
  }

  BooksState _handelCallBackOfState(Either<Failure, BookResponseModel> either) {
    return either.fold(
        (faliure) => BooksFailed(msg: _handelingFiledMassegeCase(faliure)),
        (books) => BooksSuccess(books: books.books));
  }

  String _handelingFiledMassegeCase(Failure failure) {
    switch (failure.runtimeType) {
      case FaluireService:
        return SERVER_ERORR;
      case FaluireOffline:
        return OFFLINE_ERROR;
      case FaluireEmptyCache:
        return EMPTY_CACHED_ERORR;
      default:
        return DEFAULT_ERROR;
    }
  }
}
