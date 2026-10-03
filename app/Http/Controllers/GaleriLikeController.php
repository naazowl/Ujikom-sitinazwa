<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriLike;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriLikeController extends Controller
{
    // Mengambil jumlah like semua foto + foto mana saja yang sudah di-like pengunjung ini
    public function index(Request $request)
    {
        $token = $request->cookie('visitor_token');

        $counts = GaleriLike::selectRaw('galeri_id, COUNT(*) as total')
            ->groupBy('galeri_id')
            ->pluck('total', 'galeri_id');

        $liked = $token
            ? GaleriLike::where('visitor_token', $token)->pluck('galeri_id')
            : collect();

        return response()->json([
            'counts' => $counts,
            'liked'  => $liked,
        ]);
    }

    // Like / batalkan like
    public function toggle(Request $request, Galeri $galeri)
    {
        $token = $request->cookie('visitor_token') ?: Str::random(40);

        $like = GaleriLike::where('galeri_id', $galeri->id)
            ->where('visitor_token', $token)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            GaleriLike::create([
                'galeri_id'     => $galeri->id,
                'visitor_token' => $token,
            ]);
            $liked = true;
        }

        $count = GaleriLike::where('galeri_id', $galeri->id)->count();

        return response()
            ->json(['liked' => $liked, 'count' => $count])
            ->cookie('visitor_token', $token, 60 * 24 * 365);
    }
}