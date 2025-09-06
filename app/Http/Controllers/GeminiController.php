<?php

// app/Http/Controllers/GeminiController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiController extends Controller
{
    public function handle(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Chatbot request received', [
            'all_input' => $request->all(),
            'message' => $request->input('message'),
            'headers' => $request->headers->all()
        ]);

        $message = $request->input('message');

        if (empty($message)) {
            return response()->json([
                'reply' => 'Please provide a message to get assistance.'
            ], 400);
        }

        $apiKey = env('GOOGLE_API_KEY');
        if (empty($apiKey)) {
            // Provide a helpful fallback response for scholarship-related questions
            $fallbackResponses = [
                "I'd be happy to help you find scholarships! You can browse our available scholarships on the scholarships page, or tell me more about what you're looking for.",
                "For scholarship assistance, I recommend checking out our scholarship listings. What specific type of scholarship are you interested in?",
                "I can help you with scholarship information! What would you like to know about funding opportunities for your education?",
                "Let me help you find the right scholarship! What field of study or type of funding are you looking for?"
            ];

            return response()->json([
                'reply' => $fallbackResponses[array_rand($fallbackResponses)]
            ]);
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

        try {
            Log::info('Sending request to Gemini API', [
                'url' => $url,
                'message' => $message
            ]);

            $response = Http::timeout(30)->post($url, [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $message]
                        ]
                    ]
                ]
            ]);

            Log::info('Gemini API response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $reply = $response->json('candidates.0.content.parts.0.text');
                return response()->json([
                    'reply' => $reply ?: 'I apologize, but I couldn\'t generate a response. Please try again.'
                ]);
            } else {
                Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json([
                    'reply' => 'I\'m having trouble processing your request right now. Please try again later.'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Gemini API exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'reply' => 'I\'m experiencing technical difficulties. Please try again later.'
            ], 500);
        }
    }
}
