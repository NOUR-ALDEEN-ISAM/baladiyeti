<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->get();
        return view('reports.index', ['reports' => $reports]);
    }

    public function showUpdateResponseForm($id)
    {
        $report = Report::with('user')->find($id);
        if (!$report) {
            Log::error("Report with ID $id not found.");
            return redirect()->back()->with('error', "Report with ID $id not found.");
        }

        return view('reports.update_response', ['report' => $report]);
    }

    public function updateResponse(Request $request, $id)
    {
        $report = Report::find($id);
        if (!$report) {
            Log::error("Report with ID $id not found.");
            return redirect()->back()->with('error', "Report with ID $id not found.");
        }

        $file = $request->file('photo_2');
        $url = $file ? $this->uploadFile($file, 'Reports') : $report->photo_2;

        $report->update([
            'text_2' => $request->text_2 ?? $report->text_2,
            'photo_2' => $url,
        ]);

        try {
            $this->sendSmsNotification($report);
            Log::info("SMS notification sent successfully to user with ID {$report->user->id}.");
        } catch (\Exception $e) {
            Log::error("Failed to send SMS notification: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Report response updated and notification sent successfully.');
    }

    private function uploadFile($file, $directory)
    {
        $path = Storage::disk('public')->put($directory, $file);
        return Storage::url($path);
    }

    private function sendSmsNotification($report)
    {
        $user = $report->user;

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');
        $client = new Client($sid, $token);

        $message = "تم تحديث استجابتك للبلاغ. نص الاستجابة: " . $report->text_2;

        $client->messages->create(
            $user->phone,
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        );
    }
}
