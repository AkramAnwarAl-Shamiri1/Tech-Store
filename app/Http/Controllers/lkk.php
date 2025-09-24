ActivityLogController
AddressController
CartController
CartItemController
CategoryController
CouponController
FileController
MessageController
NotificationController
OrderController
OrderCouponController
OrderItemController
OrderStatusHistoryController
PaymentController
PaymentMethodController
PersonalAccessTokenController
ProductController
ProductTagController
ReviewController
RoleController
SessionController
SettingController
ShippingMethodController
StockHistoryController
TagController
TransactionController
UserController
VendorController
WishlistController
<template>
  <header :class="['sticky top-0 z-50 transition-colors duration-500', isDark ? 'bg-gray-900 text-white' : 'bg-white text-[#242856]']">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-5 py-3">
      <!-- شعار الموقع -->
      <div class="flex items-center space-x-2">
        <img :src="logo" alt="Logo" class="w-14 h-14 rounded-full"/>
        <h1 class="text-xl font-bold">Tech Store</h1>
      </div>

      <!-- روابط القائمة للكمبيوتر -->
      <nav class="hidden md:flex space-x-6 font-semibold">
        <router-link to="/home" class="hover:text-[#002244] transition">Home</router-link>
        <router-link to="/products" class="hover:text-[#002244] transition">Products</router-link>
        <router-link to="/cart" class="hover:text-[#002244] transition">Cart</router-link>
        <router-link to="/orders" class="hover:text-[#002244] transition">Orders</router-link>

        <!-- روابط المصادقة حسب حالة المستخدم -->
        <div v-if="!user" class="relative">
          <button @click="desktopDropdown = !desktopDropdown" class="flex items-center gap-1 hover:text-[#002244] transition font-semibold">
            انضم إلينا ▾
          </button>
          <div v-show="desktopDropdown" class="absolute top-full mt-1 bg-[#242856] text-white rounded shadow-md min-w-[150px]">
            <a href="/login" class="block px-4 py-2 hover:bg-yellow-400 hover:text-[#242856]">تسجيل الدخول</a>
            <a href="/register" class="block px-4 py-2 hover:bg-yellow-400 hover:text-[#242856]">إنشاء حساب جديد</a>
          </div>
        </div>

        <div v-else class="relative">
          <button class="flex items-center gap-1 hover:text-[#002244] transition font-semibold">
            {{ user.name }} ▾
          </button>
          <div class="absolute top-full mt-1 bg-[#242856] text-white rounded shadow-md min-w-[150px]">
            <a href="/dashboard" class="block px-4 py-2 hover:bg-yellow-400 hover:text-[#242856]">Dashboard</a>
            <button @click="logout" class="w-full text-left px-4 py-2 hover:bg-yellow-400 hover:text-[#242856]">Logout</button>
          </div>
        </div>
      </nav>

      <!-- زر الهامبرغر للجوال -->
      <div class="md:hidden text-3xl cursor-pointer" @click="showMobileMenu = !showMobileMenu">
        ☰
      </div>
    </div>

    <!-- القائمة المنسدلة للجوال -->
    <div v-show="showMobileMenu" :class="['md:hidden shadow-md transition-colors duration-300', isDark ? 'bg-gray-900 text-white border-gray-700' : 'bg-white text-[#242856] border-gray-200']">
      <router-link to="/home" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">Home</router-link>
      <router-link to="/products" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">Products</router-link>
      <router-link to="/cart" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">Cart</router-link>
      <router-link to="/orders" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">Orders</router-link>

      <div v-if="!user">
        <a href="/login" class="block px-6 py-2 hover:bg-yellow-400 hover:text-[#242856]">تسجيل الدخول</a>
        <a href="/register" class="block px-6 py-2 hover:bg-yellow-400 hover:text-[#242856]">إنشاء حساب جديد</a>
      </div>
      <div v-else>
        <a href="/dashboard" class="block px-6 py-2 hover:bg-yellow-400 hover:text-[#242856]">Dashboard</a>
        <button @click="logout" class="w-full text-left px-6 py-2 hover:bg-yellow-400 hover:text-[#242856]">Logout</button>
      </div>
    </div>
  </header>
</template>

<script setup>
import logoImg from '@/assets/logo.png'
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

defineProps({ isDark: Boolean })

const logo = logoImg
const showMobileMenu = ref(false)
const desktopDropdown = ref(false)
const mobileDropdown = ref(false)
const user = ref(null)
const router = useRouter()

// جلب بيانات المستخدم عند تحميل الصفحة
onMounted(async () => {
  try {
    const res = await axios.get('/api/user')
    user.value = res.data
  } catch {
    user.value = null
  }
})

// تسجيل الخروج
const logout = async () => {
  await axios.post('/api/logout')
  user.value = null
  window.location.href = '/login' // فتح صفحة Blade تسجيل الدخول
}
</script>
