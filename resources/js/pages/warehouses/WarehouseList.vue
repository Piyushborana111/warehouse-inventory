<template>
  <AdminLayout>
    <div class="d-flex justify-content-between mb-3">
      <h3>Warehouses</h3>
      <router-link class="btn btn-primary" to="/warehouses/create">
        Add Warehouse
      </router-link>
    </div>
    <div class="row mb-3">
  <div class="col-md-4">
    <input
      type="text"
      class="form-control"
      placeholder="Search by name or code or address"
      v-model="search"
    />
  </div>
</div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>#</th><th>Name</th><th>Code</th><th>Full Address</th><th>Created</th><th>Updated</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading">
              <td colspan="7" class="text-center">Loading...</td>
            </tr>
            <tr v-for="(u,i) in warehouses" :key="u.id">
              <td>{{ i+1 }}</td>
              <td>{{ u.name }}</td>
              <td>{{ u.code }}</td>
              <td>{{ u.address }}, {{ u.city }}, {{ u.country }}</td>
              <td>{{ formatDateTime(u.created_at) }}</td>
              <td>{{ formatDateTime(u.updated_at) }}</td>
              <td>
                  <router-link
                  class="btn btn-sm btn-warning me-2"
                  :to="`/warehouses/${u.id}/edit`"
                  >Edit</router-link>

                  <button class="btn btn-sm btn-danger" @click="remove(u.id)">
                  Delete
                  </button>
              </td>
            </tr>
            <tr v-if="!warehouses.length && !loading">
              <td colspan="7" class="text-center">No warehouses found</td>
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
import { formatDateTime } from '@/utils/date';

const warehouses = ref([]);
const search = ref('');
const pagination = ref({});
const loading = ref(false);

const load = async (page = 1) => {
  loading.value = true;

  const res = await axios.get('/warehouses', {
    params: {
      page,
      search: search.value,
    }
  });

  warehouses.value = res.data.data.data;     // actual warehouses
  pagination.value = res.data.data;     // pagination meta
  loading.value = false;
};

// auto reload on search
watch(search, () => {
  load();
});

const remove = async (id) => {
  if (!confirm('Delete warehouse?')) return;
  await axios.delete(`/warehouses/${id}`);
  load(pagination.value.current_page || 1);
};

onMounted(load);
</script>
