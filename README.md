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
- `symfony console doctrine:fixtures:load`
- `symfony serve`

### 2. Obtenir le JWT Token

- Faire une Requête POST au Endpoint de Login : `http://localhost:8000/api/login_check`.

- À mettre dans le body JSON :

  ```json
  {
    "username": "user@example.com",
    "password": "password"
  }
  ```

### 3. Utiliser le JWT Token

- Inclure la réponse dans le Header

Liste des Endpoints :

- POST /pokemon
- DELETE /pokemon/{id}
- GET /pokemon/{id}
- PUT /pokemon/{id}
- GET /pokemons
- GET /types
- POST /api/login_check
