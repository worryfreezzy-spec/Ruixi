<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CeoController;
use App\Http\Controllers\CataractController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EyeDiseaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LasikController;
use App\Http\Controllers\PlasticSurgeryController;
use App\Http\Controllers\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::post('/contact-submit', [ContactSubmissionController::class, 'store'])->name('contact.submit');
Route::get('/about', AboutController::class);
Route::get('/about.html', AboutController::class);
Route::get('/ceo', CeoController::class);
Route::get('/ceo.html', CeoController::class);
Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors.html', [DoctorController::class, 'index']);
Route::get('/dr-{slug}', [DoctorController::class, 'show'])->where('slug', '[A-Za-z0-9_-]+');
Route::get('/dr-{slug}.html', [DoctorController::class, 'show'])->where('slug', '[A-Za-z0-9_-]+');
Route::get('/why-choose-us', WhyChooseUsController::class);
Route::get('/why-choose-us.html', WhyChooseUsController::class);
Route::get('/cataract', [CataractController::class, 'index']);
Route::get('/cataract.html', [CataractController::class, 'index']);
Route::get('/no-blade-cataract-surgery', fn (CataractController $controller) => $controller->show('no-blade-cataract-surgery'));
Route::get('/no-blade-cataract-surgery.html', fn (CataractController $controller) => $controller->show('no-blade-cataract-surgery'));
Route::get('/refractive-lens-exchange', fn (CataractController $controller) => $controller->show('refractive-lens-exchange'));
Route::get('/refractive-lens-exchange.html', fn (CataractController $controller) => $controller->show('refractive-lens-exchange'));
Route::get('/eye-diseases-management', [EyeDiseaseController::class, 'index']);
Route::get('/eye-diseases-management.html', [EyeDiseaseController::class, 'index']);
Route::get('/laser-vision-correction', [LasikController::class, 'index']);
Route::get('/laser-vision-correction.html', [LasikController::class, 'index']);
Route::get('/kids', [ChildrenController::class, 'index']);
Route::get('/kids.html', [ChildrenController::class, 'index']);
Route::get('/plastic-surgery', PlasticSurgeryController::class);
Route::get('/plastic-surgery.html', PlasticSurgeryController::class);
Route::get('/contact', [ContactPageController::class, 'index']);
Route::get('/contact.html', [ContactPageController::class, 'index']);
foreach ([
    'zeiss-smile-pro',
    'presbyond',
    'relex-smile',
    'clearmax',
    'femto-lasik',
    'advanced-surface-ablation',
    'tesa-s',
    'implantable-collamer-lens',
    'rigid-gas-permeable-lenses',
] as $lasikSlug) {
    Route::get('/' . $lasikSlug, fn (LasikController $controller) => $controller->show($lasikSlug));
    Route::get('/' . $lasikSlug . '.html', fn (LasikController $controller) => $controller->show($lasikSlug));
}
foreach ([
    'ttdi',
    'sri-petaling',
    'cheras',
    'kepong',
    'melawati',
    'oug',
    'damansara-jaya',
    'sunway',
    'elmina',
    'kota-kemuning',
    'shah-alam',
    'klang',
    'penang',
    'bukit-mertajam',
    'ipoh',
    'seremban',
    'bahau',
    'kluang',
    'muar',
    'segamat',
    'johor',
    'sutera',
    'kuching',
    'kota-kinabalu',
    'cambodia',
] as $branchSlug) {
    Route::get('/' . $branchSlug, fn (ContactPageController $controller) => $controller->show($branchSlug));
    Route::get('/' . $branchSlug . '.html', fn (ContactPageController $controller) => $controller->show($branchSlug));
}
foreach ([
    'kids-myopia',
    'amblyopia',
    'strabismus',
    'eye-examinations-kids',
    'ortho-k',
    'orthoptist',
] as $childrenSlug) {
    Route::get('/' . $childrenSlug, fn (ChildrenController $controller) => $controller->show($childrenSlug));
    Route::get('/' . $childrenSlug . '.html', fn (ChildrenController $controller) => $controller->show($childrenSlug));
}
foreach ([
    'glaucoma',
    'diabetic-retinopathy',
    'conjunctivitis',
    'dry-eyes',
    'pterygium',
    'aged-related-macular-degeneration',
    'retinal-detachment',
    'keratoconus',
    'ptosis-surgery',
    'eye-examinations',
] as $eyeDiseaseSlug) {
    Route::get('/' . $eyeDiseaseSlug, fn (EyeDiseaseController $controller) => $controller->show($eyeDiseaseSlug));
    Route::get('/' . $eyeDiseaseSlug . '.html', fn (EyeDiseaseController $controller) => $controller->show($eyeDiseaseSlug));
}

Route::get('/static/{path}', function (string $path) {
    $file = public_path('static/' . $path);

    if (! is_file($file)) {
        $file = base_path('html/static/' . $path);
    }

    abort_unless(is_file($file), 404);

    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'application/javascript; charset=utf-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
    ];

    return response()->file($file, [
        'Content-Type' => $mimeTypes[$extension] ?? 'application/octet-stream',
    ]);
})->where('path', '.*');

Route::get('/{page}.html', function (string $page) {
    $file = base_path("html/{$page}.html");

    abort_unless(is_file($file), 404);

    return response()->file($file);
})->where('page', '[A-Za-z0-9_-]+');
