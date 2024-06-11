| Element          | Status |
| ---------------- | ------ |
| Fixtures         | ✅     |
| Authentification | ✅     |
| Features         | ✅     |

## Comment tester l'API ?

### 1. Au préalable

- `git clone`
- `composer install`
- Configurer `DATABASE_URL` dans `.env`
- Créer la BDD avec la commande `symfony console doctrine:database:create` puis `symfony console doctrine:migrations:migrate`
- Ensuite lancer les fixtures : `symfony console doctrine:fixtures:load`
- `symfony serve`

### 2. Obtenir le JWT Token

- Générer les clés SSL : `symfony console lexik:jwt:generate-keypair`

- Ajouter dans le .env :

```php
###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=my_secure_passphrase
###< lexik/jwt-authentication-bundle ###
```

- Faire une Requête POST au Endpoint de Login : `http://localhost:8000/api/login_check`.

- À mettre dans le body JSON :

  ```json
  {
    "username": "user@example.com",
    "password": "password"
  }
  ```

### 3. Utiliser le JWT Token

- Inclure le token dans le Header : Par exemple, dans POSTMAN -> Go to `Headers` puis dans la partie `Key` ajouter "Authorization", puis dans la `Value` mettez y le token

Liste des Endpoints :

- POST /pokemon
- DELETE /pokemon/{id}
- GET /pokemon/{id}
- PUT /pokemon/{id}
- GET /pokemons
- GET /types
- POST /api/login_check
