<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Concept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with aggregated statistics for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        // ----------------------------------------------------------------
        // 1. Total Concepts Count
        // ----------------------------------------------------------------
        // Counts all non-trashed concepts across all domains owned by the user.
        $totalConcepts = Concept::query()
            ->whereIn('domain_id', $user->domains()->pluck('id'))
            ->count();

        // ----------------------------------------------------------------
        // 2. Status Breakdown (to_review, in_progress, mastered)
        // ----------------------------------------------------------------
        // Single query with GROUP BY status for optimal performance (no N+1).
        $statusCounts = Concept::query()
            ->whereIn('domain_id', $user->domains()->pluck('id'))
            ->selectRaw("COUNT(*) as count")
            ->addSelect('status')
            ->groupBy('status')
            ->pluck('count', 'status');

        $toReviewCount   = $statusCounts['to_review'] ?? 0;
        $inProgressCount = $statusCounts['in_progress'] ?? 0;
        $masteredCount   = $statusCounts['mastered'] ?? 0;

        // ----------------------------------------------------------------
        // 3. Overall Mastery Percentage
        // ----------------------------------------------------------------
        $masteryPercentage = $totalConcepts > 0
            ? round(($masteredCount / $totalConcepts) * 100)
            : 0;

        // ----------------------------------------------------------------
        // 4. Strongest Domain (highest mastered concept count)
        // ----------------------------------------------------------------
        $strongestDomain = Domain::query()
            ->where('user_id', $user->id)
            ->withCount(['concepts as mastered_count' => function ($q) {
                $q->where('status', 'mastered');
            }])
            ->having('mastered_count', '>', 0)
            ->orderByDesc('mastered_count')
            ->first();

        // ----------------------------------------------------------------
        // 5. Focus Needed Domain (highest to_review concept count)
        // ----------------------------------------------------------------
        $focusDomain = Domain::query()
            ->where('user_id', $user->id)
            ->withCount(['concepts as review_count' => function ($q) {
                $q->where('status', 'to_review');
            }])
            ->having('review_count', '>', 0)
            ->orderByDesc('review_count')
            ->first();

        // ----------------------------------------------------------------
        // 6. Recent Concepts (5 most recently updated, eager load domain)
        // ----------------------------------------------------------------
        $recentConcepts = Concept::query()
            ->whereIn('domain_id', $user->domains()->pluck('id'))
            ->with('domain')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalConcepts',
            'toReviewCount',
            'inProgressCount',
            'masteredCount',
            'masteryPercentage',
            'strongestDomain',
            'focusDomain',
            'recentConcepts',
        ));
    }
}
