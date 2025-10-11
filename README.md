# Laravel Capstone API Documentation

**Framework:** Laravel 12 + Sanctum  
**Version:** v1.0  

> **Note:** جميع نقاط النهاية التي تتطلب مصادقة تستخدم `auth:sanctum` ويجب إرسال التوكن في الهيدر:
> ```
> Authorization: Bearer {token}
> ```

---

## 1. Authentication (المصادقة)

### تسجيل مستخدم جديد
- **POST** `/api/register`  
- **Auth:** لا  
- **Body:** `name, email, password`  
- **Response:** `user object + token`  

### تسجيل الدخول
- **POST** `/api/login`  
- **Auth:** لا  
- **Body:** `email, password`  
- **Response:** `user object + token`  

### لوحة المستخدم
- **GET** `/api/dashboard`  
- **Auth:** نعم  
- **Headers:** `Authorization: Bearer {token}`  
- **Response:** بيانات المستخدم + إحصائيات

---

## 2. Users (المستخدمون)
- **apiResource('users')**  
- **Auth required**  
- Endpoints:
  - `GET /api/users`  
  - `POST /api/users`  
  - `GET /api/users/{id}`  
  - `PUT /api/users/{id}`  
  - `DELETE /api/users/{id}`

---

## 3. Products (المنتجات)
- `GET /api/products` → جميع المنتجات (مفتوح)  
- `GET /api/products/{product}` → منتج محدد (مفتوح)  
- `POST /api/products` → إنشاء منتج (Auth required)  
- `PUT /api/products/{product}` → تعديل منتج (Auth required)  
- `DELETE /api/products/{product}` → حذف منتج (Auth required)  
- **apiResource('products')** يشمل كل العمليات السابقة  

---

## 4. Sliders
- **apiResource('sliders')**  
- **Auth required**

---

## 5. Notifications (الإشعارات)
- `GET /api/notifications` → جميع الإشعارات  
- `GET /api/notifications/unread` → غير مقروءة  
- `POST /api/notifications/{id}/read` → تعليم كمقروء  
- `POST /api/notifications/read-all` → تعليم كل الإشعارات كمقروءة

---

## 6. Stats (الإحصائيات)
- `GET /api/stats` → إحصائيات النظام  
- **Auth required**

---

## 7. Other Resources (الموارد الأخرى)
- **Auth required**:
  - Roles, Categories, Addresses, Shipping Methods, Payment Methods  
  - Orders, Order Items, Order Status History, Reviews, Coupons  
  - Payments, Wishlists, Transactions, Vendors, Product Images  
  - Cart Items, Stock Histories, Activity Logs, Messages, Photos  
  - Product Tags, Settings, Tags, Cart, Order Coupons, Files

---

## 8. HTTP Status Codes (رموز الحالة)
- **نجاح:** 200 OK, 201 Created, 204 No Content  
- **أخطاء:** 400 Bad Request, 401 Unauthorized, 403 Forbidden  
- 404 Not Found, 422 Unprocessable Entity, 500 Internal Server Error

---

## 9. General Notes (ملاحظات عامة)
- جميع الطلبات بصيغة **JSON**  
- رفع الملفات بصيغة **multipart/form-data**  
- البحث، الفلترة، والفرز عبر Query Params:
  - `q`, `sort`, `order`, `page`, `per_page`  
- المصادقة لجميع النقاط المطلوبة عبر **Bearer Token**  
- استخدم نسخة API محددة مثل `/api/v1/...`  
- توحيد شكل الردود باستخدام **Resource Classes**  
- استخدم **Soft Deletes** عند حذف الموارد الحساسة  
- تتبع العمليات المهمة عبر **Activity Logs**

