<template>
  <h1>halo,{{ isLogin.nama }}</h1>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      isLogin: {},
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("/api/home")
        .then((result) => {
          this.isLogin = result.data;
          console.log(result.data);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>