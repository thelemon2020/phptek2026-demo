<?php

namespace App\Http\Controllers;

use App\Models\MirrorLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MirrorController extends Controller
{
    public function index(): JsonResponse
    {
        $logs = MirrorLog::query()
            ->latest('created_at')
            ->limit(20)
            ->get()
            ->map(fn (MirrorLog $log) => [
                'method' => $log->method,
                'uri' => $log->uri,
                'ip' => $log->ip,
                'at' => $log->created_at?->toDateTimeString(),
            ]);

        return response()->json([
            'nginx_demo' => 'request mirroring — every request duplicated to /mirror-log',
            'mirrored_requests' => $logs,
        ]);
    }

    public function store(Request $request): Response
    {
        $secret = $request->header('X-Mirror-Secret');

        if ($secret !== config('demo.mirror_secret')) {
            return response('', 403);
        }

        MirrorLog::create([
            'method' => $request->method(),
            'uri' => $request->header('X-Original-URI', $request->getRequestUri()),
            'headers' => $request->headers->all(),
            'ip' => $request->ip(),
            'created_at' => now(),
        ]);

        return response('', 204);
    }
}
