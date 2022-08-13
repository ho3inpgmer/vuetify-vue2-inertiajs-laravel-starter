<template>
  <v-btn-toggle
    dense
    active-class="no-active"
  >

    <v-btn
      elevation="0"
      v-for="(link, key) in links"
      :class="{'active-page-dark': link.active && $vuetify.theme.dark,'active-page': link.active && !$vuetify.theme.dark}"
      :key="key"
      small
      :disabled="link.url === null && link.label !== '...'"
      v-html="link.label"
      @click="changePage(link.url)"
    >
    </v-btn>

  </v-btn-toggle>
</template>

<script>
export default {
  name: "Pagination",
  props: ['links'],
  methods: {
    changePage(url){
      this.$inertia.visit(url,{
        replace: false,
        preserveState: true,
        preserveScroll: true,
      })
    }
  }
}
</script>

<style scoped>
.active-page{
  background: rgba(209, 209, 209, 0.99) !important
}
.active-page-dark{
  background: #252121 !important
}
.v-btn--active.no-active::before {
  opacity: 0 !important;
}
.v-btn:not(.v-btn--round).v-size--small{
  min-width: 35px !important
}
</style>
