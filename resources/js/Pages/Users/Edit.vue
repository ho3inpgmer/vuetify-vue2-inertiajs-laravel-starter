<template>
  <v-row class="match-height">
    <v-col
      cols="12"
      md="12"
    >
      <v-form @submit.prevent="submit" ref="form">
        <v-row>

          <v-col cols="4">
            <v-text-field
              v-model="form.name"
              :error-messages="form.errors.name"
              label="نام"
              outlined
              dense
            ></v-text-field>
          </v-col>

          <v-col cols="4">
            <v-text-field
              v-model="form.username"
              :error-messages="form.errors.username"
              label="نام کاربری"
              outlined
              dense
            ></v-text-field>
          </v-col>

          <v-col cols="4">
            <v-select
              :items="user.types"
              v-model="form.type"
              :error-messages="form.errors.type"
              label="نقش کاربری"
              dense
              outlined
              clearable
            ></v-select>
          </v-col>

          <v-col cols="12" class="d-flex justify-end">
            <v-btn
              @click="resetForm(form)"
              class="ml-2"
              outlined
            >
              پاکسازی
            </v-btn>
            <v-btn
              type="submit"
              :loading="form.processing"
              color="success"
            >
              ثبت
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
    </v-col>
  </v-row>
</template>

<script>

export default {
  name: "EditUser",
  props: ['record'],
  emits: ['close'],
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        username: null,
        type: null,
      }),
    }
  },
  watch: {
    record: {
      immediate: true,
      handler(){
        this.form.name = this.record.name
        this.form.username = this.record.username
        this.form.type = this.record.type
      },
      deep: true
    }
  },
  methods: {
    submit() {
      this.form.patch(this.$route("users.update",this.record.id), {
        onSuccess: () => this.$emit('close'),
      })
    },
  },
}
</script>
