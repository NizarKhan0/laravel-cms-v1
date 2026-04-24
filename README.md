# Dynamic Permissions (cms-laravel-v1)

Pengenalan
- Projek ini gunakan Laravel + Spatie Laravel-Permission. Permissions disimpan per guard (guard_name).
- Konsep dynamic permissions: bila model menggunakan trait HasDynamicPermissions dan dicipta, permissions standard akan dijana secara automatik.
- Contoh pola nama permission: BackendUser → backend-user.view, backend-user.create, backend-user.update, backend-user.delete.
- Nama permission menggunakan format slug.action, di mana slug adalah kebab-case bagi nama kelas model.

Kenapa slug berbeza daripada nama kelas
- Nama kelas PHP seperti BackendUser adalah BackendUser.
- Slug permission dihasilkan dalam kebab-case: BackendUser → backend-user.
- Permissions akan jadi backend-user.view, backend-user.create, dsb.

Konsep Utama
- HasDynamicPermissions (trait) menjana permissions secara automatik ketika model dicipta.
-Slug dan format permission: slug.action (cth backend-user.view).
- Guard utama adalah admin secara default. Sokongan multi-guard boleh ditambah kemudian.
- UI permission menyokong pemilihan guard_name untuk setiap permission.

Cara Gunaan Praktikal
1) Model baru
- Tambah trait HasDynamicPermissions pada model baru. Contoh:
  - namespace App\\Models\\backendUser;
  - use App\\Models\\Concerns\\HasDynamicPermissions;
  - class Article extends Model { use HasDynamicPermissions; }
- Bila Article dicipta, permissions akan dijana: article.view, article.create, article.update, article.delete.

2) Guna permission di UI
- Dalam create/edit permission, anda boleh pilih guard_name (mengikut config('auth.guards')).
- Nama permission tetap (cth article.view), tetapi guard_name akan sahkan konteksnya.

3) Guna dynamic permission di view/middleware
- Blade directive contoh:
  @dynamiccan('view', App\\Models\\backendUser\\Article::class)
    // content dilindungi
  @enddynamiccan
- Middleware contoh (CheckDynamicPermission):
  Route::get('/admin/articles', [ArticleController::class, 'index'])
    ->middleware('dynamic_perm:view,App\\Models\\backendUser\\Article');
- Helper untuk nama permission:
  App\\Helpers\\DynamicPermissionHelper::permissionName('view', App\\Models\\backendUser\\Article::class)
  // hasilnya: backend-user.view

4) Multi-guard (future)
- Pegangan sekarang: admin. Untuk multi-guard, tambah logik simpan guard pada model, tambah pilihan guard pada trait, dan sesuaikan query permission.

Fail-fail utama yang terlibat (ringkas)
- app/Models/Concerns/HasDynamicPermissions.php
- app/Helpers/DynamicPermissionHelper.php
- app/Models/backendUser/BackendUser.php (contoh penerapan trait)
- resources/views/backend-user/module/permission/create.blade.php
- resources/views/backend-user/module/permission/edit.blade.php
- app/Http/Controllers/backendUser/PermissionController.php
- app/Providers/AppServiceProvider.php
- app/Http/Middleware/CheckDynamicPermission.php
- README ini sebagai panduan ringkas

Langkah verifikasi
- Buat model baru yang menggunakan HasDynamicPermissions. Semak DB untuk permissions baru (cth backend-user.view, backend-user.create, dsb).
- Gunakan permission tersebut untuk gating di view atau route middleware.
- Pastikan guard_name konsisten jika anda guna multi-guard.

Soalan Lazim
- Mengapa slug jadi backend-user? Kerana kita guna kebab-case untuk slug model.
- Boleh tukar format kepada view_backend-user? Ya, kita boleh tukar pola di DynamicPermissionHelper jika diperlukan.

Kredit
- Komponen ini disediakan sebagai helper untuk kemudahan pembuatan permissions secara dinamik dalam projek anda.
