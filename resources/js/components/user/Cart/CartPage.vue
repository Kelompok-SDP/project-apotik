<template>
  <div>
    <Navbar lokasi="home" />
    <div class="containerNew">
      <div class="row no-gutters">
        <div class="col-12 col-md-6 mt-5">
          <h6 class="text-secondary">Daftar Pesanan</h6>
          <div class="d-flex justify-content-between mt-3">
            <span class="text-secondary col-6">Nama</span>
            <span class="text-secondary col-3">Jumlah</span>
            <span class="text-secondary col-3">Harga</span>
          </div>
          <CartItem
            v-for="cartItem in listCart"
            :key="cartItem.id"
            :dataCart="cartItem"
          />
        </div>
        <CartNota />
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
        .post("/lihatCart", {})
        .then((result) => {
          this.listCart = result.data;
        })
        .catch((err) => {});
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