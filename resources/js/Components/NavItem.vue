<script>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export default {
  name: 'NavItem',
  components: { Link },
  props: {
    routeName: String,
    routeParams: {
      type: [Object, Array],
      default: () => ({}),
    },
    label: String,
    icon: {
      type: String,
      default: 'fas fa-circle',
    },
  },
  setup(props) {
    const page = usePage();
    const isActive = computed(() => {
      const url = route(props.routeName, props.routeParams, false);
      return page.url.startsWith(url);
    });
    return { route, isActive };
  },
};
</script>
