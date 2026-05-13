# Concepts Management

## Data Model

### Concept

| Field | Type | Description |
|-------|------|-------------|
| id | bigInteger | Primary key |
| user_id | bigInteger | Relationship to User |
| domain_id | bigInteger | Relationship to Domain |
| title | string(255) | Concept title (e.g: "Eloquent N+1 Problem") |
| explanation | text | User's personal notes in text format |
| difficulty | enum | Difficulty level: junior / mid / senior |
| status | enum | Mastery status: to_review / in_progress / mastered |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update date |
| deleted_at | timestamp | Soft delete (nullable) |

### Difficulty Enum Values

- `junior` - Beginner level concept
- `mid` - Intermediate level concept
- `senior` - Advanced level concept

### Status Enum Values

- `to_review` - Needs review
- `in_progress` - Currently learning
- `mastered` - Fully mastered

### Relations

- **Concept** belongsTo **User**
- **Concept** belongsTo **Domain**
- **Concept** hasMany **QuestionSet** (AI-generated questions)
- **Concept** uses SoftDeletes trait

## Routes

| Method | URI | Controller | Action | Description |
|--------|-----|------------|--------|-------------|
| GET | /domains/{domain}/concepts | ConceptController | index | List concepts for domain |
| GET | /domains/{domain}/concepts/create | ConceptController | create | Creation form |
| POST | /domains/{domain}/concepts | ConceptController | store | Create new concept |
| GET | /concepts/{concept} | ConceptController | show | View concept detail |
| GET | /concepts/{concept}/edit | ConceptController | edit | Edit form |
| PUT/PATCH | /concepts/{concept} | ConceptController | update | Update concept |
| DELETE | /concepts/{concept} | ConceptController | destroy | Soft delete concept |
| PATCH | /concepts/{concept}/status | ConceptController | status | Quick status update (AJAX) |
| GET | /concepts/archived | ConceptController | archived | List archived concepts |
| POST | /concepts/{concept}/restore | ConceptController | restore | Restore archived concept |

## Features

### 1. List Concepts for Domain

- Display all concepts belonging to the selected domain
- Show for each concept: title, difficulty badge, status badge, created date
- **Filters by status**:
  - All (default)
  - To Review
  - In Progress
  - Mastered
- Filter via dropdown or tab buttons
- Sort by: created date (default), title, difficulty
- Display count of concepts matching current filter
- Link to create new concept button

### 2. Create a New Concept

- Form fields:
  - Title (required, max:255)
  - Explanation (required, textarea with rich text support optional)
  - Difficulty (required, select: junior/mid/senior)
  - Status (required, select: to_review/in_progress/mastered, default: to_review)
- Redirect to concept detail page after creation
- Flash message: "Concept created successfully"

### 3. View Concept Detail Page

- Display all concept fields:
  - Title (h1)
  - Domain breadcrumb link
  - Difficulty badge
  - Status badge
  - Full explanation content
  - Created/Updated dates
- **Display AI-generated questions** section:
  - List all QuestionSets linked to this concept
  - Each QuestionSet shows its questions
  - Button to generate new questions via AI
- Action buttons: Edit, Delete, Generate Questions

### 4. Edit a Concept

- Form pre-filled with existing data
- All fields editable:
  - Title (required, max:255)
  - Explanation (required, textarea)
  - Difficulty (required, select)
  - Status (required, select)
- Redirect back to concept detail after update
- Flash message: "Concept updated successfully"

### 5. Quick Status Change (AJAX)

- No page reload required
- Status can be changed from:
  - Concept list page
  - Concept detail page
- Endpoint: PATCH /concepts/{concept}/status
- Request body: `{ "status": "mastered" }`
- Response: JSON with updated concept data
- Update UI dynamically (badge color/text)
- Visual feedback on status change (brief highlight)

### 6. Delete a Concept

- Soft delete (not permanent)
- Confirmation dialog before deletion
- Redirect to domain concepts list after delete
- Flash message: "Concept archived successfully"

### 7. Soft Delete Support (Archive)

- **Archive functionality**:
  - Deleted concepts move to "archived" state
  - Permanently deleted concepts can still be restored within grace period (optional)
- **Archived Concepts List**:
  - Dedicated page at /concepts/archived
  - Display all soft-deleted concepts
  - Show: title, domain, deleted date
  - Filter by domain (optional)
- **Restore Concept**:
  - Button on archived list
  - Endpoint: POST /concepts/{concept}/restore
  - Redirect back to archived list
  - Flash message: "Concept restored successfully"
- **Permanent Delete**:
  - Optional: force delete from archived list
  - Confirmation required
  - This action is irreversible

## Validation (Request)

### StoreConceptRequest / UpdateConceptRequest

```php
rules: [
    'title' => ['required', 'string', 'max:255'],
    'explanation' => ['required', 'string'],
    'difficulty' => ['required', 'in:junior,mid,senior'],
    'status' => ['required', 'in:to_review,in_progress,mastered'],
]
```

### UpdateStatusRequest (AJAX)

```php
rules: [
    'status' => ['required', 'in:to_review,in_progress,mastered'],
]
```

## UI/UX

### Badges

- **Difficulty badges**:
  - junior: Green (#10B981)
  - mid: Yellow (#F59E0B)
  - senior: Red (#EF4444)
- **Status badges**:
  - to_review: Gray (#6B7280)
  - in_progress: Blue (#3B82F6)
  - mastered: Green (#10B981)

### Layout

- Breadcrumb navigation: Home > Domain > Concept
- Card-based list view for concepts
- Full-width detail view
- Responsive design for mobile

### Actions

- Create: Blue primary button
- Edit: Orange secondary button
- Delete/Archive: Red danger button
- Restore: Green success button
- Generate Questions: Purple accent button

### Flash Messages

- Success: Green background
- Error: Red background
- Auto-dismiss after 3 seconds

## Dependencies

- Related Domain must exist
- QuestionSet model for AI-generated questions
- Uses Laravel's SoftDeletes trait
- Policy/Authorization for ownership checks

## Edge Cases

- Empty concepts list: Show "No concepts yet" message with create CTA
- Empty archived list: Show "No archived concepts" message
- Invalid status value: Return 422 validation error
- Concept not found: Return 404 error
- Unauthorized access: Return 403 error (policy)
- Domain with concepts cannot be deleted: Prevent or cascade archive
