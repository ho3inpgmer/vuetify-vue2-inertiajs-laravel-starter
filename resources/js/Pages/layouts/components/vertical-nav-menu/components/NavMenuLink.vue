<template>
  <v-list-item @click="goToPage($attrs.to)" class="vertical-nav-menu-link"
               active-class="cyan lighten-5" :class="{'light-blue lighten-5 light-blue--text': $page.component === component}">
    <v-list-item-icon>
      <v-icon :class="{ 'alternate-icon-small': !icon, 'light-blue--text': $page.component === component }" class='mx-auto'>
        {{ icon || alternateIcon }}
      </v-icon>
    </v-list-item-icon>

    <v-list-item-title>
      {{ title }}
    </v-list-item-title>
  </v-list-item>
</template>

<script>
import { mdiCheckboxBlankCircleOutline } from '@mdi/js'
import { Link } from '@inertiajs/inertia-vue'

export default {
  components: {
    Link,
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      default: undefined,
    },
    component: {
      type: String,
      default: undefined
    }
  },
  setup() {
    return {
      alternateIcon: mdiCheckboxBlankCircleOutline,
    }
  },
  methods: {
    goToPage(page) {
      console.log(page)
      this.$inertia.visit(this.$route(page))
    },
  },
}
</script>

<style lang='scss' scoped>
@import '@resources/sass/preset/mixins.scss';

.alternate-icon-small {
  font-size: 14px;
  height: 16px;
  width: 16px;
}

.vertical-nav-menu-link {
  &.v-list-item--active {
    box-shadow: 0 5px 10px -4px rgba(94, 86, 105, 0.42);
    @include elevationTransition();
  }
}
</style>
