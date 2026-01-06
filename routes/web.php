<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes (يجب أن تكون أولاً)
require __DIR__.'/front.php';

// Auth Routes
require __DIR__.'/auth.php';

// Admin Routes (يجب أن تكون أخيراً)
require __DIR__.'/admin.php';