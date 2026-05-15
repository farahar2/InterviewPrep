<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GroqService
{
    /**
     * Groq API endpoint
     */
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

    /**
     * API Key from .env
     */
    private string $apiKey;

    /**
     * Model to use
     */
  private string $model = 'llama-3.3-70b-versatile';

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        
        if (empty($this->apiKey)) {
            throw new Exception('Groq API key is not configured. Please add GROQ_API_KEY to your .env file.');
        }
    }

    /**
     * Generate interview questions based on concept
     *
     * @param string $title Concept title
     * @param string $explanation Concept explanation
     * @return array Array of 5 questions
     * @throws Exception
     */
    public function generateQuestions(string $title, string $explanation): array
    {
        try {
            // Build the prompt
            $prompt = $this->buildPrompt($title, $explanation);

            // Call Groq API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30) // 30 seconds timeout
            ->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert technical interviewer. Generate realistic, specific interview questions based on the provided concept. Questions should be clear, relevant, and progressively challenging.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

            // Check if request was successful
            if (!$response->successful()) {
                throw new Exception('Groq API returned error: ' . $response->body());
            }

            // Parse response
            $data = $response->json();
            
            if (!isset($data['choices'][0]['message']['content'])) {
                throw new Exception('Invalid response format from Groq API');
            }

            // Extract and parse questions
            $content = $data['choices'][0]['message']['content'];
            $questions = $this->parseQuestions($content);

            // Validate we got 5 questions
            if (count($questions) < 5) {
                throw new Exception('Failed to generate 5 questions. Got: ' . count($questions));
            }

            return array_slice($questions, 0, 5); // Return exactly 5 questions

        } catch (Exception $e) {
            // Log the error
            Log::error('Groq API Error: ' . $e->getMessage());
            
            // Re-throw for controller to handle
            throw $e;
        }
    }

    /**
     * Build the prompt for question generation
     */
    private function buildPrompt(string $title, string $explanation): string
    {
        return <<<PROMPT
Generate exactly 5 technical interview questions about the following concept:

**Concept Title:** {$title}

**Explanation:**
{$explanation}

Requirements:
- Generate EXACTLY 5 questions
- Each question should be on a new line
- Number each question (1., 2., 3., 4., 5.)
- Questions should be realistic and asked in actual technical interviews
- Progress from basic understanding to advanced application
- Be specific to this concept, not generic questions
- No introductory text, just the 5 numbered questions

Format:
1. [First question]
2. [Second question]
3. [Third question]
4. [Fourth question]
5. [Fifth question]
PROMPT;
    }

    /**
     * Parse questions from API response
     */
    private function parseQuestions(string $content): array
    {
        $questions = [];
        
        // Split by lines
        $lines = explode("\n", $content);
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // Match lines that start with number followed by dot or parenthesis
            if (preg_match('/^(\d+)[\.\)]\s*(.+)$/', $line, $matches)) {
                $questions[] = trim($matches[2]);
            }
        }
        
        return $questions;
    }

    /**
     * Test API connection
     */
    public function testConnection(): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get('https://api.groq.com/openai/v1/models');

            return $response->successful();
        } catch (Exception $e) {
            return false;
        }
    }
}