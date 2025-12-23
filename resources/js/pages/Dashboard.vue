<template>
    <AdminLayout>
        <h1 class="mb-3">Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">{{stats.total_users}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">{{stats.total_products}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Warehouses</h5>
                        <p class="card-text">{{stats.total_warehouses}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Suppliers</h5>
                        <p class="card-text">{{stats.total_suppliers}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Stock</h5>
                        <p class="card-text">{{stats.total_stock}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Category</h5>
                        <p class="card-text">{{stats.total_categories}}</p>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../layouts/AdminLayout.vue';
import { ref, onMounted } from 'vue'
import axios from 'axios'

const stats = ref({
  total_warehouses: 0,
  total_products: 0,
  total_stock: 0,
})

const loadDashboard = async () => {
  try {
    const response = await axios.get('/dashboard')
    stats.value = response.data
    console.log(response.data);
  } catch (error) {
    console.error('Failed to load dashboard stats', error)
  }
}

onMounted(() => {
  loadDashboard()
})
</script>
