<?php

include 'functions/logout_user.php';

logout_user();

header('Location: connexion.php');
