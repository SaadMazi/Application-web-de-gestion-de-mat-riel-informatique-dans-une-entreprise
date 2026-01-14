<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// --- 1. ROUTES PUBLIQUES (Login/Logout) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 2. ROUTES PARTAGÉES (Accessibles aux Employés ET Admins) ---
Route::middleware(['auth'])->group(function () {

    // Le Dashboard (Tout le monde peut voir les stats)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Lecture seule : Liste du matériel et des catégories
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Lecture seule : Liste des affectations et historique
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/history', [AssignmentController::class, 'history'])->name('assignments.history');

    // Maintenance : Tout le monde peut voir la liste et SIGNALER une panne
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::get('/maintenances/create', [MaintenanceController::class, 'create'])->name('maintenances.create');
    Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store');
});


// --- 3. ROUTES ADMINISTRATEUR (Actions sensibles : Créer, Supprimer, Modifier) ---
// On applique le middleware 'is_admin' que nous avons créé
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Gestion complète des employés (Seul l'admin gère le personnel)
    Route::resource('employees', EmployeeController::class);

    // Actions Admin sur le Matériel (Création et Suppression)
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy'); // Si tu as ajouté destroy

    // Actions Admin sur les Catégories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Actions Admin sur les Affectations (Donner un PC ou le Reprendre)
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::post('/assignments/{id}/return', [AssignmentController::class, 'returnMaterial'])->name('assignments.return');

    // Actions Admin Maintenance (Marquer comme réparé)
    Route::post('/maintenances/{id}/close', [MaintenanceController::class, 'close'])->name('maintenances.close');
});


// --- 3. ROUTES ADMINISTRATEUR ---
Route::middleware(['auth', 'is_admin'])->group(function () {

    // ... tes autres routes admin ...

    // AJOUTE CECI : Gestion des Admins
    Route::resource('admins', AdminController::class);

});
