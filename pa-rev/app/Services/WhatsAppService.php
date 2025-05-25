<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $token;
    protected $phoneNumberId;

    public function __construct()
    {
        $this->token = config('services.whatsapp.token'); // simpan di .env
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
    }

    public function sendMessage($to, $message)
    {
        $url = "https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages";

        return Http::withToken($this->token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $to, // format: 62XXXXXXXXX
            'type' => 'text',
            'text' => [
                'body' => $message
            ]
        ]);
    }
}
