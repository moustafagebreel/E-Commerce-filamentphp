<?php

use App\Livewire\CartPage;
use App\Livewire\HomePage;
use App\Livewire\CancelPage;
use App\Livewire\ProfilePage;
use App\Livewire\SuccessPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductsPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\CategoriesPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',HomePage::class);
Route::get('/categories',CategoriesPage::class);
Route::get('cart',CartPage::class);
Route::get('/products',ProductsPage::class);
Route::get('/products/{product}',ProductDetailPage::class);
Route::get('/checkout',CheckoutPage::class);
Route::get('/checkout/success',CheckoutPage::class);
Route::get('/checkout/cancel',CheckoutPage::class);
Route::get('/my-orders',MyOrdersPage::class);
Route::get('/my-orders/{order}',MyOrderDetailPage::class);
Route::get('/login',LoginPage::class);
Route::get('/register',RegisterPage::class);
Route::get('/forgot',ForgotPasswordPage::class);
Route::get('/reset-password',ResetPasswordPage::class);
Route::get('/success',SuccessPage::class);
Route::get('/cancel',CancelPage::class);
Route::get('/wishlist', \App\Livewire\WishlistPage::class);
Route::get('/contact', \App\Livewire\ContactPage::class);
Route::get('/profile',ProfilePage::class);


