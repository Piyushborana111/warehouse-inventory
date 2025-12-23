<template>
    <div class="container-fluid">
           <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark px-3">
            <!-- Hamburger (mobile only) -->
            <button
                class="btn btn-outline-light d-md-none"
                @click="toggleSidebar"
            >
                ☰
            </button>

            <span class="navbar-brand ms-2">Admin Panel</span>
        </nav>

      <div class="row">
            <!-- Sidebar -->
            <aside
                class="col-12 col-md-3 col-lg-2 bg-light min-vh-100 p-3 sidebar"
                :class="{ open: sidebarOpen }"
            >
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link" active-class="active" exact   @click="isMobile && (sidebarOpen = false)" >Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/warehouses" class="nav-link" :class="{ active: $route.path.startsWith('/warehouses') }"  @click="isMobile && (sidebarOpen = false)" >Warehouses</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/users" class="nav-link" :class="{ active: $route.path.startsWith('/users') }"  @click="isMobile && (sidebarOpen = false)" >Users</router-link>
                    </li>
                     <li class="nav-item">
                        <router-link to="/products" class="nav-link" :class="{ active: $route.path.startsWith('/products') }"  @click="isMobile && (sidebarOpen = false)" >Inventory</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/categories" class="nav-link" :class="{ active: $route.path.startsWith('/categories') }"  @click="isMobile && (sidebarOpen = false)" >Categories</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/suppliers" class="nav-link" :class="{ active: $route.path.startsWith('/suppliers') }"  @click="isMobile && (sidebarOpen = false)" >Suppliers</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/stock" class="nav-link" :class="{ active: $route.path.startsWith('/stock') }"  @click="isMobile && (sidebarOpen = false)" >Stock Management</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/orders" class="nav-link" :class="{ active: $route.path.startsWith('/orders') }"  @click="isMobile && (sidebarOpen = false)" >Orders</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/reports" class="nav-link" :class="{ active: $route.path.startsWith('/reports') }"  @click="isMobile && (sidebarOpen = false)" >Reports</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/settings" class="nav-link" :class="{ active: $route.path.startsWith('/settings') }"  @click="isMobile && (sidebarOpen = false)" >Settings</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/logout" class="nav-link" :class="{ active: $route.path.startsWith('/logout') }"  @click="isMobile && (sidebarOpen = false)" >Logout</router-link>
                    </li>
                </ul>
            </aside>

            <!-- Main content -->
            <main class="col-12 col-md p-4">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const sidebarOpen = ref(false);
const isMobile = ref(false);

const checkScreen = () => {
    isMobile.value = window.innerWidth < 768;
    if (!isMobile.value) {
        sidebarOpen.value = true; // desktop pe always open
    }
};

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

onMounted(() => {
    checkScreen();
    window.addEventListener('resize', checkScreen);
});
</script>