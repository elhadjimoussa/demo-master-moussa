<?php

/**
 * Fichier exemple pour forcer le téléchargement d'un fichier.
 * S'attend à ce que vous ayez un fichier '/files/icon.png' sur le serveur
 * Cet article vous donne une bonne idée des types de headers possibles : 
 * https://stackoverflow.com/questions/8485886/force-file-download-with-php-using-header
 * Mais seul le 'Content-disposition' est obligatoire pour forcer le download.
 */
$size = filesize($GLOBALS['filesDirectory'].'icon.png');

header('Content-Disposition: attachment; filename=icon.png');
readfile($GLOBALS['filesDirectory'].'icon.png'); 