# RESTful API Reference

Apex E-Commerce Platform provides a complete JSON REST API for integrating mobile apps and third-party services.

## Authentication
Authentication is managed via Laravel Sanctum bearer tokens.

### Endpoints

#### `POST /api/register`
- **Payload**: `name`, `email`, `password`
- **Response**: User object and `access_token`.

#### `POST /api/login`
- **Payload**: `email`, `password`
- **Response**: User object and `access_token`.

#### `POST /api/logout` (Auth required)
- Revokes current access token.

---

## Products API

#### `GET /api/products`
Query parameters:
- `category_id`: Filter by category ID
- `brand_id`: Filter by brand ID
- `featured`: Filter featured items only (`1` / `0`)
- `search`: Search product title
- `per_page`: Number of results per page (default: 15)

#### `GET /api/products/{id}`
Returns product details, images, average rating, and customer reviews.

---

## Categories API

#### `GET /api/categories`
Returns all active categories.

#### `GET /api/categories/{id}`
Returns category details.
