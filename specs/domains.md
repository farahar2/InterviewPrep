# Gestion des domaines

## Modèle de données

### Domain

| Champ | Type | Description |
|-------|------|-------------|
| id | bigInteger | Clé primaire |
| user_id | bigInteger | Relation vers User |
| name | string(255) | Nom du domaine (ex: "Laravel ORM") |
| color | string(7) | Couleur hexadécimale (ex: "#3B82F6") |
| created_at | timestamp | Date de création |
| updated_at | timestamp | Date de mise à jour |

### Relations

- **Domain** belongsTo **User**
- **Domain** hasMany **Concept**

## Routes

| Méthode | URI | Contrôleur | Méthode | Description |
|---------|-----|------------|---------|-------------|
| GET | /domains | DomainController | index | Liste des domaines avec stats |
| GET | /domains/create | DomainController | create | Formulaire de création |
| POST | /domains | DomainController | store | Créer un domaine |
| GET | /domains/{domain} | DomainController | show | Détail d'un domaine |
| GET | /domains/{domain}/edit | DomainController | edit | Formulaire d'édition |
| PUT/PATCH | /domains/{domain} | DomainController | update | Mettre à jour un domaine |
| DELETE | /domains/{domain} | DomainController | destroy | Supprimer un domaine |

## Fonctionnalités

### 1. Lister les domaines

- Afficher tous les domaines de l'utilisateur connecté
- Pour chaque domaine, afficher : nom, couleur, badge avec stats (X maîtrisés / Y total)
- Tri par date de création (plus récent en premier)

### 2. Créer un domaine

- Formulaire avec :
  - Nom (required, max:255)
  - Couleur (required, format hex #XXXXXX)
- Redirection vers la liste après création

### 3. Modifier un domaine

- Formulaire pré-rempli avec les données existantes
- Mêmes validations que la création

### 4. Supprimer un domaine

- Confirmation avant suppression
- Suppression en cascade des concepts associés
- Redirection vers la liste après suppression

## Validation (Request)

### DomainRequest

```php
rules: [
    'name' => ['required', 'string', 'max:255'],
    'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
]
```

## UI/UX

- Couleur affichée comme badge rond
- Stats affichées sous forme "X/Y maîtrisés"
- Boutons d'action : créer (bleu), modifier (orange), supprimer (rouge)
- Messages flash pour les actions réussie