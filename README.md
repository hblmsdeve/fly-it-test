## Première étape
Exécutez: composer install

### SVP Veuiller specifie les info de base de donnes en file .ENV

### Ensuite, exécutez: php artisan migrate

### Puis exécutez: php artisan db:seed
#### pour créer un utilisateur par défaut.

##### Identifiants:
###### Email: test@example.com
###### Mot de passe: password

### Points de terminaison:

POST /login - Authentifier un utilisateur avec l'email et le mot de passe.

GET /api/users - Récupérer tous les utilisateurs.
POST /api/users - Créer un nouvel utilisateur.
GET /api/users/{id} - Récupérer un utilisateur spécifique.
PUT /api/users/{id} - Mettre à jour un utilisateur spécifique.
DELETE /api/users/{id} - Supprimer un utilisateur spécifique.
