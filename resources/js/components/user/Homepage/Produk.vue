<template>
  <div class="col-lg-3">
    <div class="card">
      <img class="card-img-top" :src="dataProduk.gambar" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">{{ dataProduk.nama }}</h5>
        <p class="card-text">
          {{ dataProduk.harga }}
        </p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Produk",
  props: {
    dataProduk: Object,
  },
};
</script>

<style>
</style>