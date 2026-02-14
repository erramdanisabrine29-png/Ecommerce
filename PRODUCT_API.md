# Product Management API Documentation

## Overview
Complete product management system with stock control, sales statistics, and security.

---

## Authentication
All endpoints require:
- `Authorization: Bearer {token}` (if using API tokens)
- User must be authenticated with `Merchant` or `Administrator` role
- User can only access products from stores they own

---

## Endpoints

### List Products by Store
```
GET /api/stores/{store}/products
```
**Parameters:** `page`, `per_page`
**Response:** Paginated list of products

**Example:**
```bash
curl -X GET "http://localhost:8000/api/stores/1/products?page=1" \
  -H "Authorization: Bearer token"
```

---

### Create Product
```
POST /api/stores/{store}/products
```
**Body:**
```json
{
  "name": "Product Name",
  "description": "Product description",
  "price_ht": 100.00,
  "tax_rate": 19.6,
  "stock": 50,
  "security_threshold": 10,
  "characteristics": {
    "color": "red",
    "size": "M"
  },
  "images": [
    "https://example.com/image1.jpg",
    "https://example.com/image2.jpg"
  ]
}
```

**Response:** `201 Created`
```json
{
  "message": "Product created successfully",
  "data": { ...product... }
}
```

---

### Get Product Details
```
GET /api/products/{product}
```

**Response:** `200 OK`
```json
{
  "id": 1,
  "name": "Product Name",
  "description": "Description",
  "price_ht": 100.00,
  "tax_rate": 19.6,
  "stock": 50,
  "security_threshold": 10,
  "characteristics": {...},
  "images": [...],
  "sales_statistics": {...},
  "store_id": 1,
  "created_at": "2026-02-13T00:00:00Z",
  "updated_at": "2026-02-13T00:00:00Z"
}
```

---

### Update Product
```
PUT /api/products/{product}
```
**Body:** Same as Create Product
**Response:** `200 OK`

---

### Delete Product
```
DELETE /api/products/{product}
```
**Response:** `200 OK`
```json
{
  "message": "Product deleted successfully"
}
```

---

## Stock Management

### Decrement Stock
```
POST /api/products/{product}/decrement-stock
```
**Body:**
```json
{
  "quantity": 5
}
```

**Response:** `200 OK`
```json
{
  "message": "Stock decremented successfully",
  "product": {...},
  "is_low_stock": false
}
```

**Error:** `400 Bad Request` (insufficient stock)
```json
{
  "error": "Insufficient stock",
  "available": 3,
  "requested": 5
}
```

---

### Increment Stock
```
POST /api/products/{product}/increment-stock
```
**Body:**
```json
{
  "quantity": 10
}
```

**Response:** `200 OK`
```json
{
  "message": "Stock incremented successfully",
  "product": {...}
}
```

---

### Get Low Stock Products
```
GET /api/stores/{store}/products/low-stock
```

**Response:** `200 OK`
```json
{
  "store_id": 1,
  "low_stock_count": 3,
  "products": [
    {
      "id": 5,
      "name": "Product A",
      "stock": 5,
      "security_threshold": 10
    },
    ...
  ]
}
```

---

## Sales & Statistics

### Get Product Statistics
```
GET /api/products/{product}/stats
```

**Response:** `200 OK`
```json
{
  "product_id": 1,
  "name": "Product Name",
  "stock": 50,
  "is_low_stock": false,
  "price_ht": 100.00,
  "price_ttc": 119.60,
  "tax_amount": 19.60,
  "statistics": {
    "total_sold": 150,
    "total_revenue": 17940.00,
    "total_views": 2500,
    "sales_count": 150,
    "conversion_rate": 6.0,
    "average_sale_price": 119.60
  }
}
```

---

### Record Product View
```
POST /api/products/{product}/record-view
```

**Response:** `200 OK`
```json
{
  "message": "View recorded",
  "views": 2501
}
```

---

## Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated"
}
```

### 403 Forbidden
```json
{
  "error": "Unauthorized"
}
```

### 404 Not Found
```json
{
  "message": "Not found"
}
```

### 422 Validation Error
```json
{
  "message": "Validation failed",
  "errors": {
    "name": ["The name field is required"],
    "price_ht": ["The price_ht must be numeric"]
  }
}
```

---

## Validation Rules

```php
[
    'name' => 'required|string|max:255',
    'description' => 'nullable|string|max:1000',
    'price_ht' => 'required|numeric|min:0.01',
    'tax_rate' => 'required|numeric|min:0|max:100',
    'stock' => 'required|integer|min:0',
    'security_threshold' => 'required|integer|min:0',
    'characteristics' => 'nullable|array',
    'images' => 'nullable|array',
]
```

---

## Examples

### Create product with curl
```bash
curl -X POST http://localhost:8000/api/stores/1/products \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer token" \
  -d '{
    "name": "Blue T-Shirt",
    "description": "Comfortable cotton t-shirt",
    "price_ht": 25.00,
    "tax_rate": 19.6,
    "stock": 100,
    "security_threshold": 20,
    "characteristics": {
      "color": "blue",
      "size": "M",
      "material": "cotton"
    },
    "images": ["https://example.com/shirt.jpg"]
  }'
```

### Decrement stock with curl
```bash
curl -X POST http://localhost:8000/api/products/1/decrement-stock \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer token" \
  -d '{"quantity": 5}'
```

### Get statistics with curl
```bash
curl -X GET http://localhost:8000/api/products/1/stats \
  -H "Authorization: Bearer token"
```

---

## Low Stock Alert System

Products are marked as **low stock** when:
```
stock <= security_threshold
```

Get all low stock products for a store:
```
GET /api/stores/{store}/products/low-stock
```

This endpoint automatically identifies and returns all products below their threshold.

---

## Database Performance Optimizations

- **Indexes on:** `store_id`, `stock`, `created_at`
- **Full-text search:** On `name` and `description` fields
- **Soft deletes:** For data integrity
- **JSON columns:** For flexible characteristics and images storage

---

## Security

✓ Merchant can only access their own products  
✓ All stock operations are atomic  
✓ Sales statistics are automatically tracked  
✓ Role-based access control  
✓ Validation on all inputs

