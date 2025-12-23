<template>
  <AdminLayout>
    <h3 class="mb-3">{{ isEdit ? 'Edit' : 'Create' }} Product</h3>

    <form @submit.prevent="submit" class="col-md-8">

      <!-- Product Name -->
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input
          v-model="form.name"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>

      <!-- SKU -->
      <div class="mb-3">
        <label class="form-label">SKU / Code</label>
        <input
          v-model="form.sku"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.sku }"
        />
        <div class="invalid-feedback" v-if="errors.sku">
          {{ errors.sku[0] }}
        </div>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select
          v-model="form.category_id"
          class="form-select"
          :class="{ 'is-invalid': errors.category_id }"
        >
          <option value="">Select Category</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
        <div class="invalid-feedback" v-if="errors.category_id">
          {{ errors.category_id[0] }}
        </div>
      </div>

      <!-- Supplier -->
      <div class="mb-3">
        <label class="form-label">Supplier</label>
        <select
          v-model="form.supplier_id"
          class="form-select"
          :class="{ 'is-invalid': errors.supplier_id }"
        >
          <option value="">Select Supplier</option>
          <option v-for="sup in suppliers" :key="sup.id" :value="sup.id">
            {{ sup.name }}
          </option>
        </select>
        <div class="invalid-feedback" v-if="errors.supplier_id">
          {{ errors.supplier_id[0] }}
        </div>
      </div>

      <!-- Price -->
      <div class="mb-3">
        <label class="form-label">Selling Price</label>
        <input
          v-model="form.selling_price"
          type="number"
          step="0.01"
          class="form-control"
          :class="{ 'is-invalid': errors.selling_price }"
        />
        <div class="invalid-feedback" v-if="errors.selling_price">
          {{ errors.selling_price[0] }}
        </div>
      </div>

      <!-- Cost Price -->
      <div class="mb-3">
        <label class="form-label">Cost Price</label>
        <input
          v-model="form.purchase_price"
          type="number"
          step="0.01"
          class="form-control"
          :class="{ 'is-invalid': errors.purchase_price }"
        />
        <div class="invalid-feedback" v-if="errors.purchase_price">
          {{ errors.purchase_price[0] }}
        </div>
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea
          v-model="form.description"
          class="form-control"
          rows="3"
        ></textarea>
      </div>

      <!--Rorder Level -->
      <div class="mb-3">
        <label class="form-label">Rorder Level</label>
        <input
          v-model="form.reorder_level"
          type="number"
          step="0.01"
          class="form-control"
          :class="{ 'is-invalid': errors.reorder_level }"
        />
        <div class="invalid-feedback" v-if="errors.reorder_level">
          {{ errors.reorder_level[0] }}
        </div>
      </div>

      <!-- Status -->
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select v-model="form.is_active" class="form-select">
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>

      <button class="btn btn-primary">
        {{ isEdit ? 'Update' : 'Create' }}
      </button>

    </form>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import AdminLayout from '../../layouts/AdminLayout.vue'

const route = useRoute()
const router = useRouter()

const isEdit = computed(() => !!route.params.id)

const form = ref({
  name: '',
  sku: '',
  category_id: '',
  supplier_id: '',
  selling_price: '',
  purchase_price: '',
  description: '',
  reorder_level:'',
  is_active: 1,
})

const errors = ref({})
const categories = ref([])
const suppliers = ref([])

onMounted(async () => {
  await loadDropdowns()

  if (isEdit.value) {
    const res = await axios.get(`/products/${route.params.id}`)
    form.value = { ...res.data }
  }
})

const loadDropdowns = async () => {
  const [catRes, supRes] = await Promise.all([
    axios.get('/categories'),
    axios.get('/suppliers'),
  ])

  categories.value = catRes.data.data ?? catRes.data
  suppliers.value = supRes.data.data ?? supRes.data
}

const submit = async () => {
  errors.value = {}

  try {
    if (isEdit.value) {
      await axios.put(`/products/${route.params.id}`, form.value)
    } else {
      await axios.post('/products', form.value)
    }

    router.push('/products')
  } catch (err) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.errors
    }
  }
}
</script>
