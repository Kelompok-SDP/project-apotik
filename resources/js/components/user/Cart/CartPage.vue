<template>
  <div>
    <Navbar lokasi="home" />
    <div class="container">
      <div class="row">
        <div class="col">
          Daftar Pesanan
          <table>
            <tr>
              <td>Nama</td>
              <td>Jumlah</td>
            </tr>
            <tr v-for="cart in listCart" :key="cart.id">
              <td>
                <strong>{{ cart.nama }} </strong>
              </td>
              <td>
                <strong>{{ cart.kemasan }} </strong>
              </td>
            </tr>
          </table>
        </div>
        <div class="col">Ringkasan Pembayaran</div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
export default {
  name: "CartPage",
  components: {
    Navbar: Navbar,
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
          console.table(this.listCart);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>