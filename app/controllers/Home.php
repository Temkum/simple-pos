<?php

if (Auth::access('cashier')) {
  require viewsPath('home');
} else {
  Auth::setMessage('You need to be logged in in order to access this page!');

  require viewsPath('auth/access');
}