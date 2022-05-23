<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&family=Inter&family=Raleway&display=swap" rel="stylesheet">
        <title>StudySloth</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
    .bg-dark .table{    
    color: white;
    }
    .bg-dark .bg-body , .bg-dark thead tr th{
    background-color: #333 !important;     
    color: white;
    } 
    .bg-dark .bg-body a{
    color: cyan !important;
    }
  

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
  </head>
  <body class="bg-light">
  @include('layout.menu') 
  <main class="container">

  <!-- Oldal címe -->

  <div class="d-flex align-items-center p-3 my-3 text-white bg-turquoise rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h5 mb-0 text-white lh-1">{{$page_title ?? ''}}</h1>
      <small>{{$page_subtitle ?? ''}}</small>
    </div>
  </div>

  <!-- Oldal tartalma -->
  <div class="my-3 p-3 bg-body rounded shadow-sm">