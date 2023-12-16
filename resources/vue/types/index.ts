import { IProjectRecord, IPropertyRecord } from '@/types/app'

export interface IDatabaseRecord {
  id: string
  name: string
  created_at: string
  updated_at: string
  deleted_at: string
}

export interface IUserRecord extends IDatabaseRecord {
  properties: IPropertyRecord[]
  projects: IProjectRecord[]
  first_name: string
  last_name: string
  password: string
  password_confirmation: string
  email: string
  phone: string
}

export interface IRoleRecord extends IDatabaseRecord {
  name: string
}

export interface IPermissionRecord extends IDatabaseRecord {
  name: string
}

export interface IPaginatedResults {
  data: IDatabaseRecord[]
  links: object[]
}
