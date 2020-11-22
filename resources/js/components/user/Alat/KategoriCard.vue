<template>
  <div class="card my-3 mx-1" style="max-width: 540px">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img
          v-bind:src="kategori.gambar"
          class="card-img rounded-circle"
          alt="gambar kategori"
          style="max-width=60px;"
        />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ kategori.nama }}</h5>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "KategoriCard",
  props: {
    kategori: Object,
  },
};
</script>

<style>
</style>