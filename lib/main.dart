import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:book_store/injection/injection_books.dart' as di;

import 'futures/books/presentation/bloc/books_bloc.dart';
import 'futures/books/presentation/screen/master_screen.dart';

void main() async {
  WidgetsFlutterBinding();
  // dependince injection of app
  await di.init();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MultiBlocProvider(
        providers: [
          BlocProvider(create: (_) => di.getIt<BooksBloc>()..add(GetBooks())),
        ],
        child: MaterialApp(
          title: 'Flutter Demo',
          theme: ThemeData(
            primarySwatch: Colors.blue,
          ),
          home: MasterScreen(),
        ));
  }
}
