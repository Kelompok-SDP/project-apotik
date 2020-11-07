<template>
  <form class="login100-form validate-form" @submit.prevent="register">
    <span class="login100-form-title p-b-59"> Register </span>

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
        placeholder="Co: contoh@gmail.com"
        v-model="form.email"
      />
    </div>

    <div class="wrap-input100 validate-input">
      <div class="error" v-if="errors.hasOwnProperty('nama')">
        <span class="text-danger" v-if="errors.hasOwnProperty('nama')">
          {{ errors.nama[0] }}
        </span>
      </div>

      <span class="label-input100">Nama</span>
      <input
        class="input100"
        type="text"
        placeholder="Co: Bambang"
        v-model="form.nama"
      />
      <span class="focus-input100"></span>
    </div>

    <div class="wrap-input100 validate-input">
      <div class="error" v-if="errors.hasOwnProperty('noHp')">
        <span class="text-danger" v-if="errors.hasOwnProperty('noHp')">
          {{ errors.noHp[0] }}
        </span>
      </div>

      <span class="label-input100">Nomor HP</span>
      <input
        class="input100"
        type="text"
        placeholder="Co: 085XXX"
        v-model="form.noHp"
      />
      <span class="focus-input100"></span>
    </div>

    <div class="wrap-input100 validate-input">
      <div class="error" v-if="errors.hasOwnProperty('password')">
        <span class="text-danger" v-if="errors.hasOwnProperty('password')">
          {{ errors.password[0] }}
        </span>
      </div>
      <span class="label-input100">Password</span>
      <input class="input100" type="text" v-model="form.password" />
      <span class="focus-input100"></span>
    </div>

    <div
      class="wrap-input100 validate-input"
      data-validate="Repeat Password is required"
    >
      <span class="label-input100">Repeat Password</span>
      <input
        class="input100"
        type="text"
        v-model="form.password_confirmation"
      />
      <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn">
      <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        <button class="login100-form-btn">Register</button>
      </div>

      <router-link to="/login">Ke Halaman Login</router-link>
    </div>
  </form>
</template>

<script>
export default {
  name: "FormRegister",
  data() {
    return {
      form: {
        email: "",
        nama: "",
        noHp: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
    };
  },
  methods: {
    register() {
      this.errors = {};
      let formData = new FormData();
      formData.append("email", this.form.email);
      formData.append("nama", this.form.nama);
      formData.append("noHp", this.form.noHp);
      formData.append("password", this.form.password);
      formData.append("password_confirmation", this.form.password_confirmation);
      axios
        .post("/api/register", formData)
        .then((result) => {
          alert("berhasil register");
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