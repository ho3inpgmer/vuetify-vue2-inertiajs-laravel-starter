import { debounce, isEmpty } from 'lodash'

export default {
  props: ['tableProps'],
  data(){
    return {
      showAdvancedSearch: !isEmpty(this.tableProps.filters),
    }
  },
  watch: {
    filters: {
      handler: debounce(function(){
        let filters = this.filters

        Object.keys(filters).forEach(key => {
          if(filters[key] === "" || filters[key] == null){
            delete filters[key]
          }
        })

        this.$inertia.get(this.tableProps.url,filters,{
          replace: true,
          preserveState: true,
          preserveScroll: true,
        })
      },500),
      deep: true
    }
  },
  computed: {
    tableRest(){
      return {
        sortBy: this.tableProps.sortBy,
        sortDesc: this.tableProps.hasOwnProperty('sortDesc') ? this.tableProps.sortDesc === "true" : null,
        global: this.tableProps.global,
      }
    }
  }
}
