<template>
  <div class="col-12">
    <div class="row" v-if="listCart.length == 0">
      <span class="h2 text-center">Belum ada item pada keranjang belanja</span>
    </div>
    <div class="row" v-for="cart in listCart" :key="cart.id">
      <div class="col-3">{{ cart.nama }}</div>
      <div class="col-3">{{ cart.jumlah }}x</div>
      <div class="col-3">Rp. {{ formatNumber(cart.jumlah * cart.harga) }}</div>
    </div>

    <div class="col-9">
      <strong>Ringkasan Pembayaran</strong>

      <div class="row">
        <div class="col-6">GrandTotal</div>
        <div class="col-3 text-right">Rp {{ formatNumber(grandTotal) }}</div>
      </div>

      <button
        class="btn btn-success"
        data-toggle="modal"
        data-target="#exampleModalCenter"
        @click="bayar"
      >
        Bayar
      </button>
      <ModalSuccess :msg="'Berhasil lakukan pembayaran'" />
    </div>
  </div>
</template>

<script>
import ModalSuccess from "../Homepage/ModalSuccess";
export default {
  components: {
    ModalSuccess: ModalSuccess,
  },
  data() {
    return {
      listCart: {},
      grandTotal: 0,
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("/lihatCart")
        .then((result) => {
          this.listCart = result.data;
          this.grandTotal = 0;
          let total = this.listCart.map((cart) => cart.jumlah * cart.harga);
          for (let i = 0; i < total.length; i++) {
            const t = total[i];
            this.grandTotal += t;
          }
        })
        .catch((err) => {});
    },
    formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    bayar() {
      axios
        .post("/makeTransaction", {
          grandTotal: this.grandTotal,
        })
        .then((result) => {
          this.loadData();
          this.$emit("hapus-cart");
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>