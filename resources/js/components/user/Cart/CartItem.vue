<template>
  <div class="d-flex justify-content-between mt-3">
    <div class="col-6">
      <div class="row">
        <div class="col-2">
          <img
            v-bind:src="dataCart.gambar"
            alt=""
            class="rounded-circle"
            width="46px;"
            height="46px;"
          />
        </div>
        <div class="col-10">
          <div class="row ml-2">
            <strong>{{ dataCart.nama }} </strong>
          </div>
          <div class="row ml-2">
            <small>Per Botol</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <button
        class="btn btn-sm btn-outline-danger rounded col-3 btn-xsm"
        @click="minJumlah"
      >
        -
      </button>
      <span class="col-6">{{ dataCart.jumlah }} </span>
      <button
        class="btn btn-sm btn-outline-danger rounded col-3 btn-xsm"
        @click="addJumlah"
      >
        +
      </button>
    </div>
    <div class="col-3">Rp {{ dataCart.harga }}</div>
  </div>
</template>

<script>
export default {
  name: "Produk",
  props: {
    dataCart: Object,
  },
  methods: {
    addJumlah() {
      let jumlah = parseInt(this.dataCart.jumlah);
      jumlah++;
      this.dataCart.jumlah = jumlah.toString();
    },
    minJumlah() {
      if (this.dataCart.jumlah - 1 > 0) {
        let jumlah = parseInt(this.dataCart.jumlah);
        jumlah--;
        this.dataCart.jumlah = jumlah.toString();
      }
    },
  },
};
</script>

<style>
.btn-xsm {
  width: 2rem;
  height: 2rem;
}
</style>