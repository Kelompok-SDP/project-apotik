<template>
  <div class="limiter">
    <div class="container-login100">
      <div
        class="login100-more"
        style="
          background-image: url('https://bralowmedicalgroup.com/wp-content/uploads/2018/06/blog.jpg');
        "
      ></div>

      <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
        <FormRegister />
      </div>
    </div>
  </div>
</template>

<script>
import FormRegister from "./FormRegister";
export default {
  name: "Register",
  components: {
    FormRegister: FormRegister,
  },
  data() {
    return {
      //   codehere
    };
  },
  methods: {},
};
</script>

<style scoped>
@import "/css/login&register/css/main.css";
@import "/css/login&register/css/util.css";
</style>