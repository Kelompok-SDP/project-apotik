<template>
  <div class="limiter">
    <div class="container-login100">
      <div
        class="login100-more"
        style="background-image: url('images/bg-01.jpg')"
      ></div>

      <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
        <component
          v-bind:is="currentState"
          v-on:go-to-regiter="goToRegiter"
        ></component>
        <!-- <FormLogin v-on:go-to-regiter="goToRegiter" /> -->
      </div>
    </div>
  </div>
</template>

<script>
import FormLogin from "./FormLogin";
import FormRegister from "./FormRegister";
export default {
  name: "Login",
  components: {
    FormLogin: FormLogin,
    FormRegister: FormRegister,
  },
  data() {
    return {
      currentState: "FormLogin",
    };
  },
  methods: {
    goToRegiter(name) {
      this.currentState = name;
      console.log(name);
    },
  },
};
</script>


