<template>
  <section>
    <el-divider></el-divider>
  </section>
  <section
    class="max-w-screen-xl px-4 py-4 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8"
  >
    <nav class="flex flex-wrap justify-center -mx-5 -my-2">
      <div class="px-5 py-2">
        <Link :href="route('home.index')" class="footer-link"> Home </Link>
      </div>
      <div class="px-5 py-2">
        <Link :href="route('about.index')" class="footer-link"> About </Link>
      </div>
      <div class="px-5 py-2">
        <Link :href="route('contact.index')" class="footer-link">
          Contact
        </Link>
      </div>
      <div class="px-5 py-2">
        <Link :href="route('services.index')" class="footer-link">
          Services
        </Link>
      </div>
      <div class="px-5 py-2">
        <Link :href="route('charity.index')" class="footer-link">
          Charity
        </Link>
      </div>
      <div class="px-5 py-2">
        <Link :href="route('legal.index')" class="footer-link"> Legal </Link>
      </div>
      <div class="px-5 py-2 cursor-pointer">
        <Link
          :href="route('login.index')"
          v-if="!$page.props.auth.user"
          v-text="'Login'"
        />
        <Link
          :href="route('login.destroy')"
          v-text="'Logout'"
          method="POST"
          as="button"
          v-else
        />
      </div>
    </nav>
    <p class="mt-8 footer-link text-center">
      © {{ currentYear }} {{ appName }} - All rights reserved
    </p>
    <div class="flex justify-center mt-8 space-x-6 text-xs">
      <ul>
        <li class="footer-item cursor-pointer">
          <DarkMode>
            <template #light>Dark Mode</template>
            <template #dark>Light Mode</template>
          </DarkMode>
        </li>
      </ul>
    </div>
  </section>
</template>

<script setup lang="ts">
import DarkMode from '@/components/dark-mode.vue'
import { useDate } from '@/composables/date'
import { useApp } from '@/composables/app'

// state and composables
const { currentYear } = useDate()
const { appName } = useApp()
</script>

<style scoped>
.footer-link {
  @apply text-base leading-6;
}

.footer-item {
  @apply inline-block mx-2;
}
</style>
