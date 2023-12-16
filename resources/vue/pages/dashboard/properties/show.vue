<template>
  <ShowLayout :heading="props.property.name">
    <template #heading-buttons>
      <el-button @click="propertyDialog = !propertyDialog">
        <el-icon>
          <Edit />
        </el-icon>
      </el-button>
      <!--
      <el-button @click="deleteProperty">
        <el-icon>
          <Delete />
        </el-icon>
      </el-button>
      -->
    </template>
    <template #details>
      <el-descriptions-item label="Telephone">
        <PhoneNumber :phone="props.property.phone" />
      </el-descriptions-item>
      <el-descriptions-item label="Address">
        <Address :address="props.property.address" />
      </el-descriptions-item>
      <el-descriptions-item label="Client">
        <Link :href="route('users.show', props.property.client)">
          {{ fullName(props.property.client) }}
        </Link>
      </el-descriptions-item>
      <el-descriptions-item label="Description">
        <div class="text-justify">
          {{ props.property.description }}
        </div>
      </el-descriptions-item>
    </template>
    <template #tabs>
      <el-tab-pane>
        <template #label>
          <Badge :count="props.property.buildings.length"> Buildings </Badge>
        </template>
        <div class="mb-2 text-right">
          <el-button-group>
            <el-button @click="buildingTable.getBuildings()">
              <el-icon>
                <Refresh />
              </el-icon>
            </el-button>
            <el-button :icon="Plus" @click="buildingDialog = !buildingDialog">
              New Record
            </el-button>
          </el-button-group>
        </div>
        <div class="mt-2">
          <BuildingsTable :property="props.property" ref="buildingTable" />
        </div>
      </el-tab-pane>
      <el-tab-pane>
        <template #label>
          <Badge :count="props.property.projects.length"> Projects </Badge>
        </template>
        <div class="mb-2 text-right">
          <el-button-group>
            <el-button @click="projectsTable.getProjects()">
              <el-icon>
                <Refresh />
              </el-icon>
            </el-button>
            <el-button :icon="Plus" @click="projectDialog = !projectDialog">
              New Record
            </el-button>
          </el-button-group>
        </div>
        <div class="mt-2">
          <ProjectsTable :property="props.property" ref="projectsTable" />
        </div>
      </el-tab-pane>
    </template>
    <template #footer>
      <el-dialog v-model="projectDialog" title="Add Project">
        <el-form @submit.prevent="createProject" label-position="top">
          <el-form-item label="Project Name">
            <el-input v-model="projectForm.name"></el-input>
          </el-form-item>

          <el-form-item label="Select Location">
            <el-select v-model="projectForm.building_id" style="width: 100%">
              <el-option
                v-for="item in props.property.buildings"
                :label="item.name"
                :value="item.id"
                :key="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item label="Scheduled For">
            <el-col :span="11">
              <el-date-picker
                style="width: 100%"
                v-model="scheduledDate"
                type="date"
                placeholder="Pick a date"
                @change="generateDate"
                value-format="YYYY-MM-DD"
              />
            </el-col>
            <el-col :span="2" class="" />
            <el-col :span="11">
              <el-time-picker
                style="width: 100%"
                v-model="scheduledTime"
                @change="generateDate"
                placeholder="Pick a time"
                format="hh:mm A"
                value-format="hh:mm"
              />
            </el-col>
            <el-input class="hidden" v-model="projectForm.scheduled_at" />
          </el-form-item>

          <el-form-item label="Description">
            <el-input
              placeholder="Please Enter a Description"
              v-model="projectForm.description"
              type="textarea"
              :rows="4"
            />
            <div class="text-red-400">
              {{ projectForm.errors.description }}
            </div>
          </el-form-item>

          <el-form-item>
            <button type="submit" class="el-button w-full">Submit</button>
          </el-form-item>
        </el-form>
      </el-dialog>

      <!-- Dialog Window -->
      <el-dialog v-model="buildingDialog" title="Add Building">
        <el-form @submit.prevent="createBuilding" label-position="top">
          <el-row>
            <el-col :span="11">
              <el-form-item label="Building Name">
                <el-input
                  placeholder="Building Name"
                  v-model="buildingForm.name"
                  label="Name"
                  size="large"
                />
                <div class="mt-2 text-red-400">
                  {{ buildingForm.errors.name }}
                </div>
              </el-form-item>
            </el-col>
            <el-col :span="2" />
            <el-col :span="11">
              <el-form-item label="Unit Count">
                <el-input-number
                  placeholder="Total Units"
                  v-model="buildingForm.units"
                  class="w-full"
                  label="Units"
                  size="large"
                  :min="1"
                />
                <div class="mt-2 text-red-400">
                  {{ buildingForm.errors.units }}
                </div>
              </el-form-item>
            </el-col>
          </el-row>

          <el-form-item label="Building Description">
            <el-input
              placeholder="Building Description"
              v-model="buildingForm.description"
              type="textarea"
              label="Name"
              size="large"
              :rows="4"
            />
            <div class="flex text-red-400">
              {{ buildingForm.errors.description }}
            </div>
          </el-form-item>

          <el-form-item>
            <button type="submit" class="el-button w-full">Submit</button>
          </el-form-item>
        </el-form>
      </el-dialog>

      <!-- Dialog Windows -->
      <el-dialog v-model="propertyDialog" title="Update Property">
        <el-form @submit.prevent="updateProperty" label-position="top">
          <el-form-item label="Name">
            <el-input
              v-model="propertyForm.name"
              label="Name"
              size="large"
              :placeholder="props.property.name"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.name }}
            </div>
          </el-form-item>

          <el-form-item label="Address">
            <el-input
              :placeholder="props.property.address"
              v-model="propertyForm.address"
              label="Address"
              size="large"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.address }}
            </div>
          </el-form-item>

          <el-form-item label="Phone Number">
            <el-input
              :placeholder="props.property.phone"
              v-maska
              data-maska="1 (###) ###-####"
              v-model="propertyForm.phone"
              label="Phone"
              size="large"
            />
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.phone }}
            </div>
          </el-form-item>

          <el-form-item label="Client">
            <el-select
              :default-first-option="fullName(props.property.client)"
              :placeholder="fullName(props.property.client)"
              v-model="propertyForm.client_id"
              class="w-full"
              size="large"
              filterable
            >
              <el-option
                v-for="item in props.property.clients"
                :label="fullName(item)"
                :value="item.id"
                :key="item.id"
              />
            </el-select>
            <div class="mt-2 text-red-400">
              {{ propertyForm.errors.client_id }}
            </div>
          </el-form-item>

          <el-form-item label="Description">
            <el-input
              :placeholder="props.property.description"
              v-model="propertyForm.description"
              type="textarea"
              :rows="4"
            />
            <div class="my-2 flex text-stone-400">
              <div class="flex text-red-400">
                {{ propertyForm.errors.description }}
              </div>
            </div>
          </el-form-item>

          <el-form-item>
            <button class="el-button w-full">Submit</button>
          </el-form-item>
        </el-form>
      </el-dialog>
    </template>
  </ShowLayout>
</template>

<script setup lang="ts">
import { Edit, Plus, Refresh } from '@element-plus/icons-vue'
import 'element-plus/es/components/message-box/style/css'
import PhoneNumber from '@/components/phone-number.vue'
import ShowLayout from '@/layouts/dashboard/show.vue'
import BuildingsTable from './tables/buildings.vue'
import ProjectsTable from './tables/projects.vue'
import Address from '@/components/address.vue'
import { IPropertyRecord } from '@/types/app'
import { useUser } from '@/composables/user'
import { ElMessageBox } from 'element-plus'
import Badge from '@/components/badge.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

// props
const props = defineProps<{
  property: IPropertyRecord
}>()

// state and composables
const { fullName } = useUser()

// reactive data
let buildingDialog = ref(false)
let propertyDialog = ref(false)
let projectDialog = ref(false)
let humanReadable = ref('')
let scheduledDate = ref('')
let scheduledTime = ref('')
let buildingTable = ref()
let projectsTable = ref()

// forms
const buildingForm = useForm({
  name: '',
  units: 0,
  description: '',
  property_id: props.property.id,
})

const propertyForm = useForm({
  name: null,
  phone: null,
  address: null,
  description: null,
  client_id: null,
})

const projectForm = useForm({
  name: null,
  property_id: props.property.id,
  building_id: null,
  description: null,
  scheduled_at: '',
})

// dialogs
const createBuilding = () => {
  buildingForm.post(route('buildings.store'))
  buildingDialog.value = !buildingDialog.value
  buildingTable.value.getBuildings()
  buildingForm.reset()
}
const createProject = () => {
  projectForm.post(route('projects.store'))
  projectDialog.value = !projectDialog.value
  projectsTable.value.getProjects()
  projectForm.reset()
}
const updateProperty = () => {
  // @ts-ignore
  propertyForm.patch(route('properties.update', props.property))
  propertyDialog.value = !propertyDialog.value
  propertyForm.reset()
}

const deleteProperty = () => {
  ElMessageBox.confirm(
    'You are about to delete this record. Continue?',
    'Warning',
    {
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      type: 'error',
    }
  ).then(() => {
    // @ts-ignore
    propertyForm.delete(route('properties.destroy', props.property))
  })
}

// methods
const generateDate = () => {
  projectForm.scheduled_at = scheduledDate.value + ' ' + scheduledTime.value
  humanReadable.value = scheduledDate.value + ' at ' + scheduledTime.value
}
</script>
