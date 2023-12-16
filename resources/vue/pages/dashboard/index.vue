<template>
  <section id="heading">
    <div class="flex mb-4">
      <div class="flex">
        <h1 class="text-2xl" v-text="'Dashboard Index'" />
      </div>
      <div class="flex-1 text-right">
        <el-button-group>
          <el-button @click="randomEvent">Random Event</el-button>
        </el-button-group>
      </div>
    </div>
  </section>

  <section>
    <el-row>
      <el-col :lg="8" :md="6" :sm="24">
        <el-card class="box-card" shadow="never">
          <Doughnut :data="doughnutData" :options="options" />
        </el-card>
      </el-col>
      <el-col :span="2" />
      <el-col :span="14">
        <el-card class="box-card" shadow="never">
          <Line :data="lineData" :options="options" />
        </el-card>
      </el-col>
    </el-row>
  </section>
</template>

<script setup lang="ts">
import { IBuildingRecord, IPropertyRecord } from '@/types/app'
import { Doughnut, Line } from 'vue-chartjs'
import { IUserRecord } from '@/types'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  ArcElement,
} from 'chart.js'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  ArcElement,
  Tooltip,
  Legend,
  Title
)

const props = defineProps<{
  clients: IUserRecord[]
  properties: IPropertyRecord[]
  buildings: IBuildingRecord[]
}>()

const doughnutData = {
  labels: ['Clients', 'Properties', 'Buildings'],
  datasets: [
    {
      backgroundColor: ['#41B883', '#00D8FF', '#DD1B16'],
      data: [
        props.properties.length,
        props.buildings.length,
        props.clients.length,
      ],
    },
  ],
}

const lineData = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  datasets: [
    {
      label: 'Work Orders (Last Six Months)',
      backgroundColor: '#DD1B16',
      data: [40, 39, 10, 40, 39, 80, 40],
    },
    {
      label: 'Requests (Last Six Months)',
      backgroundColor: '#00D8FF',
      data: [25, 20, 30, 15, 20, 60, 50],
    },
  ],
}

const options = {
  responsive: true,
  maintainAspectRatio: false,
}

const randomEvent = () =>
  ElNotification({
    message: 'This is a random event!',
    type: 'info',
  })
</script>
