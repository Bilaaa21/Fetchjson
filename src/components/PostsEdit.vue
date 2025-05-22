<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const postId = route.params.id;

const form = reactive({
    student_no: '',
    student_name: '',
    student_class: ''

})

onMounted( async () => {
    try {
        const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
        form.student_no = response.data.student_no;
        form.student_name = response.data.student_name;
        form.student_class = response.data.student_class;
        
        console.log(response.data);
    } catch (error) {
        console.log("Error fetching post", error);
    }
})

const handleSubmit = async () => {
    const updatePost = {
        student_id: postId,
            student_no: form.student_no,
            student_name: form.student_name,
            student_class: form.student_class
    }

    try {
        const response = await axios.patch(`http://localhost/belajar-api/update-data.php`, updatePost);
        router.push(`/posts/${response.data.id}`);
    } catch (error) {
        console.error("Error updating post", error);
    }
}

</script>
<template>
     <div class="form-wrapper">
    <h2>Edit Data Siswa</h2>
    <RouterLink :to="`/posts`" class="btn btn-blue">⬅ Kembali ke Daftar</RouterLink>

    <form @submit.prevent="handleSubmit" class="form">

      <div class="form-group">
        <label for="no">Nomor Siswa</label>
        <input id="no" v-model="form.student_no" type="text" placeholder="....." required />
      </div>

      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input id="name" v-model="form.student_name" type="text" placeholder="....." required />
      </div>

      <div class="form-group">
        <label for="class">Kelas</label>
        <input id="class" v-model="form.student_class" type="text" placeholder="....." required />
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