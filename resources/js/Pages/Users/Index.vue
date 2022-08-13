<template>
  <div>
    <v-banner class="mb-4">
      <div class="d-flex flex-wrap justify-space-between">
        <h5 class="text-h5 font-weight-bold">مدیریت کاربران</h5>
<!--        <v-breadcrumbs :items="breadcrumbs" class="pa-0"></v-breadcrumbs>-->
      </div>
    </v-banner>
    <Create></Create>
    <v-row class='match-height'>
      <v-col
        cols='12'
        md='12'
      >
        <v-card>
          <v-card-text>
            <v-row class="align-center">
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="filters.global"
                  label="جستجو کاربران"
                  append-icon="mdi-magnify"
                  hide-details
                  dense
                  outlined
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="9" >
                <v-btn
                  text
                  small
                  v-model="showAdvancedSearch"
                  active-class="light-blue--text"
                  @click="showAdvancedSearch = !showAdvancedSearch"
                >
                  <v-icon left small>
                    mdi-magnify-expand
                  </v-icon>
                  جستجو پیشرفته
                </v-btn>
                <v-btn
                  text
                  small
                  @click="filters = resetObject(filters, () => showAdvancedSearch = false)"
                >
                  <v-icon left small>
                    mdi-close
                  </v-icon>
                  پاکسازی
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          <v-row>
            <v-col cols="12">
              <v-expand-transition>
                <div v-show="showAdvancedSearch" class="grey lighten-5">
                  <v-container fluid>

                    <v-row>

                      <v-col cols="3">
                        <v-text-field
                          v-model="filters.name"
                          hide-details
                          label="نام"
                          outlined
                          dense
                        ></v-text-field>
                      </v-col>

                      <v-col cols="3">
                        <v-text-field
                          v-model="filters.username"
                          hide-details
                          label="نام کاربری"
                          outlined
                          dense
                        ></v-text-field>
                      </v-col>

                      <v-col cols="3">
                        <v-select
                          v-model="filters.type"
                          hide-details
                          :items="user.types"
                          label="نقش کاربری"
                          dense
                          outlined
                          clearable
                        ></v-select>
                      </v-col>
                    </v-row>

                  </v-container>
                </div>
              </v-expand-transition>

              <v-data-table
                :items="records.data"
                :headers="headers"
                :sort-by.sync="filters.sortBy"
                :sort-desc.sync="filters.sortDesc"
                :server-items-length="records.total"
                hide-default-footer
                dense
              >
                <template v-slot:item.action="{ item }">
                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn @click="editDialog = true" v-bind="attrs" v-on="on" color="primary" small icon>
                        <v-icon small>
                          mdi-pencil-outline
                        </v-icon>
                      </v-btn>
                    </template>
                    <span>ویرایش</span>
                  </v-tooltip>
                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn v-bind="attrs" v-on="on" color="error" small icon>
                        <v-icon small>
                          mdi-delete-outline
                        </v-icon>
                      </v-btn>
                    </template>
                    <span>ویرایش</span>
                  </v-tooltip>
                </template>
                <template #footer>
                  <div class="d-flex align-center justify-space-between ma-2">
                    <div class="d-flex align-center justify-space-between text-xs">
                      {{ records.from }} تا {{ records.to }} از {{ records.total }} رکورد
                    </div>
                    <Pagination :links="records.links"></Pagination>
                  </div>
                </template>
              </v-data-table>
            </v-col>
          </v-row>
        </v-card>
      </v-col>

    </v-row>
    <v-dialog
      v-model="editDialog"
      max-width="1000"
    >
      <v-card>
        <v-card-title class="text-h6 text-center">
          آیا مطمئن به حذف هستید؟
        </v-card-title>

        <v-card-text>
          Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="dialog = false"
          >
            Disagree
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="dialog = false"
          >
            Agree
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import Admin from '@Pages/layouts/Admin'
import Pagination from '@Pages/Components/Pagination'
import Create from './Create'
import { Link } from '@inertiajs/inertia-vue'
import table from '@/mixins/table'

export default {
  name: 'Index',
  mixins: [table],
  layout: Admin,
  props: ['records'],
  components: {
    Create,
    Link,
    Pagination,
  },
  data(){
    return {
      editDialog: false,
      filters: {
        name: this.tableProps.filters.name,
        username: this.tableProps.filters.username,
        type: this.tableProps.filters.type,
        global: this.tableProps.global,
        ...this.tableRest,
      },
      headers: [
        { text: "شناسه", value: "id"},
        { text: "نام", value: "name" },
        { text: "نام کاربری", value: "username" },
        { text: "نقش کاربری", value: "type" },
        { text: "تاریخ ایجاد", value: "created_at" },
        { text: "عملیات", value: "action", sortable: false },
      ],
    }
  }
}
</script>
