<?php

namespace App\Http\Controllers;

use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Http\Request;
use Log;

class OllamaController extends Controller
{


    public function generateResponse(Request $request)
    {
        // Retrieve current conversation history from session
        $conversationHistory = session()->get('conversation_history', []);

        // Add the user's prompt to the conversation history
        $conversationHistory[] = "USER: " . $request->input('prompt');

//         Build the full prompt (if needed)
        $fullPrompt = implode("\n", $conversationHistory);

        // Make the request to Ollama with the full prompt
        $response = Ollama::agent('You are a lama, the animal, and a friendly assistant')
            ->prompt($fullPrompt)
            ->model('mistral')
            ->options(['temperature' => 0.8])
            ->stream(false)
            ->ask();

        // Add the bot's response to the conversation history
        $conversationHistory[] = "BOT: " . $response['response']; // Assuming 'response' contains the actual response text

        // Update the session with the updated conversation history
        session()->put('conversation_history', $conversationHistory);

        // Limit conversation history to the last 10 prompts (if needed)
        if (count($conversationHistory) > 10) {
            array_shift($conversationHistory);
            session()->put('conversation_history', $conversationHistory); // Update session after limiting history
        }

        // Log the conversation history and bot response
        Log::info('Conversation History:', $conversationHistory);


        // Return the bot's response as JSON
        return response()->json($response);
    }

}
