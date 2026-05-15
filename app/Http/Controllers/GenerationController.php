<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Generation;
use App\Services\GroqService;
use Illuminate\Support\Facades\Log;

class GenerationController extends Controller
{
    public function store(Concept $concept, GroqService $groqService)
    {
        $this->authorize('view', $concept);

        try {
            $questions = $groqService->generateQuestions(
                $concept->title,
                $concept->explanation
            );

            $concept->generations()->create([
                'questions' => $questions,
            ]);

            return redirect()
                ->route('concepts.show', $concept)
                ->with('success', '5 interview questions generated successfully!');
        } catch (\Exception $e) {
            Log::error('Question generation failed: ' . $e->getMessage());

            return redirect()
                ->route('concepts.show', $concept)
                ->with('error', 'Failed to generate questions. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Generation $generation)
    {
        $concept = $generation->concept;

        $this->authorize('view', $concept);

        $generation->delete();

        return redirect()
            ->route('concepts.show', $concept)
            ->with('success', 'Question set deleted successfully!');
    }
}
