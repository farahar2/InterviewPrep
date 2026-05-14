# AI Interview Questions Generation

## Modèle de données

### Generation

| Champ | Type | Description |
|-------|------|-------------|
| id | bigInteger | Clé primaire |
| concept_id | bigInteger | Relation vers Concept |
| questions | json | Tableau de 5 questions générées |
| created_at | timestamp | Date de génération |
| updated_at | timestamp | Date de mise à jour |

### Relations

- **Generation** belongsTo **Concept**
- **Concept** hasMany **Generation**

## API Configuration

### Groq API

- **Endpoint**: `https://api.groq.com/openai/v1/chat/completions`
- **Model**: `llama3-8b-8192` (rapide, gratuit, contexte 8192 tokens)
- **Auth**: Bearer token (API key dans .env)
- **Free tier**: 30 req/min, 14400 req/day

### Variables d'environnement (.env)

```env
GROQ_API_KEY=your_api_key_here
```

## Routes

| Méthode | URI | Contrôleur | Méthode | Description |
|---------|-----|------------|---------|-------------|
| POST | /concepts/{concept}/generate | AIGenerationController | generate | Génère 5 questions via Groq |

## Fonctionnalités

### 1. Génération de questions

**Déclenchement**: Bouton "Generate Questions" sur la page concept.show

**Processus**:
1. Envoi requête POST vers Groq API
2. Construction du prompt système + utilisateur
3. Réception JSON avec 5 questions
4. Stockage en base de données
5. Redirection vers concept.show avec questions affichées

**Prompt système**:
```
You are an expert technical interviewer. Generate 5 interview questions based on the given concept. Each question should:
1. Test understanding of the concept
2. Vary in difficulty (from basic to advanced)
3. Be concise and clear
4. Not include the answer

Respond with valid JSON only: {"questions": ["Q1", "Q2", "Q3", "Q4", "Q5"]}
```

**Prompt utilisateur**:
```
Concept: {title}
Explanation: {explanation}
Difficulty: {difficulty}
```

**Validation de la réponse**:
- Vérifier que la réponse est du JSON valide
- Vérifier que le tableau contient exactement 5 questions
- Chaque question doit être non vide et max 500 caractères

### 2. Historique des générations

- Afficher toutes les générations pour un concept
- Chaque génération affiche :
  - Date de création
  - Les 5 questions
  - Bouton de suppression

### 3. Suppression d'une génération

- Bouton trash sur chaque génération
- Suppression de l'entrée en base
- Redirection vers la page du concept

### 4. Gestion des erreurs

| Erreur | Message utilisateur | Action |
|--------|---------------------|--------|
| Timeout (>30s) | "Request timeout. Please try again." | Retry button |
| Rate limit (429) | "Too many requests. Please wait." | Show retry timer |
| Network error | "Connection error. Check your internet." | Retry button |
| Invalid API key | "API configuration error." | Log error, show message |
| Invalid response | "Failed to parse questions. Try again." | Retry button |
| Server error (500) | "Groq service error. Try later." | Retry button |

## Validation

### GenerateQuestionsRequest

```php
rules: [
    // No additional validation needed, concept is loaded from route
]
```

## Services

### GroqService

```php
class GroqService
{
    public function generateQuestions(string $title, string $explanation, string $difficulty): array;

    private function buildPrompt(string $title, string $explanation, string $difficulty): array;

    private function parseResponse(string $content): array;

    private function validateQuestions(array $questions): bool;
}
```

### Erreurs possibles

- `RequestException` - Erreur réseau/Groq
- `JsonException` - Réponse invalide
- `ValidationException` - Questions mal formées

## Contrôleur

### AIGenerationController

```php
class AIGenerationController extends Controller
{
    public function generate(Concept $concept): RedirectResponse;

    public function destroy(Generation $generation): RedirectResponse;
}
```

## Autorisations

- L'utilisateur doit être propriétaire du concept parent
- Vérification via Policy (ConceptPolicy)

## UI/UX

### Page concept.show

- Bouton "Generate Questions" (disabled pendant génération)
- Spinner pendant le chargement
- Liste des générations avec timestamp
- Bouton trash pour supprimer une génération

### États du bouton

| État | Apparence |
|------|-----------|
| Default | Bleu, icône robot + texte |
| Loading | Grisé, spinner, "Generating..." |
| Error | Rouge temporaire, message d'erreur |

## Sécurité

- API key stockée uniquement dans .env
- Jamais exposée dans le code ou les logs
- Rate limiting côté Groq respecté
- Validation de la réponse JSON avant stockage