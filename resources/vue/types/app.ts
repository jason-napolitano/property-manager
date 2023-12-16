import { IDatabaseRecord, IUserRecord } from '@/types'

export interface IPropertyRecord extends IDatabaseRecord {
  buildings: IBuildingRecord[]
  projects: IProjectRecord[]
  clients: IUserRecord[]
  client: IUserRecord
  description: string
  address: string
  client_id: string
  phone: string
}

export interface IBuildingRecord extends IDatabaseRecord {
  projects: IDatabaseRecord[]
  property_id: string
  property: IPropertyRecord
  description: string
  units: number
}

export interface ICategoryRecord extends IDatabaseRecord {
  description: null | string
}

export interface ITaskRecord extends IDatabaseRecord {
  description: string
  category_id: string
}

export interface IProjectRecord extends IDatabaseRecord {
  notes: string
  description: string
  is_paid: boolean
  building_id: string
  employee_id: string
  scheduled_at: string
  completed_at: string
}
