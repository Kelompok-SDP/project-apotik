<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="https://picsum.photos/200"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="https://picsum.photos/200"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <span class="d-block" style="color: white">Nama dari tabel info</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview" @click="setCurrent('Kategori')">
            <span class="nav-link" style="color: white">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Kategori
                <i class="fas fa-angle-left right"></i>
              </p>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview" @click="setCurrent('Obat')">
            <span class="nav-link" style="color: white">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Obat
                <i class="fas fa-angle-left right"></i>
              </p>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview">
            <router-link class="nav-link" style="color: white" to="/">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Logout
                <i class="fas fa-angle-left right"></i>
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  props: {},
  data() {
    return {
      currentState: "",
    };
  },
  methods: {
    setCurrent(value) {
      this.currentState = value;
      this.$emit("click", this.currentState);
    },
  },
};
</script>

<style scoped>
</style>
    