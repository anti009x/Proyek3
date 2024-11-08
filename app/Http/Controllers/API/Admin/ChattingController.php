<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CookieChatting;
use Illuminate\Support\Facades\Auth;
class ChattingController extends Controller
{
    public function index()
    {
        return view('MainDashboard.LandingPage.chatting');
    }

    public function sendTiket(Request $request)
    {
        // Ensure the channel is generated or retrieved correctly
        $user_id = auth()->user()->id;
        $nama = auth()->user()->nama;
        $channel = $request->input('channel') ?? $request->cookie('channel') ?? $this->generateChannel();

        // Validate the request data
        $validatedData = $request->validate([
            'channel' => 'required|integer',
            '_token' => 'required', // Ensure CSRF token is present
        ]);

        $validatedData['channel'] = $channel;
        $validatedData['nama'] = $nama;
        $validatedData['user_id'] = $user_id;

        // Generate a unique integer ID within a safe range for the database
        do {
            $validatedData['id'] = random_int(1, 2147483647);
        } while (CookieChatting::where('id', $validatedData['id'])->exists());

        try {
            // Create the ticket
            CookieChatting::create($validatedData);
            $message = 'Tiket berhasil dikirim';
            return redirect()->route('admin.dashboard')->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = 'Gagal mengirim tiket. Silakan coba lagi.';
            return redirect()->route('admin.dashboard')->with('error', $errorMessage);
        }
    }

    public function sendMessage(Request $request)
    {
        $antarinInput = $request->input('antarin');
        $responseMessage = '';

        // Attempt to get the channel from the request; if not present, get from cookie or generate a new one
        $channel = $request->input('channel') ?? $request->cookie('channel') ?? $this->generateChannel();

        if ($antarinInput === 'Apa Itu Antar In?') {
            $responseMessage = 'Adalah layanan yang memudahkan anda untuk mengirimkan barang ke tempat tujuan anda dengan mudah dan cepat.';
        } elseif ($antarinInput === 'Apa Fungsi Antar In?') {
            $responseMessage = 'Layanan pengiriman ekspedisi yang menghadirkan berbagai macam pilihan dalam proses pengiriman.';
        } elseif ($antarinInput === 'Diskusi Dengan Developer') {
            $responseMessage = 'Anda dapat berkomunikasi langsung dengan developer untuk mengetahui lebih lanjut mengenai layanan kami. <br> Channel: ' . $channel . '
             <br> Tekan disini untuk mengirim tiket anda <form action="' . route('sendTiket') . '" method="POST" style="display:inline;"><input type="hidden" name="channel" value="' . $channel . '"><input type="hidden" name="_token" value="' . csrf_token() . '"><button type="submit" style="color: yellow; background: none; border: none; padding: 0; cursor: pointer;">Klik Disini</button></form> <br> 
             Pastikan cookie channel tetap aktif dan tidak dihapus untuk melanjutkan diskusi. Kami akan merespons dengan lebih cepat.';
   
        } else {
            $responseMessage = 'Maaf, saya tidak mengerti pertanyaan anda.';
        }

        // Retrieve existing chat history from cookies
        $history = json_decode($request->cookie('chat_history', '[]'), true);

        // Append the new message to the history
        $history[] = ['question' => $antarinInput, 'response' => $responseMessage];

        // Create cookies for chat history and channel
        $chatHistoryCookie = cookie('chat_history', json_encode($history), 60); // 60 minutes
        $channelCookie = cookie('channel', $channel, 60); // 60 minutes

        return response()->json(['message' => $responseMessage, 'channel' => $channel])
                         ->cookie($chatHistoryCookie)
                         ->cookie($channelCookie);
    }

    public function generateChannel()
    {
        return random_int(10000, 99999);
    }

    public function getChatData(Request $request)
    {
        $history = json_decode($request->cookie('chat_history', '[]'), true);
        $channel = $request->cookie('channel', $this->generateChannel());

        return response()->json(['history' => $history, 'channel' => $channel])
                         ->cookie('channel', $channel, 60);
    }

        public function deleteCookie(Request $request)
        {
            $chatHistoryCookie = cookie('chat_history', null, -1);
            $channelCookie = cookie('channel', null, -1);

            return response()->json(['message' => 'Chat history and channel deleted'])
                            ->cookie($chatHistoryCookie)
                            ->cookie($channelCookie);
        }



}
