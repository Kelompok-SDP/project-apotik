<template>
  <div>
    <Navbar lokasi="home" />
    <div class="containerNew">
      <div class="row no-gutters">
        <div class="col-12 col-md-6 mt-5 card p-3">
          <div class="card-header">
            <h6 class="text-secondary card-title">Daftar Pesanan</h6>
          </div>
          <div class="d-flex justify-content-between mt-3 card-body">
            <span class="text-secondary col-3">Nama</span>
            <span class="text-secondary col-3">Jumlah</span>
            <span class="text-secondary col-2">Harga</span>
            <span class="text-secondary col-2">Delete</span>
          </div>
          <CartItem
            v-for="cartItem in listCart"
            :key="cartItem.id"
            :dataCart="cartItem"
            v-on:load-data="loadDataBaru"
          />
        </div>
        <div class="col-12 col-md-6 mt-5 card p-3">
          <div class="card-header">
            <span class="card-title">Nota Pembayaran</span>
          </div>
          <div class="d-flex mt-3">
            <span class="text-secondary col-3">Nama</span>
            <span class="text-secondary col-3">Jumlah</span>
            <span class="text-secondary col-3">Subtotal</span>
          </div>
          <CartNota ref="CartNota" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import CartItem from "./CartItem";
import CartNota from "./CartNota";
export default {
  name: "CartPage",
  components: {
    Navbar: Navbar,
    CartItem: CartItem,
    CartNota: CartNota,
  },
  data() {
    return {
      listCart: {},
    };
  },
  mounted() {
    this.loadCart();
  },
  methods: {
    loadCart() {
      axios
        .get("/lihatCart")
        .then((result) => {
          this.listCart = result.data;
          // this.loadCart();
        })
        .catch((err) => {});
    },
    loadDataBaru() {
      this.$refs.CartNota.loadData();
      this.loadCart();
    },
  },
};
</script>

<style>
.containerNew {
  width: 90%;
  margin: auto;
}
.left-side {
  border-right: 1px solid gray;
}
</style>