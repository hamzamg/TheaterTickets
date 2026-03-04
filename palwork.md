# 🎭 TheaterTickets - Project Roadmap

> خطة عمل شاملة لنظام إدارة تذاكر المسرح

---

## 🎯 الهدف

بناء نظام متكامل لإدارة تذاكر المسرح باستخدام أحدث التقنيات مع التركيز على:
<<<<<<< HEAD
- تجربة مستخدم سلسة وحديثة
- نظام صلاحيات مرن وقوي
- أداء عالي وقابلية للتوسع
- كود نظيف وقابل للصيانة
=======
- ✅ تجربة مستخدم سلسة وحديثة
- ✅ نظام صلاحيات مرن وقوي
- ✅ أداء عالي وقابلية للتوسع
- ✅ كود نظيف وقابل للصيانة
>>>>>>> docs/update-main-documentation

---

## 💻 التقنيات المستخدمة

| التقنية | الإصدار | الغرض |
|---------|---------|--------|
| **Laravel** | 12.x | Framework أساسي |
| **PHP** | 8.5 | لغة البرمجة |
| **Livewire** | 3.5 | واجهات تفاعلية |
<<<<<<< HEAD
| **Tailwind CSS** | 3.4 | التصميم |
| **Vite** | 5.x | Build tool |
| **MySQL** | 8.0 | قاعدة البيانات (Prod) |
| **SQLite** | 3.x | قاعدة البيانات (Dev) |
=======
| **Tailwind CSS** | 4.x | التصميم |
| **Vite** | 5.x | Build tool |
| **MySQL** | 8.0 | قاعدة البيانات |
| **Spatie Permission** | 6.x | نظام الصلاحيات |
| **Simple QR Code** | 4.x | توليد QR codes |
>>>>>>> docs/update-main-documentation

---

## 📦 الوحدات الأساسية

### ✅ 1. نظام المصادقة (Authentication)

**الحالة:** مكتمل ✅

**المميزات:**
- Laravel Breeze للتسجيل والدخول
- مستخدم إداري افتراضي
- إدارة الجلسات

**البيانات:**
```
Email: admin@theater.local
Password: ad123456
<<<<<<< HEAD
=======
Role: super-admin
>>>>>>> docs/update-main-documentation
```

---

### ✅ 2. إدارة العروض (Shows Management)

**الحالة:** مكتمل ✅

**الحقول:**
- `name` - اسم العرض
- `type` - نوع العرض
- `description` - الوصف
- `photo_path` - صورة العرض
- `active` - حالة التفعيل
- `show_type_id` - نوع العرض (FK)

**العلاقات:**
- ينتمي إلى `ShowsType`
- لديه عدة `Tickets`

**الوظائف:**
- ✅ إنشاء عرض جديد
- ✅ تعديل العرض
- ✅ حذف العرض
- ✅ البحث والتصفية
- ✅ رفع الصور

---

### ✅ 3. إدارة التذاكر (Tickets Management)

**الحالة:** مكتمل ✅

**الحقول:**
- `date_shows` - تاريخ العرض
- `time_shows` - وقت العرض
- `nomber_ticket` - عدد التذاكر
- `rest_ticket` - التذاكر المتبقية
- `price` - السعر
- `code_ticket` - رمز التذكرة
- `type` - نوع التذكرة
- `show_id` - العرض (FK)
<<<<<<< HEAD
- `ticket_type_id` - نوع التذكرة (FK)

**العلاقات:**
- ينتمي إلى `Show`
- ينتمي إلى `TicketsType`
=======

**العلاقات:**
- ينتمي إلى `Show`
>>>>>>> docs/update-main-documentation
- لديه عدة `Baytickets`

**الوظائف:**
- ✅ إنشاء دفعات تذاكر
- ✅ تتبع التوفر
- ✅ ربط بالعروض

---

### ✅ 4. إدارة العملاء (Clients Management)

**الحالة:** مكتمل ✅

**الحقول:**
- `firstname` - الاسم الأول
- `lastname` - اسم العائلة
- `sex` - الجنس
- `age` - العمر
- `card_id` - رقم البطاقة
- `phone` - رقم الهاتف
- `pay_method` - طريقة الدفع

**العلاقات:**
- لديه عدة `Baytickets`

**الوظائف:**
- ✅ إدارة بيانات العملاء
- ✅ تتبع الحجوزات
<<<<<<< HEAD
- ✅ سجل المشتريات
=======
>>>>>>> docs/update-main-documentation

---

### ✅ 5. إدارة الحجوزات (Bookings Management)

**الحالة:** مكتمل ✅

**الحقول:**
- `client_id` - العميل (FK)
- `show_id` - العرض (FK)
- `ticket_id` - التذكرة (FK)
- `qrcode` - رمز QR
- `quantity` - الكمية
- `notes` - ملاحظات

**العلاقات:**
- ينتمي إلى `Client`
- ينتمي إلى `Show`
- ينتمي إلى `Ticket`

**الوظائف:**
- ✅ إنشاء حجز
- ✅ توليد QR code تلقائي
- ✅ تأكيد الحجز
<<<<<<< HEAD
- ✅ طباعة التذكرة
=======
>>>>>>> docs/update-main-documentation

---

### ✅ 6. إدارة أماكن الجلوس (TeatherPlaces)

**الحالة:** مكتمل ✅

**الحقول:**
- `num_row` - رقم الصف
- `num_col` - رقم المقعد
- `name` - اسم المكان
- `reservation` - حالة الحجز
- `selected` - حالة التحديد

**الوظائف:**
- ✅ إدارة شبكة المقاعد
- ✅ تتبع الحجوزات
<<<<<<< HEAD
- ✅ خريطة المقاعد
=======
>>>>>>> docs/update-main-documentation

---

### ✅ 7. إدارة المقالات (Articles)

**الحالة:** مكتمل ✅

**الحقول:**
- `title` - العنوان
- `body` - المحتوى
- `photo_path` - الصورة
- `lang` - اللغة

**الوظائف:**
- ✅ نشر الأخبار
- ✅ إعلانات العروض
<<<<<<< HEAD
- ✅ دعم متعدد اللغات
=======
>>>>>>> docs/update-main-documentation

---

### ✅ 8. البيانات المرجعية (Reference Data)

#### ShowsType
**الحالة:** مكتمل ✅

<<<<<<< HEAD
- أنواع العروض (مسرحية، أوبرا، حفلة، إلخ)
=======
- أنواع العروض
>>>>>>> docs/update-main-documentation
- ربط بالعروض

#### TicketsType
**الحالة:** مكتمل ✅

<<<<<<< HEAD
- أنواع التذاكر (VIP، عادي، طالب، إلخ)
=======
- أنواع التذاكر
>>>>>>> docs/update-main-documentation
- معدلات الأسعار

---

## 🔐 نظام الصلاحيات

**الحالة:** مكتمل ✅

### الأدوار:

| الدور | الصلاحيات | الوصف |
|-------|----------|--------|
| **super-admin** | 26 صلاحية | صلاحيات كاملة |
<<<<<<< HEAD
| **admin** | 21 صلاحية | إدارة كاملة بدون حذف |
=======
| **admin** | 21 صلاحية | إدارة كاملة |
>>>>>>> docs/update-main-documentation
| **manager** | 18 صلاحية | إدارة العمليات |
| **staff** | 11 صلاحية | العمليات الأساسية |
| **user** | 3 صلاحيات | عرض وإنشاء حجوزات |

### الصلاحيات المتاحة:

<<<<<<< HEAD
**Shows:**
- `view shows`, `create shows`, `edit shows`, `delete shows`

**Tickets:**
- `view tickets`, `create tickets`, `edit tickets`, `delete tickets`

**Clients:**
- `view clients`, `create clients`, `edit clients`, `delete clients`

**Bookings:**
- `view bookings`, `create bookings`, `edit bookings`, `delete bookings`

**Articles:**
- `view articles`, `create articles`, `edit articles`, `delete articles`

**Settings:**
- `view settings`, `edit settings`

**Users:**
- `view users`, `create users`, `edit users`, `delete users`
=======
**Shows:** `view`, `create`, `edit`, `delete`

**Tickets:** `view`, `create`, `edit`, `delete`

**Clients:** `view`, `create`, `edit`, `delete`

**Bookings:** `view`, `create`, `edit`, `delete`

**Articles:** `view`, `create`, `edit`, `delete`

**Settings:** `view`, `edit`

**Users:** `view`, `create`, `edit`, `delete`
>>>>>>> docs/update-main-documentation

---

## 📋 خطة التنفيذ

### ✅ المرحلة 1: الأساس (مكتمل)
- [x] إعداد المشروع
- [x] إنشاء النماذج
- [x] إعداد قاعدة البيانات
- [x] إنشاء المستخدم الإداري

### ✅ المرحلة 2: الواجهات (مكتمل)
- [x] Livewire components
- [x] CRUD لجميع الوحدات
- [x] نظام QR codes
- [x] تصميم UI

### ✅ المرحلة 3: الأمان (مكتمل)
- [x] نظام الصلاحيات
- [x] تعيين الأدوار
- [x] حماية المسارات

### 🔄 المرحلة 4: التحسينات (جاري)
<<<<<<< HEAD
- [ ] دمج Pull Requests
=======
>>>>>>> docs/update-main-documentation
- [ ] نظام الإشعارات
- [ ] النشر الإنتاجي
- [ ] اختبارات شاملة
- [ ] توثيق API

---

## 🚀 خطوات النشر

### 1. ما قبل النشر
<<<<<<< HEAD
- [ ] مراجعة الكود
- [ ] اختبارات الأداء
- [ ] فحص الأمان
- [ ] تحديث الـ README
=======
- [x] مراجعة الكود
- [ ] اختبارات الأداء
- [ ] فحص الأمان
- [x] تحديث الـ README
>>>>>>> docs/update-main-documentation

### 2. النشر
- [ ] إعداد الخادم الإنتاجي
- [ ] تهيئة قاعدة البيانات
- [ ] إعداد SSL
- [ ] مراقبة الأخطاء

### 3. ما بعد النشر
- [ ] مراقبة الأداء
- [ ] جمع التغذية الراجعة
- [ ] تحديثات مستمرة

---

## 📊 معايير الجودة

### الكود:
- ✅ PSR-12 coding standards
- ✅ Type hints للدوال
<<<<<<< HEAD
- ✅ Documentations للـ classes
=======
>>>>>>> docs/update-main-documentation
- ✅ Meaningful variable names

### الأداء:
- ✅ Database indexing
- ✅ Eager loading للعلاقات
<<<<<<< HEAD
- ✅ Caching للبيانات المتكررة
=======
>>>>>>> docs/update-main-documentation
- ✅ Optimized queries

### الأمان:
- ✅ Input validation
- ✅ CSRF protection
- ✅ XSS prevention
- ✅ SQL injection protection

---

## 🔗 المصادر

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Spatie Permission](https://spatie.be/docs/laravel-permission)

---

**📅 آخر تحديث:** 2026-03-04
**👤 المسؤول:** Zo Computer (hemza.zo.computer)
