<template>
  <section id="heading">
    <div class="flex mb-4">
      <div class="flex">
        <h1 class="text-2xl" v-text="props.heading" />
      </div>
      <div class="flex-1 text-right">
        <el-button-group>
          <slot name="heading-buttons" />
        </el-button-group>
      </div>
    </div>
  </section>

  <section id="after-heading">
    <slot name="after-heading" />
  </section>

  <section id="details" v-if="showDescription">
    <el-descriptions border size="large" :column="descriptionColumns">
      <slot name="details"></slot>
    </el-descriptions>
  </section>

  <section id="after-details">
    <slot name="after-details" />
  </section>

  <section id="tabs" v-if="showTabs">
    <el-tabs type="border-card">
      <slot name="tabs" />
    </el-tabs>
  </section>

  <section id="after-tabs">
    <slot name="after-tabs" />
  </section>

  <section id="footer">
    <slot name="footer" />
  </section>

  <section id="after-footer">
    <slot name="after-footer" />
  </section>
</template>

<script setup lang="ts">
interface LayoutProps {
  descriptionColumns?: number
  showDescription?: boolean
  showTabs?: boolean
  heading?: string
}

const props = withDefaults(defineProps<LayoutProps>(), {
  descriptionColumns: 3,
  showDescription: true,
  showTabs: true,
  heading: '',
})
</script>

<style scoped lang="scss">
section {
  @apply mt-0 mb-4;
}
</style>
