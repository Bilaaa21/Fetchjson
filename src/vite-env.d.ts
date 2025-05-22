/// <reference types="vite/client" />
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue({
    template: {
      compilerOptions: {
        // Tangani semua elemen dengan prefix 'ion-' sebagai custom elements
        isCustomElement: tag => tag.startsWith('ion-')
      }
    }
  })]
})

