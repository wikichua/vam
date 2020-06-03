Vue.mixin({
	methods: {
      $settings(key) {
        return Settings[key];
      },
    },
});