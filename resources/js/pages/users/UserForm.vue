<template>
  <AdminLayout>
    <h3 class="mb-3">{{ isEdit ? 'Edit' : 'Create' }} User</h3>

    <form @submit.prevent="submit" class="col-md-6">
      <div class="mb-3">
        <label>Name</label>
        <input v-model="form.name" class="form-control" :class="{ 'is-invalid': errors.name }"/>
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input v-model="form.email" type="email" class="form-control" :class="{ 'is-invalid': errors.name }" />
        <div class="invalid-feedback" v-if="errors.email">
          {{ errors.email[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid': errors.name }" />
        <div class="invalid-feedback" v-if="errors.password">
          {{ errors.password[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label>Role</label>
        <select
          v-model="form.role"
          class="form-control"
          :class="{ 'is-invalid': errors.role }"
        >
          <option value="">Select Role</option>
          <option v-for="role in roles" :key="role" :value="role">
            {{ role }}
          </option>
        </select>
        <div class="invalid-feedback" v-if="errors.role">
          {{ errors.role[0] }}
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
const roles = ['Admin', 'Manager', 'Staff'];

const form = ref({ name:'', email:'', password:'', role:'' });
const isEdit = computed(() => !!route.params.id);
const errors = ref({});


onMounted(async () => {
  if (isEdit.value) {
    const res = await axios.get(`/users/${route.params.id}`);
    form.value = { ...res.data.data, password: '', role: res.data.data.roles[0].name };
  }
});

const submit = async () => {
  errors.value = {};
  try {  
    if (isEdit.value) {
        await axios.put(`/users/${route.params.id}`, form.value);
    } else {
        await axios.post('/users', form.value);
    }
     router.push('/users');
   } catch (err) {
   
    if (err.response && err.response.status === 422) {
      // Laravel validation errors
      console.log(err.response.data.errors.name[0]);
      errors.value = err.response.data.errors;
    }
   } 
 
};
</script>
