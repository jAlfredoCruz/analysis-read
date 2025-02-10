<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookManagerController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\ArgumentController;
use App\Http\Controllers\DesinformationController;
use App\Http\Controllers\MisinformationController;
use App\Http\Controllers\IlogicController;
use App\Http\Controllers\IncompleteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('manager')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {

    Route::get('first_level/{book}', [BookManagerController::class, 'first_level'])->name('first_level');

    Route::get('second_level/extensive/{book}', [BookManagerController::class, 'extensive'])->name('extensive');
    Route::get('second_level/superficial/{book}', [BookManagerController::class, 'superficial'])->name('superficial');

    Route::get('second_level/questions/{book}', [BookManagerController::class, 'questions'])->name('questions');

    Route::get('second_level/{question}/{book}', [BookManagerController::class, 'question'])->name('question');
    Route::get('third_level/classification/{book}', [BookManagerController::class, 'classification'])->name('classification');
    Route::get('third_level/my_categories/{book}', [BookManagerController::class, 'myCategories'])->name('my_categories');

    Route::get('third_level/unity/{book}', [BookManagerController::class, 'unity'])->name('unity');

    Route::get('third_level/perfil/{book}', [PerfilController::class, 'perfil'])->name('perfil');
    Route::get('third_level/perfil/create/{book}', [PerfilController::class, 'create'])->name('create_perfil');
    Route::get('third_level/perfil/update/{perfil}/{book}', [PerfilController::class, 'update'])->name('update_perfil');
    Route::get('third_level/perfil/read/{perfil}/{book}', [PerfilController::class, 'read'])->name('read_perfil');

    Route::get('third_level/problem/{book}', [ProblemController::class, 'problem'])->name('problem');
    Route::get('third_level/problem/create/{book}', [ProblemController::class, 'create'])->name('create_problem');
    Route::get('third_level/problem/update/{problem}/{book}', [ProblemController::class, 'update'])->name('update_problem');
    Route::get('third_level/problem/read/{problem}/{book}', [ProblemController::class, 'read'])->name('read_problem');

    Route::get('third_level/term/{book}', [TermController::class, 'term'])->name('term');
    Route::get('third_level/term/create/{book}', [TermController::class, 'create'])->name('term_create');
    Route::get('third_level/term/update/{term}/{book}', [TermController::class, 'update'])->name('term_update');
    Route::get('third_level/term/read/{term}/{book}', [TermController::class, 'read'])->name('term_read');

    Route::get('third_level/sentence/{book}', [SentenceController::class, 'sentence'])->name('sentence');
    Route::get('third_level/sentence/create/{book}', [SentenceController::class, 'create'])->name('create_sentence');
    Route::get('third_level/sentence/update/{sentence}/{book}', [SentenceController::class, 'update'])->name('update_sentence');
    Route::get('third_level/sentence/read/{sentence}/{book}', [SentenceController::class, 'read'])->name('read_sentence');

    Route::get('third_level/argument/{book}', [ArgumentController::class, 'argument'])->name('argument');
    Route::get('third_level/argument/create/{book}', [ArgumentController::class, 'create'])->name('create_argument');
    Route::get('third_level/argument/update/{argument}/{book}', [ArgumentController::class, 'update'])->name('update_argument');
    Route::get('third_level/argument/read/{argument}/{book}', [ArgumentController::class, 'read'])->name('read_argument');

    Route::get('third_level/solution/{book}', [ProblemController::class, 'answers'])->name('answer');
    Route::get('third_level/solution/update/{problem}/{book}', [ProblemController::class, 'updateSolution'])->name('update_answer');
    Route::get('third_level/solution/read/{problem}/{book}', [ProblemController::class, 'readSolution'])->name('read_answer');

    Route::get('third_level/other/rules/{book}', [BookManagerController::class, 'otherRules'])->name('other_rules');

    Route::get('third_level/desinformation/{book}', [DesinformationController::class, 'desinformation'])->name('desinformation');
    Route::get('third_level/desinformation/create/{book}', [DesinformationController::class, 'create'])->name('create_desinformation');
    Route::get('third_level/desinformation/update/{desinformation}/{book}',                        [DesinformationController::class, 'update'])->name('update_desinformation');
    Route::get('third_level/desinformation/read/{desinformation}/{book}', [DesinformationController::class, 'read'])->name('read_desinformation');

    Route::get('third_level/misinformation/{book}', [MisinformationController::class, 'misinformation'])->name('misinformation');
    Route::get('third_level/misinformation/create/{book}', [MisinformationController::class, 'create'])->name('create_misinformation');
    Route::get('third_level/misinformation/update/{misinformation}/{book}', [MisinformationController::class, 'update'])->name('update_misinformation');
    Route::get('third_level/misinformation/read/{misinformation}/{book}', [MisinformationController::class, 'read'])->name('read_misinformation');

    Route::get('third_level/ilogic/{book}', [IlogicController::class, 'ilogic'])->name('ilogic');
    Route::get('third_level/ilogic/create/{book}', [IlogicController::class, 'create'])->name('create_ilogic');
    Route::get('third_level/ilogic/update/{ilogic}/{book}', [IlogicController::class, 'update'])->name('update_ilogic');
    Route::get('third_level/ilogic/read/{ilogic}/{book}', [IlogicController::class, 'read'])->name('read_ilogic');

    Route::get('third_level/incomplete/{book}', [IncompleteController::class, 'incomplete'])->name('incomplete');
    Route::get('third_level/incomplete/create/{book}', [IncompleteController::class, 'create'])->name('create_incomplete');
    Route::get('third_level/incomplete/update/{incomplete}/{book}', [IncompleteController::class, 'update'])->name('update_incomplete');
    Route::get('third_level/incomplete/read/{incomplete}/{book}', [IncompleteController::class, 'read'])->name('read_incomplete');
});
