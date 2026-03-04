<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>🎭 TheaterTickets - نظام إدارة تذاكر المسرح</strong>
</p>

<p align="center">
  نظام متكامل لإدارة تذاكر المسرح مبني باستخدام Laravel 12 و Livewire 3.5
</p>

<p align="center">
  <a href="#-المميزات">المميزات</a> •
  <a href="#-التقنيات">التقنيات</a> •
  <a href="#-التثبيت">التثبيت</a> •
  <a href="#-الاستخدام">الاستخدام</a> •
  <a href="#-الوثائق">الوثائق</a>
</p>

---

## 📑 المحتويات

- [نظرة عامة](#-نظرة-عامة)
- [المميزات](#-المميزات)
- [التقنيات](#-التقنيات)
- [المتطلبات](#-المتطلبات)
- [التثبيت](#-التثبيت)
- [الاستخدام](#-الاستخدام)
- [الوحدات](#-الوحدات)
- [الصلاحيات](#-الصلاحيات)
- [API](#-api)
- [الاختبارات](#-الاختبارات)
- [المساهمة](#-المساهمة)
- [الرخصة](#-الرخصة)

---

## 🎯 نظرة عامة

**TheaterTickets** هو نظام متكامل لإدارة تذاكر المسرح، مصمم ليكون:

- 🚀 **سريع وأداء عالي** - مبني على Laravel 12 و PHP 8.5
- 🎨 **واجهة حديثة** - تصميم responsive باستخدام Tailwind CSS
- 🔐 **آمن ومحمي** - نظام صلاحيات متكامل مع Spatie
- 📱 **تفاعلي** - Livewire 3.5 للتحديثات الفورية
- 🎫 **QR Codes** - توليد تلقائي للتذاكر
- 🌍 **متعدد اللغات** - دعم اللغة العربية والإنجليزية

---

## ✨ المميزات

### 🎭 إدارة العروض
- إنشاء وتعديل وحذف العروض
- تصنيف العروض حسب النوع
- رفع صور للعروض
- تفعيل/إلغاء تفعيل العروض

### 🎫 إدارة التذاكر
- إنشاء دفعات تذاكر
- تتبع التوفر والأسعار
- ربط التذاكر بالعروض
- أنواع متعددة (VIP، عادي، طالب)

### 👥 إدارة العملاء
- تسجيل بيانات العملاء
- تتبع سجل الحجوزات
- طرق دفع متعددة
- إحصائيات العملاء

### 📋 إدارة الحجوزات
- حجز تذاكر بسهولة
- توليد QR codes تلقائياً
- تأكيد وإلغاء الحجوزات
- طباعة التذاكر

### 🪑 إدارة المقاعد
- خريطة تفاعلية للمقاعد
- حجز مقاعد محددة
- تتبع المقاعد المتاحة

### 📰 إدارة المحتوى
- نشر الأخبار والمقالات
- إعلانات العروض
- دعم متعدد اللغات

### 🔐 نظام الصلاحيات
- 5 أدوار متدرجة
- 26 صلاحية دقيقة
- تحكم كامل في الوصول

---

## 💻 التقنيات

### Backend
| التقنية | الإصدار | الوصف |
|---------|---------|--------|
| **Laravel** | 12.x | PHP Framework |
| **PHP** | 8.5 | لغة البرمجة |
| **Livewire** | 3.5 | Full-stack framework |
| **MySQL** | 8.0 | قاعدة البيانات |
| **Spatie Permission** | 6.x | نظام الصلاحيات |

### Frontend
| التقنية | الإصدار | الوصف |
|---------|---------|--------|
| **Tailwind CSS** | 3.4 | CSS Framework |
| **Alpine.js** | 3.x | JavaScript framework |
| **Vite** | 5.x | Build tool |

### Packages
- **simple-qrcode** - توليد QR codes
- **laravel-debugbar** - debugging
- **faker** - بيانات تجريبية

---

## 📋 المتطلبات

- PHP >= 8.5
- Composer >= 2.x
- Node.js >= 18.x
- NPM >= 9.x
- MySQL >= 8.0 أو SQLite >= 3.x

### PHP Extensions
```
php8.5-mysql
php8.5-mbstring
php8.5-xml
php8.5-curl
php8.5-zip
php8.5-bcmath
php8.5-gd
php8.5-sqlite3
```

---

## 🚀 التثبيت

### 1. استنساخ المشروع
```bash
git clone https://github.com/hamzamg/TheaterTickets.git
cd TheaterTickets
```

### 2. تثبيت التبعيات
```bash
composer install
npm install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. إعداد قاعدة البيانات

**لـ SQLite (تطوير):**
```bash
touch database/database.sqlite
```

**لـ MySQL (إنتاج):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=theater_tickets
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. تشغيل Migrations
```bash
php artisan migrate
```

### 6. بيانات أولية
```bash
php artisan db:seed
```

### 7. بناء الأصول
```bash
npm run build
```

### 8. تشغيل الخادم
```bash
php artisan serve
```

---

## 📖 الاستخدام

### بيانات الدخول الافتراضية

```
Email: admin@theater.local
Password: ad123456
Role: super-admin
```

### الوصول للوحة التحكم

1. انتقل إلى `/login`
2. أدخل بيانات الدخول
3. ستنتقل تلقائياً إلى لوحة التحكم

### المسارات الرئيسية

| المسار | الوصف |
|--------|-------|
| `/` | الصفحة الرئيسية |
| `/login` | تسجيل الدخول |
| `/shows` | إدارة العروض |
| `/tickets` | إدارة التذاكر |
| `/clients` | إدارة العملاء |
| `/bookings` | إدارة الحجوزات |
| `/articles` | إدارة المقالات |

---

## 📦 الوحدات

### Shows (العروض)
```
├── Name (اسم العرض)
├── Type (نوع العرض)
├── Description (الوصف)
├── Photo (الصورة)
├── Active (الحالة)
└── ShowsType (النوع)
```

### Tickets (التذاكر)
```
├── Date & Time (التاريخ والوقت)
├── Quantity (العدد)
├── Price (السعر)
├── Code (الرمز)
├── Show (العرض)
└── TicketType (النوع)
```

### Clients (العملاء)
```
├── Name (الاسم)
├── Contact (معلومات الاتصال)
├── Age & Gender (العمر والجنس)
└── Payment Method (طريقة الدفع)
```

### Bookings (الحجوزات)
```
├── Client (العميل)
├── Show (العرض)
├── Ticket (التذكرة)
├── QR Code (رمز QR)
└── Quantity (الكمية)
```

---

## 🔐 الصلاحيات

### الأدوار المتاحة

#### 1. Super Admin (26 صلاحية)
- صلاحيات كاملة على النظام
- إدارة المستخدمين والأدوار
- الوصول لجميع الإعدادات

#### 2. Admin (21 صلاحية)
- إدارة جميع العمليات
- لا يمكنه حذف المستخدمين
- الوصول للإعدادات

#### 3. Manager (18 صلاحية)
- إدارة العروض والتذاكر
- إدارة العملاء والحجوزات
- لا يمكنه الحذف

#### 4. Staff (11 صلاحية)
- العمليات الأساسية
- إنشاء وتعديل البيانات
- عرض التقارير

#### 5. User (3 صلاحيات)
- عرض العروض
- إنشاء حجوزات
- عرض حجوزاته فقط

### الصلاحيات التفصيلية

```php
// Shows Permissions
'view shows', 'create shows', 'edit shows', 'delete shows'

// Tickets Permissions
'view tickets', 'create tickets', 'edit tickets', 'delete tickets'

// Clients Permissions
'view clients', 'create clients', 'edit clients', 'delete clients'

// Bookings Permissions
'view bookings', 'create bookings', 'edit bookings', 'delete bookings'

// Articles Permissions
'view articles', 'create articles', 'edit articles', 'delete articles'

// Settings Permissions
'view settings', 'edit settings'

// Users Permissions
'view users', 'create users', 'edit users', 'delete users'
```

---

## 📡 API

### Endpoints (قريباً)

```
GET    /api/shows          - قائمة العروض
GET    /api/shows/{id}     - تفاصيل عرض
POST   /api/bookings       - إنشاء حجز
GET    /api/bookings/{id}  - تفاصيل حجز
```

### Authentication

```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
     https://your-domain.com/api/shows
```

---

## 🧪 الاختبارات

### تشغيل الاختبارات

```bash
# جميع الاختبارات
php artisan test

# اختبار محدد
php artisan test --filter ShowsTest
```

### أنواع الاختبارات

- **Unit Tests** - اختبار الوحدات المنفصلة
- **Feature Tests** - اختبار الميزات
- **Browser Tests** - اختبار واجهة المستخدم (قريباً)

---

## 🤝 المساهمة

نرحب بمساهماتكم! يرجى اتباع الخطوات التالية:

1. Fork المشروع
2. إنشاء branch جديد (`git checkout -b feature/amazing-feature`)
3. Commit التغييرات (`git commit -m 'Add amazing feature'`)
4. Push إلى Branch (`git push origin feature/amazing-feature`)
5. فتح Pull Request

### معايير الكود

- اتباع PSR-12
- كتابة tests للكود الجديد
- تحديث التوثيق عند الضرورة

---

## 📄 الرخصة

هذا المشروع مرخص تحت رخصة MIT. راجع ملف [LICENSE](LICENSE) للتفاصيل.

---

## 📞 الدعم

- **GitHub Issues:** https://github.com/hamzamg/TheaterTickets/issues
- **Email:** admin@theater.local

---

## 🙏 شكر وتقدير

- [Laravel](https://laravel.com) - Framework رائع
- [Livewire](https://livewire.laravel.com) - Full-stack framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Spatie](https://spatie.be) - حزم Laravel ممتازة

---

<p align="center">
  صُنع بـ ❤️ بواسطة <a href="https://hemza.zo.computer">Zo Computer</a>
</p>

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="100">
  </a>
</p>
