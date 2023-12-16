<template>
  <section class="flex mb-2" id="heading">
    <div class="flex-1">
      <h1 class="text-xl">User Manager</h1>
    </div>
    <div class="flex-1 text-right">
      <el-button @click="changeVisibilityState"> Create Record </el-button>
    </div>
  </section>
  <section class="my-1" id="table">
    <el-table :data="props.users.data">
      <el-table-column label="General Information">
        <el-table-column label="Name">
          <template #default="scope">
            <Link
              :href="route('users.show', scope.row)"
              v-if="!scope.row.deleted_at"
              class="flex w-full"
            >
              <div class="flex mr-1 mt-1">
                <el-icon class="cursor-pointer">
                  <Search />
                </el-icon>
              </div>
              <div v-text="fullName(scope.row)" />
            </Link>
            <div v-else class="flex w-full text-red-300">
              <div class="flex mr-1 mt-1">
                <el-icon>
                  <CircleClose />
                </el-icon>
              </div>
              <div>
                <span>{{ fullName(scope.row) }}</span>
              </div>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="Email">
          <template #default="scope">
            <EmailAddress :email="scope.row.email" />
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column label="Chronology">
        <el-table-column label="Created">
          <template #default="scope">
            {{ fromLaravelDate(scope.row.created_at, 'MMM. DD, YYYY hh:mm A') }}
          </template>
        </el-table-column>
        <el-table-column label="Updated">
          <template #default="scope">
            {{ timeAgo(scope.row.updated_at) }}
          </template>
        </el-table-column>
      </el-table-column>
      <el-table-column>
        <el-table-column width="45">
          <template #default="scope">
            <div class="flex">
              <el-tooltip
                v-if="!scope.row.deleted_at"
                content="Disable"
                placement="left"
              >
                <Link
                  :href="route('users.destroy', scope.row)"
                  class="w-full text-center"
                  method="delete"
                  as="button"
                >
                  <el-icon><Delete /></el-icon>
                </Link>
              </el-tooltip>
              <el-tooltip placement="left" content="Enable" v-else>
                <Link
                  :href="route('users.restore', scope.row)"
                  class="w-full text-center"
                  method="put"
                  as="button"
                >
                  <el-icon><Refresh /></el-icon>
                </Link>
              </el-tooltip>
            </div>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>
  </section>

  <section class="mt-1" id="pagination">
    <pagination :links="users.links" />
  </section>

  <!-- Dialog Window -->
  <el-dialog
    :close-auto-focus="changeVisibilityState"
    :close="changeVisibilityState"
    v-model="dialogVisible"
    title="Create User"
  >
    <CreateUserForm to="users" :user="dialogUser" :roles="props.roles" />
  </el-dialog>
</template>

<script setup lang="ts">
import {
  Calendar,
  CircleClose,
  Delete,
  Edit,
  Refresh,
  Search,
  User,
} from '@element-plus/icons-vue'
import CreateUserForm from '@/components/forms/users/create.vue'
import EmailAddress from '@/components/email-address.vue'
import { IPaginatedResults, IRoleRecord, IUserRecord } from '@/types'
import Pagination from '@/components/pagination.vue'
import { dialogStore } from '@/stores/dialog'
import { useUser } from '@/composables/user'
import { useDate } from '@/composables/date'
import { ref } from 'vue'

// props
const props = defineProps<{
  users: IPaginatedResults
  roles: IRoleRecord[]
}>()

// state and composables
const { dialogVisible, changeVisibilityState } = dialogStore()
const { timeAgo, fromLaravelDate } = useDate()
const { fullName } = useUser()

// refs
const dialogUser = ref<object | null>(null)

// modals
const updateUser = (user: IUserRecord) => {
  dialogUser.value = user
  changeVisibilityState()
}
</script>
