# Project Setup Instructions

## Getting Started

### Clone the Repository

First, clone the repository to your local machine:

```git clone <repository-url>```

### Build and Start Containers

Run the following command to build and start the Docker containers. This command also detaches the containers, allowing
them to run in the background:

```docker-compose up --build -d```

**Note:** If you encounter any port conflicts, adjust the port settings in the `docker-compose.yml` file accordingly.

## Running Tests

To run tests, execute the following command from within the `alex_weroad_app` Docker container:

```vendor/bin/phpunit;```

## Database Seeding

The database is seeded using provided JSON files, creating two users with distinct roles: an admin and an editor. Use
the following credentials for both:

- Admin: `admin@weroad.com` (password: `admin@weroad.com`)
- Editor: `editor@weroad.com` (password: `editor@weroad.com`)

To seed the database, run:
```php artisan app:seed-from-json```


## Implementation Details

- A simple role relationship is implemented, alongside a more complex relationship showcasing moods.
- Database seeding is accomplished using custom JSON files.
- A role policy has been integrated with a `CheckRole` middleware for authorization.
- Validation is handled by custom `FormRequest` classes for each action, ensuring robust data integrity.
- Controllers and models are designed to be slim, with controllers validating input and services handling business logic.
- Data retrieval is performed by services, which leverage various models and parse the output using Resource classes.
- A caching mechanism is implemented for public endpoints, invalidated upon creation or editing events. This feature is designed for further refinement.

## Documentation and Testing

- Public tour endpoints are documented and accessible via Swagger at: http://localhost:8082/
- Additional endpoints can be tested using the HTTP request files located in the `http-request` folder, compatible with both PhpStorm and VS Code HTTP clients.

