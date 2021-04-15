<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SignatureController;
use App\Http\Controllers\Api\ReportSignature;

use function PHPUnit\Framework\matches;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/signatures', SignatureController::class)->only(['index', 'store', 'show']);
Route::put('/signatures/{signature}/report', [ReportSignature::class, 'update']);