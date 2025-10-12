{ "info": { "name": "Tech Store API Full Complete", "_postman_id": "a1b2c3d4-e5f6-7890-abcd-1234567890ef", "description": "Postman Collection كامل لكل Endpoints متجر إلكتروني يشمل جميع الموارد الأساسية والثانوية.", "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json" }, "item": [ {"name": "Auth", "item": [ {"name": "Register", "request": {"method": "POST", "header": [{"key": "Content-Type", "value": "application/json"}], "body": {"mode": "raw", "raw": "{"name": "Akram", "email": "akram@example.com", "password": "secret123"}"}, "url": {"raw": "{{baseUrl}}/api/register", "host": ["{{baseUrl}}"], "path": ["api", "register"]}}}, {"name": "Login", "request": {"method": "POST", "header": [{"key": "Content-Type", "value": "application/json"}], "body": {"mode": "raw", "raw": "{"email": "akram@example.com", "password": "secret123"}"}, "url": {"raw": "{{baseUrl}}/api/login", "host": ["{{baseUrl}}"], "path": ["api", "login"]}}} ]},

{"name": "Users", "item": [
    {"name": "Get Users", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/users", "host": ["{{baseUrl}}"], "path": ["api", "users"]}}},
    {"name": "Create User", "request": {"method": "POST", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}, {"key": "Content-Type", "value": "application/json"}], "body": {"mode": "raw", "raw": "{\"name\": \"UserName\", \"email\": \"user@example.com\", \"password\": \"12345678\"}"}, "url": {"raw": "{{baseUrl}}/api/users", "host": ["{{baseUrl}}"], "path": ["api", "users"]}}}
]},

{"name": "Products", "item": [
    {"name": "Get Products", "request": {"method": "GET", "url": {"raw": "{{baseUrl}}/api/products", "host": ["{{baseUrl}}"], "path": ["api", "products"]}}},
    {"name": "Create Product", "request": {"method": "POST", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}, {"key": "Content-Type", "value": "application/json"}], "body": {"mode": "raw", "raw": "{\"name\": \"Product1\", \"price\": 99.99, \"stock\": 50}"}, "url": {"raw": "{{baseUrl}}/api/products", "host": ["{{baseUrl}}"], "path": ["api", "products"]}}}
]},

{"name": "Notifications", "item": [
    {"name": "Get All Notifications", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/notifications", "host": ["{{baseUrl}}"], "path": ["api", "notifications"]}}},
    {"name": "Get Unread Notifications", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/notifications/unread", "host": ["{{baseUrl}}"], "path": ["api", "notifications", "unread"]}}}
]},

{"name": "Sliders", "item": [
    {"name": "Get Sliders", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/sliders", "host": ["{{baseUrl}}"], "path": ["api", "sliders"]}}}
]},

{"name": "Orders", "item": [
    {"name": "Get Orders", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/orders", "host": ["{{baseUrl}}"], "path": ["api", "orders"]}}}
]},

{"name": "Payments", "item": [
    {"name": "Get Payments", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/payments", "host": ["{{baseUrl}}"], "path": ["api", "payments"]}}}
]},

{"name": "Reviews", "item": [
    {"name": "Get Reviews", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/reviews", "host": ["{{baseUrl}}"], "path": ["api", "reviews"]}}}
]},

{"name": "Cart", "item": [
    {"name": "Get Cart Items", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/cart", "host": ["{{baseUrl}}"], "path": ["api", "cart"]}}}
]},

{"name": "Vendors", "item": [
    {"name": "Get Vendors", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/vendors", "host": ["{{baseUrl}}"], "path": ["api", "vendors"]}}}
]},

{"name": "Coupons", "item": [
    {"name": "Get Coupons", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/coupons", "host": ["{{baseUrl}}"], "path": ["api", "coupons"]}}}
]},

{"name": "Tags", "item": [
    {"name": "Get Tags", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/tags", "host": ["{{baseUrl}}"], "path": ["api", "tags"]}}}
]},

{"name": "Messages", "item": [
    {"name": "Get Messages", "request": {"method": "GET", "header": [{"key": "Authorization", "value": "Bearer {{token}}"}], "url": {"raw": "{{baseUrl}}/api/messages", "host": ["{{baseUrl}}"], "path": ["api", "messages"]}}}
]}

],

"variable": [ {"key": "baseUrl", "value": "http://localhost:8000"}, {"key": "token", "value": ""} ] }

