<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import router from '@/router';

const form = reactive({
    student_id: '',
    student_no: '',     
    student_name: '',
    student_class: ''
})
const handleSubmit = async () => {
    const newStudent = {
        student_id: form.student_id,
        student_no: form.student_no, 
        student_name: form.student_name,
        student_class: form.student_class
    }
    try {
        const response = await axios.post('http://localhost/belajar-api/insert-data.php', newStudent);
        console.log("Response on posting data:", response);
        return router.push('/posts');
    } catch (error) {
        console.error("Error menambahkan student:", error);
    }
}

</script>

<template>
   <div class="form-wrapper">
    <h2>Tambah Data Siswa</h2>
    <RouterLink :to="`/posts`" class="btn btn-blue">⬅ Kembali ke Daftar</RouterLink>

    <form @submit.prevent="handleSubmit" class="form">
      <div class="form-group">
        <label for="id">ID Siswa</label>
        <input id="id" v-model="form.student_id" type="text" placeholder="tolong diisi" required />
      </div>

      <div class="form-group">
        <label for="no">Nomor Siswa</label>
        <input id="no" v-model="form.student_no" type="text" placeholder="Masukkan Nomor Siswa di sini" required />
      </div>

      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input id="name" v-model="form.student_name" type="text" placeholder="Nama" required />
      </div>

      <div class="form-group">
        <label for="class">Kelas</label>
        <input id="class" v-model="form.student_class" type="text" placeholder="Kelas" required />
      </div>

      <button type="submit" class="btn btn-green">✔ Simpan</button>
    </form>
  </div>
</template>

<style scoped>
.form-wrapper {
  max-width: 500px;
  margin: 30px auto;
  padding: 30px;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 16px;
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 6px;
  font-weight: 600;
  color: #333;
}

input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  transition: border-color 0.2s;
}

input:focus {
  outline: none;
  border-color: #4CAF50;
}

.btn {
  padding: 10px 16px;
  margin-top: 10px;
  font-weight: 600;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  text-align: center;
}

.btn-green {
  background-color: #4CAF50;
  color: white;
}

.btn-blue {
  background-color: #2196F3;
  color: white;
  display: inline-block;
  margin-bottom: 20px;
  text-decoration: none;
}
</style>
