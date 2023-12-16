<template>
  <el-menu mode="horizontal" :ellipsis="false">
    <el-menu-item class="cursor-default">
      {{ appName }}
    </el-menu-item>
    <div class="flex-grow" />
    <el-menu-item index="0">
      <Link :href="route('dashboard.index')">
        <el-icon>
          <House />
        </el-icon>
      </Link>
    </el-menu-item>
    <el-sub-menu index="1" v-if="can('manage_users')">
      <template #title>
        <el-icon>
          <User />
        </el-icon>
      </template>
      <el-menu-item index="1-1">
        <Link
          :href="route('users.index')"
          v-text="'Permissions'"
          class="w-full"
        />
      </el-menu-item>
      <el-menu-item index="1-2">
        <Link :href="route('users.index')" v-text="'Roles'" class="w-full" />
      </el-menu-item>
      <el-menu-item index="1-3">
        <Link :href="route('users.index')" v-text="'Users'" class="w-full" />
      </el-menu-item>
    </el-sub-menu>
    <el-sub-menu
      index="2"
      v-if="can(['manage_properties', 'manage_buildings'])"
    >
      <template #title>
        <el-icon>
          <OfficeBuilding />
        </el-icon>
      </template>
      <el-menu-item index="2-1">
        <Link
          :href="route('properties.index')"
          v-text="'Properties'"
          class="w-full"
        />
      </el-menu-item>
      <el-menu-item index="2-2">
        <Link
          :href="route('buildings.index')"
          v-text="'Buildings'"
          class="w-full"
        />
      </el-menu-item>
    </el-sub-menu>
    <el-sub-menu
      v-if="can(['manage_categories', 'manage_projects', 'manage_tasks'])"
      index="3"
    >
      <template #title>
        <el-icon>
          <Tickets />
        </el-icon>
      </template>
      <el-menu-item index="3-1" v-if="can('manage_categories')">
        <Link
          :href="route('categories.index')"
          v-text="'Categories'"
          class="w-full"
        />
      </el-menu-item>
      <el-menu-item index="3-2" v-if="can('manage_projects')">
        <Link
          :href="route('projects.index')"
          v-text="'Projects'"
          class="w-full"
        />
      </el-menu-item>
      <el-menu-item index="3-3" v-if="can('manage_tasks')">
        <Link :href="route('tasks.index')" v-text="'Tasks'" class="w-full" />
      </el-menu-item>
    </el-sub-menu>
    <el-menu-item index="4" v-if="can('view_telescope')">
      <a :href="route('telescope')" target="_blank" class="w-full">
        <el-icon><DataAnalysis /></el-icon>
      </a>
    </el-menu-item>
  </el-menu>
</template>

<script lang="ts" setup>
import {
  DataAnalysis,
  DataBoard,
  House,
  OfficeBuilding,
  Tickets,
  User,
} from '@element-plus/icons-vue'
import { useAuth } from '@/composables/auth'
import { useUser } from '@/composables/user'
import { useApp } from '@/composables/app'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

// state and composables
const { can } = useAuth()
const { fullName } = useUser()
const page = usePage()
const { appName, env } = useApp()

const greetingName = computed(() =>
  // @ts-ignore
  page.props.auth.user ? fullName(page.props.auth.user) : 'Guest'
)
</script>

<style scoped>
.flex-grow {
  flex-grow: 1;
}
</style>
