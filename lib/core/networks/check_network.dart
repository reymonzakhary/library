import 'package:internet_connection_checker/internet_connection_checker.dart';

abstract class BaseCheckNetwork {
  Future<bool> get isDeviceConnection;
}

class CheckNetwork extends BaseCheckNetwork {
  final InternetConnectionChecker internetConnectionChecker;

  CheckNetwork({required this.internetConnectionChecker});
  @override
  Future<bool> get isDeviceConnection =>
      internetConnectionChecker.hasConnection;
}
