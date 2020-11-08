<template>
  <form class="login100-form validate-form" @submit.prevent="login">
    <span class="login100-form-title p-b-59"> Login </span>

    <div class="wrap-input100 validate-input">
      <div class="error" v-if="errors.hasOwnProperty('email')">
        <span class="text-danger" v-if="errors.hasOwnProperty('email')">
          {{ errors.email[0] }}
        </span>
      </div>
      <span class="label-input100">Email</span>
      <input
        class="input100"
        type="text"
        name="email"
        placeholder="Co: contoh@gmail.com"
        v-model="form.email"
      />
      <span class="focus-input100"></span>
    </div>

    <div class="wrap-input100 validate-input">
      <div class="error" v-if="errors.hasOwnProperty('password')">
        <span class="text-danger" v-if="errors.hasOwnProperty('password')">
          {{ errors.password[0] }}
        </span>
        <br />
      </div>
      <span class="label-input100">Password</span>
      <input class="input100" type="text" v-model="form.password" />
      <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn">
      <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        <button class="login100-form-btn">Login</button>
      </div>

      <router-link to="/register">Go To Register</router-link>
    </div>
  </form>
</template>

<script>
export default {
  name: "FormLogin",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      errors: {},
    };
  },
  methods: {
    login() {
      this.errors = {};
      let formData = new FormData();
      formData.append("email", this.form.email);
      formData.append("password", this.form.password);
      axios
        .post("/login", formData)
        .then((result) => {
          if (result.data == "user tidak ada") {
            alert(result.data);
          } else {
            console.table(result.data);
            this.$router.push("/");
          }
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        });
    },
  },
};
</script>

<style scoped>
/* @import "/css/login&register/css/main.css";
@import "/css/login&register/css/util.css";
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,700;1,700&display=swap"); */
/* .login100-form-title {
  color: red;
} */
</style>