<template>
  <AdminLayout>
    <div class="d-flex justify-content-between mb-3">
      <h3>Inventory</h3>
      <router-link class="btn btn-primary" to="/products/create">
        Add Inventory
      </router-link>
    </div>
    <div class="row mb-3">
  <div class="col-md-4">
    <input
      type="text"
      class="form-control"
      placeholder="Search by name or SKU or Category or Supplier"
      v-model="search"
    />
  </div>
</div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>#</th><th>Name</th><th>SKU</th><th>Category</th><th>Supplier</th><th>Description</th><th>Purchase Price</th><th>Selling Price</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading">
              <td colspan="9" class="text-center">Loading...</td>
            </tr>
            <tr v-for="(u,i) in products" :key="u.id">
              <td>{{ i+1 }}</td>
              <td>{{ u.name }}</td>
              <td>{{ u.sku }}</td>
              <td>{{ u.category.name }}</td>
              <td>{{ u.supplier.name }}</td>
              <td>{{ u.description }}</td>
              <td>{{ u.purchase_price }}</td>
              <td>{{ u.selling_price }}</td>
              <td>
                  <router-link
                  class="btn btn-sm btn-warning me-2"
                  :to="`/products/${u.id}/edit`"
                  >Edit</router-link>

                  <button class="btn btn-sm btn-danger" @click="remove(u.id)">
                  Delete
                  </button>
              </td>
            </tr>
            <tr v-if="!products.length && !loading">
              <td colspan="9" class="text-center">No products found</td>
            </tr>
        </tbody>
        </table>
    </div>
    <nav v-if="pagination.last_page > 1">
  <ul class="pagination justify-content-end">

    <li class="page-item"
        :class="{ disabled: pagination.current_page === 1 }">
      <button class="page-link"
              @click="load(pagination.current_page - 1)">
        Prev
      </button>
    </li>

    <li v-for="page in pagination.last_page"
        :key="page"
        class="page-item"
        :class="{ active: page === pagination.current_page }">
      <button class="page-link" @click="load(page)">
        {{ page }}
      </button>
    </li>

    <li class="page-item"
        :class="{ disabled: pagination.current_page === pagination.last_page }">
      <button class="page-link"
              @click="load(pagination.current_page + 1)">
        Next
      </button>
    </li>

  </ul>
</nav>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import AdminLayout from '../../layouts/AdminLayout.vue';

const products = ref([]);
const search = ref('');
const pagination = ref({});
const loading = ref(false);

const load = async (page = 1) => {
  loading.value = true;

  const res = await axios.get('/products', {
    params: {
      page,
      search: search.value,
    }
  });

  products.value = res.data.data.data;     // actual products
  pagination.value = res.data.data;     // pagination meta
  loading.value = false;
};

// auto reload on search
watch(search, () => {
  load();
});

const remove = async (id) => {
  if (!confirm('Delete Inventory?')) return;
  await axios.delete(`/products/${id}`);
  load(pagination.value.current_page || 1);
};

onMounted(load);
</script>
