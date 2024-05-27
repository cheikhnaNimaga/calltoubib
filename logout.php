<?php

// Démarrer la session
session_start();

session_destroy();

// Optionnel: nettoyer les variables de session
$_SESSION = array();

echo "Session détruite.";
?>
