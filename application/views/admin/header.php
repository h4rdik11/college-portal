<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Material Design Lite</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">

    <!-- JavaScript Files -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/material.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/schedules.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/teacher.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/student.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/course.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/timeTable.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/controllers/admin_notice.js"></script>

      <script>
        $(document).ready(function(){
          $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
          });

        });  
      </script> 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
  <!-- The drawer is always open in large screens. The header is always shown,
  even in small screens. -->
  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Admin Dashboard</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>          
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <div class="user-name">
            <span><?php 
                if($this->session->has_userdata('user')){
                  echo $this->session->user;
                }
            ?></span>
            </div>
        </header>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>ManageSubjects">Manage Subjects</a>
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>ManageTeachers">Manage Teachers</a>
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>ManageStudents">Manage Students</a>
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>ManageCourses">Manage Courses</a>
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>AdminNotice">Post Notices</a>
          <a class="mdl-navigation__link" href="<?php echo base_url(); ?>PostTT">Time Table</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=<?php echo base_url(); ?>Welcome/logout >Logout</a>
        </nav>
      </div>
  <main class="mdl-layout__content">
    <div class="page-content">