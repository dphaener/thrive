<?php

/**
 *
 **/
function openfit_api_import_file_fit($filename) {
  $importer = new FitFileImporter();
  return $importer->importFile($filename);
}