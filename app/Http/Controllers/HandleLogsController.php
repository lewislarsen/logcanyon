<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HandleLogsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $logData = $request->json()?->all();

        if (! isset($logData['site_id'], $logData['site_secret_key'])) {
            return response()->json(['message' => 'Please ensure you are providing the site_id and site_secret_key.'], 400);
        }

        $application = Application::where('id', $logData['site_id'])
            ->where('secret_key', $logData['site_secret_key'])
            ->first();

        if (! $application) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $log = new Log;
        $log->level = $logData['level'] ?? 'info';
        $log->message = $logData['message'] ?? '';
        $log->context = json_encode($logData['context'] ?? [], JSON_THROW_ON_ERROR);
        $application->logs()->save($log);

        $application->update(['last_logs_sent_at' => now()]);

        return response()->json(['message' => 'Log processed successfully.']);
    }
}
