# Tech Store Project Documentation — E-Commerce Management & Order Tracking System

**Author:** Akram Anwar Al-Shamiri  
**Version:** v1.0  
**Framework:** Laravel 12 (PHP 8.2) + Vue 3 + TailwindCSS + Vite  
**Date Created:** Auto-generated  

---

## 1. Overview
**Tech Store** is a full-featured web application for managing an e-commerce store. It provides an admin dashboard to add/edit products, manage orders, handle Stripe payments, and track order statuses through a historical log.  
The system supports role-based access control (Roles & Policies), shopping carts, coupons, and real-time user notifications.

---

## 2. Technologies Used
- **Backend:** Laravel 12, PHP 8.2, Laravel Sanctum (API authentication), Stripe PHP SDK  
- **Frontend:** Vue 3, Pinia, Vue Router, Alpine.js  
- **Design:** Tailwind CSS, Heroicons, FontAwesome  
- **Build Tools:** Vite, laravel-vite-plugin, PostCSS, Autoprefixer  
- **Libraries:** Axios, Chart.js, vue-chartjs, Leaflet, vue3-leaflet  
- **Data Generation:** Factories & Seeders (Faker)  
- **Testing:** PHPUnit, Mockery  

---

## 3. Project Structure (Summary)
- `app/Models` — All models (21 models)  
- `app/Http/Controllers` — Controllers (21 controllers)  
- `app/Policies` — Access control policies for each model/controller  
- `database/migrations` — Migration files for database tables  
- `database/factories` — Factories for generating test data  
- `database/seeders` — Seeders for populating essential data  
- `routes/api.php` — API route definitions  
- `resources/js` — Vue components and frontend logic  
- `storage/logs` — System logs  

---

## 4. Main Models & Relationships (Summary)
> 21 models in total. Only main relationships are listed.

1. **User** — `role` (belongsTo), `orders` (hasMany), `cart` (hasOne), `addresses`, `reviews`, `wishlists`  
2. **Role** — `users` (hasMany)  
3. **RoleUser** — `user`, `role`  
4. **Product** — `category` (belongsTo), `user` (belongsTo), `files` (morphMany), `orderItems`, `productTags`  
5. **ProductTag** — `product`  
6. **Category** — `products`  
7. **Cart** — `user`, `items` (hasMany CartItem)  
8. **CartItem** — `cart`, `product`  
9. **Order** — `user`, `orderItems`, `payments`, `statusHistory`, `orderCoupons`, `shippingMethod`, `paymentMethod`  
10. **OrderItem** — `order`, `product`  
11. **OrderStatusHistory** — `order` (tracks order status history)  
12. **Payment** — `order`, `paymentMethod`  
13. **PaymentMethod** — `payments` (hasMany)  
14. **Coupon** — linked through `OrderCoupon`  
15. **OrderCoupon** — `order`, `coupon`  
16. **File** — `fileable` (morphTo), `uploader` (belongsTo User)  
17. **Notification** — `user`  
18. **ShippingMethod** — `orders`  
19. **Slider** — `files` (morphMany)  
20. **PersonalAccessToken** — used for Sanctum authentication tokens  
21. **Session** — stores user sessions (optional / adapter)  

---

## 📘 API Documentation
All API endpoints are documented in a separate file:  
(./API_DOCUMENTATION.md)
(./API_POSTMAN.md)

---

## 6. Policies
Each main model has its own Policy class to manage access control logic.  

**Common rules include:**
- **ProductPolicy:** Only vendor owner or Admin can update/delete; everyone can view.  
- **OrderPolicy:** Users can view their own orders; Admins can view all; only Admins can delete.  
- **CartPolicy:** Owners can update their cart; Admins can view all carts if allowed.  
- **PaymentPolicy:** Only Admin/Support can modify payment records.  

Policies are located in `app/Policies`.

---

## 7. Events & Listeners
- **PaymentCompleted(Order $order)** — Triggered when a payment succeeds; listeners may send notifications, update stock, and create a “processing” status record.  
- **OrderShipped(Order $order)** — Updates the order status and notifies the user.  
- **OrderDelivered(Order $order)** — Marks the order as completed.  
- **OrderCancelled(Order $order)** — Logs the cancellation and informs the user.  

---

## 8. Migrations, Factories, and Seeders (Summary)
- **Migrations:** `database/migrations/*.php` — defines tables: users, roles, products, categories, carts, cart_items, orders, order_items, payments, payment_methods, coupons, order_coupons, files, notifications, shipping_methods, sliders, personal_access_tokens, sessions, etc.  
- **Factories:** `database/factories/*Factory.php` (UserFactory, ProductFactory, OrderFactory, etc.)  
- **Seeders:** `database/seeders/DatabaseSeeder.php` calls RoleSeeder, UserSeeder, ProductSeeder, OrderSeeder  
- **Tip:** Reset and seed test data:  
```bash
php artisan migrate:fresh --seed


## 9. Setup & Running the Project

### System Requirements
- PHP >= 8.2, Composer, Node.js, npm, MySQL/SQLite

### Quick Local Setup
```bash
# Clone the repository
git clone <repo-url>
cd tech-store

# Install dependencies
composer install
npm install

# Create .env file and configure settings (DB, STRIPE_KEY, MAIL, etc.)
cp .env.example .env
php artisan key:generate

# Run migrations and seed data
php artisan migrate --seed

# Start frontend and backend servers
npm run dev     # Vite server
php artisan serve   # Laravel server

```
### Useful Commands
- Run tests: `php artisan test`
- Run queue listeners: `php artisan queue:work` (or via `composer dev` for concurrent commands)
- Rebuild assets: `npm run build`

---

## 10. Example Requests / Responses

### Register a New User
**Request** `POST /api/register`
```json
{
  "name": "Akram Al-Shamiri",
  "email": "akram@example.com",
  "password": "secret123"
}

```
**Response** `201 Created`
```json
{ "message":"تم إنشاء الحساب بنجاح. الرجاء تسجيل الدخول." }
```

### تسجيل الدخول
**Request** `POST /api/login`
```json
{ "email":"akram@example.com", "password":"secret123" }
```
**Response**
```json
{
  "user": { "id":1, "name":"أكرم الشميري", "email":"akram@example.com" },
  "token": "plain-text-token-value"
}
```

### إضافة منتج للسلة
**Request** `POST /api/cart_items` (Auth)
```json
{ "product_id": 12, "quantity": 2 }
```
**Response** `201`
```json
{ "message":"Product Name added to cart!", "data": { "id": 55, "product": {...}, "quantity": 2 } }
```

---
## 11. Trainer Guide
This section is intended for the trainer who will teach developers/users how to use the system.

### Suggested Training Session (2–3 hours)
1. **Introduction (15 min)**
   - Explain the system goals, core components, and technologies used.
2. **Environment Setup (20 min)**
   - Demonstrate `composer install`, `npm install`, configure `.env`, and run migrations.
3. **Hands-on Practice (60 min)**
   - Create a user, add products via Admin interface or curl/Postman, create a cart and order.
   - Track order statuses (Pending → Processing → Shipped → Delivered) using `OrderStatusHistory`.
4. **Stripe Payments (20 min)**
   - Explain the Stripe payment flow, PaymentIntent, and how the application handles webhooks or intents.
5. **Quick Testing (15 min)**
   - How to run PHPUnit, read results, and understand logs.
6. **Maintenance & Expansion (20 min)**
   - How to add a new model, create migration, factory, seeder, policy, and controller.
7. **Q&A / Practice (10–15 min)**

### Files & References
- `README.md` (this file)
- Postman collection (recommended) — includes all endpoints with examples
- ERD (suggested: generate using MySQL Workbench or draw.io)
- List of Artisan commands used during training

---

## 12. Security & Best Practices
- Keep Stripe keys and `.env` secrets out of the repository.
- Use HTTPS in production.
- Review Policies carefully, especially for sensitive operations (deleting payments, changing order status).
- Do not store secrets in logs.
- Add rate-limiting if necessary (`throttle` middleware).

---
## 13. Converting the Documentation to PDF
You can convert this Markdown file to PDF using several methods:
- **Using VSCode:** Open the file, then print it to PDF.
- **Using Pandoc:** `pandoc TechStore_Documentation.md -o TechStore_Documentation.pdf`
- **Using Online Tools or Typora.**

---

**End of Core Documentation — Tech Store**
