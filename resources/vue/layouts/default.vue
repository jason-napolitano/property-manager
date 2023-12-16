<template>
  <Head :title="props.title" />
  <main class="md:container px-4">
    <header class="mb-4">
      <NavigationBar />
    </header>
    <section>
      <article class="p-0.5">
        <FlashMessage class="mb-2" />
        <slot />
      </article>
    </section>

    <footer>
      <FooterNav />
    </footer>
  </main>
</template>

<script setup lang="ts">
import FlashMessage from '@/components/flash-message.vue'
import NavigationBar from '../components/navigation.vue'
import FooterNav from '@/components/footer-nav.vue'
import { Head } from '@inertiajs/vue3'
import { withDefaults } from 'vue'

// props
const props = withDefaults(
  defineProps<{
    title?: string
  }>(),
  {
    title: '',
  }
)
</script>
