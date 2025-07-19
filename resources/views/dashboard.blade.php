@extends('components.layouts.master')
@section('content')
 <!-- System Status Card -->
  <main class="flex-grow w-full max-w-6xl mx-auto p-4 md:p-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">حالة النظام</h2>
                    <div class="space-y-2 text-gray-300 text-sm hacker-subtext">
                        <p>المعالج: <span class="text-green-400">75% استخدام</span></p>
                        <p>الذاكرة: <span class="text-green-400">40% استخدام</span></p>
                        <p>الشبكة: <span class="text-green-400">متصل</span></p>
                        <p>التهديدات: <span class="text-red-500">0</span></p>
                    </div>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        عرض التفاصيل
                    </button>
                </div>

                <!-- Recent Logs Card -->
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">السجلات الأخيرة</h2>
                    <ul class="list-none space-y-2 text-gray-300 text-sm hacker-subtext">
                        <li><span class="text-green-400">[2025-07-19 19:30]</span> - تسجيل دخول ناجح: <span class="text-cyan-400">user_alpha</span></li>
                        <li><span class="text-yellow-400">[2025-07-19 19:28]</span> - محاولة وصول غير مصرح بها: <span class="text-red-400">192.168.1.105</span></li>
                        <li><span class="text-green-400">[2025-07-19 19:25]</span> - تحديث قاعدة البيانات: <span class="text-cyan-400">تم</span></li>
                    </ul>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        عرض كل السجلات
                    </button>
                </div>

                <!-- Network Activity Card -->
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">نشاط الشبكة</h2>
                    <div class="space-y-2 text-gray-300 text-sm hacker-subtext">
                        <p>الروابط النشطة: <span class="text-green-400">5</span></p>
                        <p>البيانات المرسلة: <span class="text-cyan-400">1.2 GB</span></p>
                        <p>البيانات المستلمة: <span class="text-cyan-400">800 MB</span></p>
                        <p>المنافذ المفتوحة: <span class="text-yellow-400">2</span></p>
                    </div>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        مراقبة الشبكة
                    </button>
                </div>

                <!-- User Management Card -->
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">إدارة المستخدمين</h2>
                    <div class="space-y-2 text-gray-300 text-sm hacker-subtext">
                        <p>إجمالي المستخدمين: <span class="text-cyan-400">12</span></p>
                        <p>المستخدمون النشطون: <span class="text-green-400">3</span></p>
                        <p>المستخدمون المعلقون: <span class="text-yellow-400">1</span></p>
                    </div>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        إدارة الحسابات
                    </button>
                </div>

                <!-- Security Alerts Card -->
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">تنبيهات الأمان</h2>
                    <ul class="list-none space-y-2 text-gray-300 text-sm hacker-subtext">
                        <li class="text-red-500">تحذير: محاولة اختراق فاشلة (IP: 10.0.0.5)</li>
                        <li class="text-yellow-400">إشعار: تحديثات معلقة للنظام</li>
                        <li class="text-green-400">لا توجد تهديدات حرجة</li>
                    </ul>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        مراجعة التنبيهات
                    </button>
                </div>

                <!-- System Configuration Card -->
                <div class="hacker-card p-6 rounded-xl">
                    <h2 class="text-xl font-semibold mb-4 hacker-text">إعدادات النظام</h2>
                    <div class="space-y-2 text-gray-300 text-sm hacker-subtext">
                        <p>الإصدار: <span class="text-cyan-400">2.7.1</span></p>
                        <p>آخر تحديث: <span class="text-green-400">2025-07-15</span></p>
                        <p>وضع التشغيل: <span class="text-green-400">آمن</span></p>
                    </div>
                    <button class="hacker-button mt-4 w-full py-2 text-sm rounded-md">
                        تعديل الإعدادات
                    </button>
                </div>

            </div>
        </main>
                
@endsection