<template>
  <div class="card">
    <img class="card-img-top" :src="dataProduk.gambar" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">{{ dataProduk.title }}</h5>
      <p class="card-text">{{ dataProduk.content }}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "Artikel",
  props: {
    dataProduk: Object,
  },
  mounted() {
    this.cutString();
  },
  methods: {
    cutString() {
      if (this.dataProduk.content.length > 50) {
        this.dataProduk.content =
          this.dataProduk.content.substring(0, 50) + "...";
      }
    },
  },
};
</script>

<style>
</style>