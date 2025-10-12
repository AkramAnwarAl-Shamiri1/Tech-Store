# Laravel Capstone API Documentation

**Framework:** Laravel 12 + Sanctum  
**Version:** v1.0  

> **Note:** All endpoints that require authentication use `auth:sanctum`, and the token must be sent in the header:
> ```
> Authorization: Bearer {token}
> ```

---

## 1. Authentication

### Register a New User
- **POST** `/api/register`  
- **Auth:** No  
- **Body:** `name, email, password`  
- **Response:** `user object + token`  

### Login
- **POST** `/api/login`  
- **Auth:** No  
- **Body:** `email, password`  
- **Response:** `user object + token`  

### User Dashboard
- **GET** `/api/dashboard`  
- **Auth:** Yes  
- **Headers:** `Authorization: Bearer {token}`  
- **Response:** User data + statistics

---

## 2. Users
- **apiResource('users')**  
- **Auth required**  
- Endpoints:
  - `GET /api/users`  
  - `POST /api/users`  
  - `GET /api/users/{id}`  
  - `PUT /api/users/{id}`  
  - `DELETE /api/users/{id}`

---

## 3. Products
- `GET /api/products` → All products (public)  
- `GET /api/products/{product}` → Single product (public)  
- `POST /api/products` → Create product (Auth required)  
- `PUT /api/products/{product}` → Update product (Auth required)  
- `DELETE /api/products/{product}` → Delete product (Auth required)  
- **apiResource('products')** includes all the above operations  

---

## 4. Sliders
- **apiResource('sliders')**  
- **Auth required**

---

## 5. Notifications
- `GET /api/notifications` → All notifications  
- `GET /api/notifications/unread` → Unread notifications  
- `POST /api/notifications/{id}/read` → Mark as read  
- `POST /api/notifications/read-all` → Mark all as read

---

## 6. Stats
- `GET /api/stats` → System statistics  
- **Auth required**

---

## 7. Other Resources
- **Auth required**:
  - Roles, Categories, Addresses, Shipping Methods, Payment Methods  
  - Orders, Order Items, Order Status History, Reviews, Coupons  
  - Payments, Wishlists, Transactions, Vendors, Product Images  
  - Cart Items, Stock Histories, Activity Logs, Messages, Photos  
  - Product Tags, Settings, Tags, Cart, Order Coupons, Files

---

## 8. HTTP Status Codes
- **Success:** 200 OK, 201 Created, 204 No Content  
- **Errors:** 400 Bad Request, 401 Unauthorized, 403 Forbidden  
- 404 Not Found, 422 Unprocessable Entity, 500 Internal Server Error

---

## 9. General Notes
- All requests are in **JSON** format  
- File uploads use **multipart/form-data**  
- Search, filter, and sort via query params:
  - `q`, `sort`, `order`, `page`, `per_page`  
- Authentication for required endpoints via **Bearer Token**  
- Use versioned API paths like `/api/v1/...`  
- Standardize responses using **Resource Classes**  
- Use **Soft Deletes** for sensitive resources  
- Track important operations using **Activity Logs**
