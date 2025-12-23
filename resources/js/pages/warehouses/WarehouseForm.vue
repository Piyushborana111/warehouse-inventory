<template>
  <AdminLayout>
    <h3 class="mb-3">{{ isEdit ? 'Edit' : 'Create' }} WareHouse</h3>

    <form @submit.prevent="submit" class="col-md-6">
      <div class="mb-3">
        <label>Name</label>
        <input v-model="form.name" class="form-control" :class="{ 'is-invalid': errors.name }"/>
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Code</label>
        <input v-model="form.code" type="text" class="form-control" :class="{ 'is-invalid': errors.code }" />
        <div class="invalid-feedback" v-if="errors.code">
          {{ errors.code[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Address</label>
        <input v-model="form.address" type="text" class="form-control" :class="{ 'is-invalid': errors.address }" />
        <div class="invalid-feedback" v-if="errors.address">
          {{ errors.address[0] }}
        </div>
      </div>


      <div class="mb-3">
        <label>City</label>
        <input v-model="form.city" type="text" class="form-control" :class="{ 'is-invalid': errors.city }" />
        <div class="invalid-feedback" v-if="errors.city">
          {{ errors.city[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>State</label>
        <input v-model="form.state" type="text" class="form-control" :class="{ 'is-invalid': errors.state }" />
        <div class="invalid-feedback" v-if="errors.state">
          {{ errors.state[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Country</label>
        <input v-model="form.country" type="text" class="form-control" :class="{ 'is-invalid': errors.country }" />
        <div class="invalid-feedback" v-if="errors.country">
          {{ errors.country[0] }}
        </div>
      </div>

       
      <button class="btn btn-primary">{{ isEdit ? 'Update' : 'Create' }}</button>
    </form>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import AdminLayout from '../../layouts/AdminLayout.vue';

const route = useRoute();
const router = useRouter();

const form = ref({ name:'', code:'', address:'', city:'', state:'', country:'', });
const isEdit = computed(() => !!route.params.id);
const errors = ref({});

onMounted(async () => {
  if (isEdit.value) {
    const res = await axios.get(`/warehouses/${route.params.id}`);
    form.value = { ...res.data};

  }
});

const submit = async () => {
  errors.value = {};
  try {  
    if (isEdit.value) {
        await axios.put(`/warehouses/${route.params.id}`, form.value);
    } else {
        await axios.post('/warehouses', form.value);
    }
     router.push('/warehouses');
   } catch (err) {
   
    if (err.response && err.response.status === 422) {
      // Laravel validation errors
      console.log(err.response.data.errors.name[0]);
      errors.value = err.response.data.errors;
    }
   } 
 
};
</script>
