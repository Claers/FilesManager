<?php
  require_once '../inc/database.php';
  require_once '../inc/function.php';
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Files Lister application">
    <meta name="author" content="Fukotaku">
    <link rel="shortcut icon" href="../favicon.png" />

    <title>Admin Files Lister</title>

    <!-- Bootstrap core CSS -->
    <link href="../asset/css/bootstrap.css" rel="stylesheet">

  </head>
  <body>

    <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        </button>
        <a class="navbar-brand"><span class="glyphicon glyphicon-blackboard"></span> &nbsp;Files Lister : Panel administrateur</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php"><span class="glyphicon glyphicon-info-sign"></span> &nbsp;Liste des utilisateurs</a></li>
          <li><a href="create.php"><span class="glyphicon glyphicon-plus-sign"></span> &nbsp;Créer un utilisateur</a></li>
          <li><a href="delete.php"><span class="glyphicon glyphicon-minus-sign"></span> &nbsp;Supprimer des utilisateurs</a></li>
        </ul>
      </div>

    </div>
  </nav>
