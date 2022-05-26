<?php

if (Auth::access('cashier')) {
    require viewsPath('home');
} else {
    redirect('login');
}