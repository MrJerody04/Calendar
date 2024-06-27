<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <style>

        * {
            font-family: Helvetica;
        }

        .navigation li a {
            color: cyan;
            text-decoration: none;
            box-shadow: inset 0 0 cyan;
            padding: 7px 15px;
            transition: all ease-in-out .5s;
            border-radius: 7px;
        }

        .navigation li a:hover {
            box-shadow: inset 0 -80px cyan;
            color: black;
        }

        .desktop_nav .div a {
            color: cyan;
            text-decoration: none;
            box-shadow: inset 0 0 cyan;
            padding: 7px 15px;
            transition: all ease-in-out .5s;
            align-items: center;
            border-radius: 7px;
        }

        .form-control::placeholder {
            color: cyan;
            opacity: 1; /* Firefox */
        }

        .desktop_nav .div a:hover {
            box-shadow: inset 0px -80px cyan;
            color: black;
        }

        body {
            margin: 0;
            background: #262626;
        }

        .nav_content {
            display: flex;
            justify-content: space-between;
            justify-items: center;
            max-width: 1280px;
            width: 100%;
        }

        .desktop_nav {
            display: flex;
            justify-content: center;
            z-index: 1000000;
            position: relative;
        }

        .desktop_nav div {
            align-content: center;
        }

        .desktop_nav a {
            font-weight: bold;
            font-family: "Helvetica";
        }

        .mobile_nav {
            display: none;
            position: relative;
            z-index: 1000000;
        }

        main {
            max-width: 1280px;
            margin: 30px auto;
            color: white;
        }

        .mobile_nav .mobile_nav_content {
            justify-content: space-between;
            display: flex;
            text-align: right;
            font-family: "Helvetica";
            color: cyan;
            font-weight: bold;
        }

        .mobile_nav .mobile_nav_content p {
            margin: 0;
            align-content: center;
        }

        .mobile_nav .mobile_nav_content svg {
            fill: cyan;
        }

        .navigation_mobile {
            list-style: none;
            display: none;
            flex-direction: column;
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px 0;
            justify-content: center;
            text-align: center;
            position: absolute;
            background: black;
            width: 100%;
            left: 0;
            top: 52px;
            margin: 0 auto;
        }

        .navigation_mobile li a {
            font-family: "Helvetica";
            color: cyan;
            font-weight: bold;
            text-decoration: none;
            padding: 5px;
        }

        .navigation_mobile li a:hover {
            border-radius: 5px;
        }


        .form-control {
            background: black;
            color: cyan;
            border: 1px solid white;
            padding: 10px;
            outline: none;
            font-weight: bold;
            margin-bottom: 2px;
            border-radius: 15px;
        }

        .btn {
            color: cyan;
            background: black;
            padding: 10px 20px;
            border: 0;
            text-decoration: none;
            cursor: pointer;
            border-radius: 15px;
            display: inline-block;
            font-weight: bold;
        }

        .btn:hover {
            color: black;
            background: cyan;
        }

        .btn-group {
            margin: 2px 0;
        }

        .flex {
            display: flex !important;
        }

        .fc .fc-button-primary {
            color: cyan;
        }

        .fc .fc-button-primary, .fc .fc-button-primary:disabled {
            background: black;
            border-color: black;
            color: cyan;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active, .fc .fc-button-primary:not(:disabled):active {
            background: cyan;
            border-color: cyan;
            color: black;
        }

        .fc .fc-button-primary:focus {
            box-shadow: none;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active:focus, .fc .fc-button-primary:not(:disabled):active:focus, .fc .fc-button-primary:not(:disabled).fc-button-active:focus, .fc .fc-button-primary:not(:disabled):active:focus {
            box-shadow: none;
        }

        .fc .fc-button-primary:hover {
            background: cyan;
            border-color: cyan;
            color: black;
        }

        @media screen and (max-width: 992px) {
            .desktop_nav {
                display: flex;
            }

            .mobile_nav {
                display: none;
            }

            .fc .fc-toolbar.fc-header-toolbar {
                display: flex;
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 20px !important;
            }
        }

        @media screen and (max-width: 720px) {
            .desktop_nav {
                display: none;
            }

            .mobile_nav {
                display: flex;
                flex-direction: column;
                position: relative;
                justify-content: right;
            }
        }
    </style>
</head>
<body>
<nav style="background-color:black;padding: 10px;" class="desktop_nav">
    <div class="nav_content">
        <div class="div"><a href="/">Home</a></div>
        <ul style="list-style: none;display: flex;flex-direction: row;flex-wrap: wrap;gap:15px;justify-content:center;padding:0;"
            class="navigation">
            <li><a href="/rezervace">Rezervace</a></li>
            <li><a href="/test">Test</a></li>
        </ul>
        <div class="div"><a href="/signout">Odhlásit</a></div>
    </div>
</nav>
<nav style="background-color:black;padding: 10px;" class="mobile_nav">
    <div class="mobile_nav_content">
        <p>Test</p>
        <div onclick="mobile_hamburger()">
            <svg xmlns="http://www.w3.org/2000/svg" width="25px" viewBox="0 0 448 512">
                <path
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
            </svg>
        </div>
    </div>
    <ul style="" class="navigation_mobile" id="mobile_nav">
        <li><a href="/">Home</a></li>
        <li><a href="/rezervace">Rezervace</a></li>
        <li><a href="/test">Test</a></li>
        <li><a href="/signout">Odhlásit</a></li>
    </ul>
</nav>
<div style="max-width: 1280px; text-align: center;margin: 25px auto;color: white;">
