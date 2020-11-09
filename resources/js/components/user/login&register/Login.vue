<template>
  <div class="limiter">
    <div class="container-login100">
      <div
        class="login100-more"
        style="background-image: url('images/bg-01.jpg')"
      ></div>

      <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
        <FormLogin />
      </div>
    </div>
  </div>
</template>

<script>
import FormLogin from "./FormLogin";
export default {
  name: "Login",
  components: {
    FormLogin: FormLogin,
  },
  data() {
    return {
      // code here
    };
  },
  methods: {},
};
</script>

<style scoped>
@import "/css/login&register/css/main.css";
@import "/css/login&register/css/util.css";
/* @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,700;1,700&display=swap");
.login100-form-title {
  font-family: "Poppins", sans-serif;
} */
</style>