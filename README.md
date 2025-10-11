

   الإطار: Laravel + Sanctum النسخة: v1.0
ملاحظة: جميع نقاط النهاية التي تتطلب مصادقة تستخدم auth:sanctum وتحتاج إلى إرسال التوكن في الهيدر كـ Authorization: Bearer {token}.


---

المصادقة

تسجيل مستخدم جديد

POST /api/register

Auth: لا

Body: name, email, password

Response: user object + token


تسجيل الدخول

POST /api/login

Auth: لا

Body: email, password

Response: user object + token


لوحة المستخدم

GET /api/dashboard

Auth: نعم

Headers: Authorization: Bearer {token}

Response: بيانات المستخدم والإحصائيات



---

المستخدمون (Users)

apiResource('users') (Auth required)

Endpoints: GET /api/users, POST /api/users, GET /api/users/{id}, PUT /api/users/{id}, DELETE /api/users/{id}



---

المنتجات (Products)

GET /api/products - جميع المنتجات (مفتوح)

GET /api/products/{product} - منتج محدد (مفتوح)

POST /api/products - إنشاء منتج (Auth required)

PUT /api/products/{product} - تعديل منتج (Auth required)

DELETE /api/products/{product} - حذف منتج (Auth required)

apiResource('products') يشمل كل العمليات السابقة



---

Sliders

apiResource('sliders') (Auth required)



---

الإشعارات (Notifications)

GET /api/notifications - جميع الإشعارات

GET /api/notifications/unread - غير مقروءة

POST /api/notifications/{id}/read - تعليم كمقروء

POST /api/notifications/read-all - تعليم كل الإشعارات كمقروءة



---

الإحصائيات (Stats)

GET /api/stats - إحصائيات النظام (Auth required)



---

الموارد الأخرى (Auth required)

Roles, Categories, Addresses, Shipping Methods, Payment Methods, Orders, Order Items, Order Status History, Reviews, Coupons, Payments, Wishlists, Transactions, Vendors, Product Images, Cart Items, Stock Histories, Activity Logs, Messages, Photos, Product Tags, Settings, Tags, Cart, Order Coupons, Files



---

رموز الحالة (HTTP Status Codes)

200 OK, 201 Created, 204 No Content

400 Bad Request, 401 Unauthorized, 403 Forbidden

404 Not Found, 422 Unprocessable Entity, 500 Internal Server Error



---

ملاحظات عامة مختصرة

جميع الطلبات بصيغة JSON، والملفات بـ multipart/form-data عند الحاجة.

يمكن البحث والفلترة والفرز باستخدام Query params (q, sort, order, page, per_page).

المصادقة لجميع نقاط النهاية المطلوبة عبر توكن Bearer.

استخدم نسخة API محددة مثل /api/v1/... لتسهيل التحديثات المستقبلية.

توحيد شكل الردود باستخدام Resource Classes.

استخدام soft deletes عند حذف الموارد الحساسة.

تتبع العمليات المهمة عبر Activity Logs.


