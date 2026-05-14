<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Generation;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Exception;

class GenerationController extends Controller
{
    /**
     * Generate interview questions for a concept
     */
    public function store(Concept $concept, GroqService $groqService)
    {
        // Verify user owns this concept
        $this->authorize('view', $concept);

        try {
            // Generate questions using Groq API
            $questions = $groqService->generateQuestions(
                $concept->title,
                $concept->explanation
            );

            // Save generation to database
            $generation = $concept->generations()->create([
                'questions' => $questions,
            ]);

            return redirect()
                ->route('concepts.show', $concept)
                ->with('success', '5 interview questions generated successfully!');

        } catch (Exception $e) {
            // Log error and show user-friendly message
            \Log::error('Question generation failed: ' . $e->getMessage());

            return redirect()
                ->route('concepts.show', $concept)
                ->with('error', 'Failed to generate questions. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Delete a generation
     */
    public function destroy(Generation $generation)
    {
        $concept = $generation->concept;
        
        // Verify user owns this generation's concept
        $this->authorize('view', $concept);

        $generation->delete();

        return redirect()
            ->route('concepts.show', $concept)
            ->with('success', 'Question set deleted successfully!');
    }
}