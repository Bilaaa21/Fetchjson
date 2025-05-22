<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Login</ion-title>
      </ion-toolbar>
    </ion-header>

   <ion-content class="ion-padding">
  <div class="login-container">
    <h1 class="login-title">📚 Sistem Perpustakaan</h1>
    <p class="login-subtitle">Silakan login untuk melanjutkan</p>

    <ion-item class="custom-item">
      <ion-label position="floating">Username</ion-label>
      <ion-input v-model="username" required></ion-input>
    </ion-item>

    <ion-item class="custom-item">
      <ion-label position="floating">Password</ion-label>
      <ion-input type="password" v-model="password" required></ion-input>
    </ion-item>

    <ion-button expand="block" shape="round" color="primary" @click="login">
      🔐 Login
    </ion-button>

    <ion-text color="danger" v-if="errorMessage">
      <p class="error-text">{{ errorMessage }}</p>
    </ion-text>
  </div>
</ion-content>
  </ion-page>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonTitle,
  IonContent,
  IonItem,
  IonLabel,
  IonInput,
  IonButton,
  IonText,
} from '@ionic/vue'

const username = ref('')
const password = ref('')
const errorMessage = ref('')
const router = useRouter()

const login = async () => {
  errorMessage.value = ''

  try {
    const response = await fetch('http://localhost/belajar-api/login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        username: username.value,
        password: password.value
      })
    })

    const result = await response.json()

    if (result.status === 'success') {
      localStorage.setItem('user', JSON.stringify(result.data))
      router.push('/posts')
      // ganti sesuai rute tujuan setelah login
    } else {
      errorMessage.value = 'Username atau password salah.'
    }
  } catch (error) {
    errorMessage.value = 'Terjadi kesalahan saat login.'
  }
}
</script>
<style scoped>
.login-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
  max-width: 400px;
  margin: auto;
  text-align: center;
}

.login-title {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 8px;
  color: #2c3e50;
}

.login-subtitle {
  font-size: 16px;
  color: #7f8c8d;
  margin-bottom: 30px;
}

.custom-item {
  margin-bottom: 20px;
  --highlight-color-focused: #1abc9c;
  --border-color: #bdc3c7;
  --border-radius: 8px;
}

ion-button {
  margin-top: 10px;
  font-weight: bold;
  letter-spacing: 0.5px;
}

.error-text {
  margin-top: 12px;
  font-size: 14px;
}

</style>