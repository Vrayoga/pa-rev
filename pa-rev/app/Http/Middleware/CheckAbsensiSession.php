<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckAbsensiSession
{
   // app/Http/Middleware/CheckAbsensiSession.php

   public function handle(Request $request, Closure $next)
   {
      // Skip pengecekan untuk non-guru
      if (!auth()->check() || !auth()->user()->hasRole('guru')) {
         return $next($request);
      }

      // Debugging: Log session yang ada
      Log::debug('Middleware CheckAbsensiSession - Session Data', [
         'has_opened_attendance' => session('has_opened_attendance'),
         'all_session_keys' => array_keys(session()->all())
      ]);

      // Cek session terlebih dahulu (paling cepat)
      if (session('has_opened_attendance')) {
         return $next($request);
      }

      // Fallback ke pengecekan database
      $hasActiveSession = SesiAbsensi::where('guru_id', auth()->id())
         ->whereDate('waktu_buka', today())
         ->exists();

      if ($hasActiveSession) {
         // Update session jika ditemukan di database
         session(['has_opened_attendance' => true]);
         session()->save(); // Pastikan disimpan

         return $next($request);
      }

      // Jika tidak memenuhi syarat
      if ($request->wantsJson()) {
         return response()->json(['message' => 'Buka absensi terlebih dahulu'], 403);
      }

      return redirect()->route('dashboardGuru.index')
         ->with('error', 'Anda harus membuka sesi absensi terlebih dahulu');
   }
}
