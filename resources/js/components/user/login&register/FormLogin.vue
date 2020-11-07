<template>
  <form class="login100-form validate-form" @submit.prevent="">
    <span class="login100-form-title p-b-59"> Login </span>

    <div class="wrap-input100 validate-input" data-validate="Name is required">
      <span class="label-input100">Full Name</span>
      <input class="input100" type="text" name="name" placeholder="Name..." />
      <span class="focus-input100"></span>
    </div>

    <div
      class="wrap-input100 validate-input"
      data-validate="Valid email is required: ex@abc.xyz"
    >
      <span class="label-input100">Email</span>
      <input
        class="input100"
        type="text"
        name="email"
        placeholder="Email addess..."
      />
      <span class="focus-input100"></span>
    </div>

    <div
      class="wrap-input100 validate-input"
      data-validate="Username is required"
    >
      <span class="label-input100">Username</span>
      <input
        class="input100"
        type="text"
        name="username"
        placeholder="Username..."
      />
      <span class="focus-input100"></span>
    </div>

    <div
      class="wrap-input100 validate-input"
      data-validate="Password is required"
    >
      <span class="label-input100">Password</span>
      <input
        class="input100"
        type="text"
        name="pass"
        placeholder="*************"
      />
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
        name="repeat-pass"
        placeholder="*************"
      />
      <span class="focus-input100"></span>
    </div>

    <div class="flex-m w-full p-b-33">
      <div class="contact100-form-checkbox">
        <input
          class="input-checkbox100"
          id="ckb1"
          type="checkbox"
          name="remember-me"
        />
      </div>
    </div>

    <div class="container-login100-form-btn">
      <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        <button class="login100-form-btn">Sign Up</button>
      </div>

      <button @click="$emit('go-to-regiter', 'FormRegister')">
        Go To Register
      </button>
      <!-- <a
        href="#"
        class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30"
        
      >
        Sign in
        <i class="fa fa-long-arrow-right m-l-5"></i>
      </a> -->
    </div>
  </form>
</template>

<script>
export default {
  name: "FormLogin",
  methods: {},
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,700;1,700&display=swap");
.login100-form-title {
  font-family: "Poppins", sans-serif;
}
</style>