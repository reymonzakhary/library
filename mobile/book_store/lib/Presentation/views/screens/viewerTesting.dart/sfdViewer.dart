import 'package:flutter/material.dart';
import 'package:syncfusion_flutter_core/theme.dart';
import 'package:syncfusion_flutter_pdfviewer/pdfviewer.dart';

class sfPDFVIEWER extends StatefulWidget {
  @override
  _sfPDFVIEWER createState() => _sfPDFVIEWER();
}

class _sfPDFVIEWER extends State<sfPDFVIEWER> {
  final GlobalKey<SfPdfViewerState> _pdfViewerKey = GlobalKey();
final PdfViewerController pdfViewerController = PdfViewerController();
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Semantics(
        child: SfTheme(
          data: SfThemeData(
          pdfViewerThemeData: SfPdfViewerThemeData(
              backgroundColor: Colors.black,
              progressBarColor: Colors.grey.shade400,
              brightness: Brightness.dark,
            scrollStatusStyle: PdfScrollStatusStyle(
                pageInfoTextStyle: TextStyle(fontSize: 100) ),
            paginationDialogStyle: PdfPaginationDialogStyle(
              backgroundColor: Colors.black,
              headerTextStyle: TextStyle(color: Colors.white),
              inputFieldTextStyle: TextStyle(color: Colors.white),
              hintTextStyle: TextStyle(color: Colors.grey),
              pageInfoTextStyle: TextStyle(color: Colors.grey),
              validationTextStyle: TextStyle(color: Colors.red),
              okTextStyle: TextStyle(color: Colors.white),
              cancelTextStyle: TextStyle(color: Colors.white)
            ))),
            child: SfPdfViewer.network(
              'https://cdn.syncfusion.com/content/PDFViewer/flutter-succinctly.pdf',
              key: _pdfViewerKey,
              interactionMode: PdfInteractionMode.selection,
               controller: pdfViewerController,
              currentSearchTextHighlightColor: Colors.red,
              enableTextSelection: true,
              onTextSelectionChanged: (detalis)=>print(detalis.selectedText),
              onDocumentLoaded: (details) => print(details.document.bookmarks.count),
              otherSearchTextHighlightColor: Colors.red,
            ),
          ),
        ),
    );
  }
}
