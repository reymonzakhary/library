// cache local data

const String CACHE_BOOK = "DATA_BOOKS";

// URL

const BASE_URL = "http://10.0.2.2:8000/api";
const ALL_BOOKS = "/books";

class Strings {
  static String sub_src = "";

  static String splitString20(String src) {
    if (src.length > 20) {
      return "${src.substring(0, 20)}..";
    } else {
      return src;
    }
  }

  static String splitString50(String src) {
    if (src.length > 50) {
      // sub_src = src.substring(0, 50);
      return "${src.substring(0, 50)}..";
    } else {
      return src;
    }
  }

  static String splitString100(String src) {
    if (src.length > 100) {
      sub_src = src.substring(0, 100);
      return sub_src;
    } else {
      return src;
    }
  }

  static String splitString200(String src) {
    if (src.length > 200) {
      sub_src = src.substring(0, 200);
      return sub_src;
    } else {
      return src;
    }
  }
}
