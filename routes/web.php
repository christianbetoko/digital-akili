<?php

use App\Livewire\AboutPage;
use App\Livewire\HomePage;
use App\Livewire\RealisationsPage;
use App\Livewire\ServicesPage;
use App\Livewire\BlogPage;
use App\Livewire\ContactPage;
use App\Livewire\SingleBlogPage;
use App\Livewire\SingleRealisationPage;
use App\Livewire\SingleServicePage;
use App\Livewire\TeamPage;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomePage::class)->name('home');
Route::get('/apropos', AboutPage::class)->name('about');
Route::get('/services', ServicesPage::class)->name('services');
Route::get('/actualites', BlogPage::class)->name('blog');
Route::get('/actualite/{slug}', SingleBlogPage::class)->name('blog.single');
Route::get('/realisations', RealisationsPage::class)->name('realisations');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/equipe', TeamPage::class)->name('team');
Route::get('/realisation/{slug}', SingleRealisationPage::class)->name('realisation');
Route::get('/service/{slug}', SingleServicePage::class)->name('service');
