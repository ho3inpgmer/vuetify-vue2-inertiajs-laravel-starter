<template>
  <v-row class="match-height">
    <v-col
      cols="12"
      md="12"
    >
      <v-card>
        <v-card-title class="d-flex align-center subtitle-1 font-weight-black">
          افزودن
        </v-card-title>
        <v-card-text>
          <v-form @submit.prevent="submit" ref="form">
            <v-row>

              <v-col cols="3">
                <v-text-field
                  v-model="form.name"
                  :error-messages="form.errors.name"
                  label="نام"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="3">
                <v-text-field
                  v-model="form.username"
                  :error-messages="form.errors.username"
                  label="نام کاربری"
                  outlined
                  dense
                ></v-text-field>
              </v-col>

              <v-col cols="3">
                <v-text-field
                  v-model="form.password"
                  :error-messages="form.errors.password"
                  label="رمز عبور"
                  outlined
                  dense
                ></v-text-field>
              </v-col>

              <v-col cols="3">
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
        </v-card-text>
      </v-card>
    </v-col>

  </v-row>
</template>

<script>

export default {
  name: "Users",
  data() {
    return {
      remember: "form",
      form: this.$inertia.form({
        name: null,
        username: null,
        password: null,
        type: null,
      }),
    }
  },
  methods: {
    submit() {
      this.form.post(this.$route("users.store"), {
        onSuccess: () => this.resetForm(this.form),
      })
    },
  },
}
</script>
