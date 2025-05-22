<script setup>
import axios from 'axios';
import { defineProps } from 'vue';
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
    post: Object
});

const deletePost = async (postId) => {
    try {
        const confirmed = window.confirm('Are you sure you want to delete this post?');
        if (confirmed) {
            await axios.delete(`http://localhost/belajar-api/delete-data.php?id=${postId}`);
            router.push('/'); // kembali ke list posts
        }
    } catch (error) {
        console.error("Error deleting post: ", error);
    }
}
</script>
<template>
    <tr>
        <td>{{ post.student_id }}</td>
        <td>{{ post.student_no }}</td>
        <td>{{ post.student_name }}</td>
        <td>{{ post.student_class }}</td>
        <td>
            <RouterLink :to="`/posts/${post.student_id}`" class="btn btn-green">👁️</RouterLink>
  <RouterLink :to="`/posts/edit/${post.student_id}`" class="btn btn-blue">✏️</RouterLink>
  <button @click="deletePost(post.student_id)" class="btn btn-red">🗑️</button>
        </td>
    </tr>
</template>