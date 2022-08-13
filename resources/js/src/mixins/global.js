export default {
  data(){
    return {
      user: {
        types: [
          {
            text: "کاربر",
            value: "USER",
          },
          {
            text: "ادمین",
            value: "ADMIN",
          },
          {
            text: "ادمین اصلی",
            value: "SUPERADMIN",
          },
        ]
      },
    }
  },
  methods: {
    resetForm(form) {
      form.reset();
    },
    resetObject(obj,extra) {
      let temp = obj
      Object.keys(obj).forEach(key => {
        temp[key] = null
      })
      extra()
      return temp
    }
  }
}
