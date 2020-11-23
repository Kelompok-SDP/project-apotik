<template>
  <div>
    <div class="row mr-2" style="max-height: 90px">
      <img
        :src="data.gambar"
        :alt="'Gambar ' + data.nama"
        class="img-thumbnail col-2"
      />
      <div class="col-8" style="word-break: break-all; white-space: normal">
        <div @click="getLink" style="cursor: pointer">
          <router-link :to="'/alat/' + data.id">
            <strong>{{ data.nama }} </strong>
          </router-link>
        </div>
      </div>
    </div>

    <div class="col-12" style="word-break: break-all; white-space: normal">
      <p>
        {{ data.deskripsi }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProdukRelated",
  props: {
    data: Object,
  },
  methods: {
    getLink() {
      this.$emit("load-data");
    },
  },
};
</script>

<style scoped>
img {
  max-width: 90px;
  max-height: 90px;
}
</style>
