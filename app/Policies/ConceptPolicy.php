<?php

namespace App\Policies;

use App\Models\Concept;
use App\Models\User;

class ConceptPolicy
{
    /**
     * Determine if the user can view any concepts
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the concept
     * User can view concept if they own the parent domain
     */
    public function view(User $user, Concept $concept): bool
    {
        return $user->id === $concept->domain->user_id;
    }

    /**
     * Determine if the user can create concepts
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update the concept
     */
    public function update(User $user, Concept $concept): bool
    {
        return $user->id === $concept->domain->user_id;
    }

    /**
     * Determine if the user can delete the concept
     */
    public function delete(User $user, Concept $concept): bool
    {
        return $user->id === $concept->domain->user_id;
    }

    /**
     * Determine if the user can restore the concept
     */
    public function restore(User $user, Concept $concept): bool
    {
        return $user->id === $concept->domain->user_id;
    }

    /**
     * Determine if the user can permanently delete the concept
     */
    public function forceDelete(User $user, Concept $concept): bool
    {
        return $user->id === $concept->domain->user_id;
    }
}