<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get("/categories", [CategoryController::class, "index"]);
    Route::post("/categories", [CategoryController::class, "store"]);
    Route::get("/categories/{category}", [CategoryController::class, "show"]);
    Route::put("/categories/{category}", [CategoryController::class, "update"]);
    Route::delete("/categories/{category}", [
        CategoryController::class,
        "destroy",
    ]);

    // User authentication check
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::get("/logout", [AuthController::class, "logout"]);
});

//Auth routes
Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
