# Symfony 6 JWT Auth

A basic RESTful API built with Symfony 6 framework, managing login/register with JWT

---

## Endpoints
- `POST /api/login`: Login with your credentials and get your token.
- `POST /api/register`: Register a new user.
- `GET /api/dashboard`: With your JWT, you can get access to the endpoint.
- `GET /api/dashborad/me`: With your JWT, you can see your user data.

## Installation and Setup
1. Clone the repository: `git clone [repository_url]`.
2. Navigate to the project directory: `cd project_directory`.
3. Install the dependencies: `composer install`.
4. Set up your environment variables in `.env` or `.env.local`.
5. Run the database migrations: `bin/console doctrine:migrations:migrate`.
6. Start the Symfony development server: `symfony server:start`.
