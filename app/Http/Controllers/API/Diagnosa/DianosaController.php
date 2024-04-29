<?php

namespace App\Http\Controllers\API\Diagnosa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DianosaController extends Controller
{
    public function sendFile(Request $request) {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => "Invalid request."], 400);
        }

        $file = $request->file('file');
        $tmpFileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $tmpFilePath = $file->storeAs('tmp', $tmpFileName); // Store Ke Temp

        $remoteUrl = 'http://localhost:8000/uploadgambar/';
        $postData = [
            'file' => new \CURLFile(storage_path('app/' . $tmpFilePath), $file->getClientMimeType(), $file->getClientOriginalName()),
        ];

        $response = $this->sendFileToRemoteServer($remoteUrl, $postData);

        Storage::delete($tmpFilePath); //Delete Setelah Deteksi Selanjutnya

        if ($response['httpCode'] == 200) {
            return response()->json(['response' => json_decode($response['response'], true)], 200);
        } else {
            return response()->json(['error' => $response['error']], 400);
        }
    }

    private function sendFileToRemoteServer($remoteUrl, $postData) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['httpCode' => 0, 'response' => null, 'error' => "cURL error: " . $error];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'httpCode' => $httpCode,
            'response' => $response,
            'error' => ($httpCode != 200) ? "Remote Gagal" . $httpCode : null,
        ];
    }
}
