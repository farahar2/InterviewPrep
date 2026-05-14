# Domains Management

## Data Model

### Domain

| Field | Type | Description |
|-------|------|-------------|
| id | bigInteger | Primary key |
| user_id | bigInteger | Relationship to User |
| name | string(255) | Domain name (e.g: "Laravel ORM") |
| color | string(7) | Hexadecimal color (e.g: "#3B82F6") |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update date |

### Relations

- **Domain** belongsTo **User**
- **Domain** hasMany **Concept**

## Routes

| Method | URI | Controller | Action | Description |
|--------|-----|------------|--------|-------------|
| GET | /domains | DomainController | index | List domains with stats |
| GET | /domains/create | DomainController | create | Creation form |
| POST | /domains | DomainController | store | Create domain |
| GET | /domains/{domain} | DomainController | show | Domain detail |
| GET | /domains/{domain}/edit | DomainController | edit | Edit form |
| PUT/PATCH | /domains/{domain} | DomainController | update | Update domain |
| DELETE | /domains/{domain} | DomainController | destroy | Delete domain |

## Features

### 1. List Domains

- Display all domains for the authenticated user
- For each domain, show: name, color, badge with stats (X mastered / Y total)
- Sort by creation date (newest first)

### 2. Create Domain

- Form fields:
  - Name (required, max:255)
  - Color (required, hex format #XXXXXX)
- Redirect to list after creation

### 3. Edit Domain

- Form pre-filled with existing data
- Same validations as creation

### 4. Delete Domain

- Confirmation before deletion
- Cascade delete of associated concepts
- Redirect to list after deletion

## Validation (Request)

### DomainRequest

```php
rules: [
    'name' => ['required', 'string', 'max:255'],
    'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
]
```

## UI/UX

- Color displayed as a round badge
- Stats shown as "X/Y mastered"
- Action buttons: create (blue), edit (orange), delete (red)
- Flash messages for successful actions
