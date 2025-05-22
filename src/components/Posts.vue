<script setup>
import {IonPage, IonContent} from '@ionic/vue';
import { onMounted, reactive } from 'vue';
import { RouterLink } from 'vue-router';
import axios from 'axios';
import Post from '@/components/Post.vue';

const state = reactive({
    posts: []
})

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/belajar-api/get-all-data.php');
    state.posts = response.data;
  } catch (error) {
    console.error('Error fetching jobs:', error);
  }
});
</script>
<template>
  <ion-page>
    <ion-content>
      <div class="center-container">
        <h1>Daftar Siswa</h1>

        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
          <RouterLink :to="`/`" class="btn btn-blue">🏠 Beranda</RouterLink>
          <RouterLink :to="`/posts/add`" class="btn btn-green">➕ Tambah Siswa</RouterLink>
        </div>

       <table class="styled-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nomor</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <Post v-for="post in state.posts" :key="post.student_id" :post="post" />
  </tbody>
</table>
      </div>
    </ion-content>
  </ion-page>
</template>
<style scoped>
.styled-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  font-size: 16px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
}

.styled-table thead tr {
  background-color: #2c3e50;
  color: #ffffff;
  text-align: left;
}

.styled-table th,
.styled-table td {
  padding: 12px 15px;
}

.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
  background-color: #ffffff; /* default putih */
  color: #2c3e50; /* teks tetap gelap */
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f9f9f9; /* abu muda, tetap terang tapi beda */
}

.styled-table tbody tr:hover {
  background-color: #ecf0f1; /* hover warna terang */
}

.styled-table td {
  color: #2c3e50; /* teks gelap fix */
  font-weight: 500;
}


.btn {
  padding: 6px 10px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  margin: 0 3px;
  cursor: pointer;
}

.btn-green {
  background-color: #2ecc71;
  color: white;
}

.btn-blue {
  background-color: #3498db;
  color: white;
}

.btn-red {
  background-color: #e74c3c;
  color: white;
}
</style>
