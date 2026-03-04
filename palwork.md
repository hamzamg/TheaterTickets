# 🎭 TheaterTickets - Project Roadmap

> خطة عمل شاملة لنظام إدارة تذاكر المسرح

---

## 🎯 الهدف

بناء نظام متكامل لإدارة تذاكر المسرح باستخدام أحدث التقنيات مع التركيز على:
- تجربة مستخدم سلسة وحديثة
- نظام صلاحيات مرن وقوي
- أداء عالي وقابلية للتوسع
- كود نظيف وقابل للصيانة

---

## 💻 التقنيات المستخدمة

| التقنية | الإصدار | الغرض |
|---------|---------|--------|
| **Laravel** | 12.x | Framework أساسي |
| **PHP** | 8.5 | لغة البرمجة |
| **Livewire** | 3.5 | واجهات تفاعلية |
| **Tailwind CSS** | 3.4 | التصميم |
| **Vite** | 5.x | Build tool |
| **MySQL** | 8.0 | قاعدة البيانات (Prod) |
| **SQLite** | 3.x | قاعدة البيانات (Dev) |

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
- `ticket_type_id` - نوع التذكرة (FK)

**العلاقات:**
- ينتمي إلى `Show`
- ينتمي إلى `TicketsType`
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
- ✅ سجل المشتريات

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
- ✅ طباعة التذكرة

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
- ✅ خريطة المقاعد

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
- ✅ دعم متعدد اللغات

---

### ✅ 8. البيانات المرجعية (Reference Data)

#### ShowsType
**الحالة:** مكتمل ✅

- أنواع العروض (مسرحية، أوبرا، حفلة، إلخ)
- ربط بالعروض

#### TicketsType
**الحالة:** مكتمل ✅

- أنواع التذاكر (VIP، عادي، طالب، إلخ)
- معدلات الأسعار

---

## 🔐 نظام الصلاحيات

**الحالة:** مكتمل ✅

### الأدوار:

| الدور | الصلاحيات | الوصف |
|-------|----------|--------|
| **super-admin** | 26 صلاحية | صلاحيات كاملة |
| **admin** | 21 صلاحية | إدارة كاملة بدون حذف |
| **manager** | 18 صلاحية | إدارة العمليات |
| **staff** | 11 صلاحية | العمليات الأساسية |
| **user** | 3 صلاحيات | عرض وإنشاء حجوزات |

### الصلاحيات المتاحة:

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
- [ ] دمج Pull Requests
- [ ] نظام الإشعارات
- [ ] النشر الإنتاجي
- [ ] اختبارات شاملة
- [ ] توثيق API

---

## 🚀 خطوات النشر

### 1. ما قبل النشر
- [ ] مراجعة الكود
- [ ] اختبارات الأداء
- [ ] فحص الأمان
- [ ] تحديث الـ README

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
- ✅ Documentations للـ classes
- ✅ Meaningful variable names

### الأداء:
- ✅ Database indexing
- ✅ Eager loading للعلاقات
- ✅ Caching للبيانات المتكررة
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
