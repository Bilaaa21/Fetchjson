<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const postId = route.params.id;
const state = reactive({
    post: Object
})

onMounted(async () => {
    try {
       const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
        state.post = response.data;
    } catch (error) {
        console.log("Error while fetching: ", error);
    }
})


</script>
<template>
  <div class="detail-container">
    <div class="card">
      <h2 class="title">👤 Detail Siswa</h2>
      <ul class="info-list">
        <li><strong>ID:</strong> {{ state.post.student_id }}</li>
        <li><strong>Nomor:</strong> {{ state.post.student_no }}</li>
        <li><strong>Nama:</strong> {{ state.post.student_name }}</li>
        <li><strong>Kelas:</strong> {{ state.post.student_class }}</li>
      </ul>
      <RouterLink to="/posts" class="btn">⬅️ Kembali ke Daftar</RouterLink>
    </div>
  </div>
</template>

<style scoped>
.detail-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
}

.card {
  background: #ffffff;
  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 500px;
}

.title {
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: bold;
  color: #2c3e50;
}

.info-list {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}

.info-list li {
  margin-bottom: 10px;
  font-size: 16px;
  color: #34495e;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #16a085;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  transition: 0.2s;
}

.btn:hover {
  background-color: #1abc9c;
}
</style>
