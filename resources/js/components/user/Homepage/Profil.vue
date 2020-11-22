<template>
  <div>
    <Navbar />
    <div class="container">
      <h1 style="margin-top: 2vh; margin-bottom: 2vh">Your Profil</h1>
      <hr style="border: 0.4px solid red" />

      <div class="row" style="margin-bottom: 4vh">
        <div class="col-8">
          <form @submit.prevent="addData()">
            <div class="form-group">
              <label for="">Nama</label>
              <input
                type="text"
                class="form-control"
                id="nama"
                placeholder="Kode"
                v-model="nama"
                disabled
              />
              <span
                class="invalid-feedback d-block"
                v-if="errors.hasOwnProperty('nama')"
              >
                {{ errors.nama[0] }}
              </span>
            </div>
            <div class="form-group">
              <label for="">No Telepon</label>
              <input
                type="text"
                class="form-control"
                id="tlp"
                placeholder="Kode"
                v-model="notlp"
                disabled
              />
              <span
                class="invalid-feedback d-block"
                v-if="errors.hasOwnProperty('noHp')"
              >
                {{ errors.noHp[0] }}
              </span>
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input
                type="text"
                class="form-control"
                id="email"
                placeholder="Kode"
                v-model="email"
                disabled
              />
              <span
                class="invalid-feedback d-block"
                v-if="errors.hasOwnProperty('email')"
              >
                {{ errors.email[0] }}
              </span>
            </div>
            <input type="hidden" name="" v-model="iduser" />
            <div class="form-group">
              <label for="">Role</label>
              <p v-if="isLogin.role == 0">User</p>
              <p v-if="isLogin.role == 1">Admin</p>
            </div>
            <div id="lanjutan" style="display: none">
              <div class="form-group">
                <label for="">Masukkan Password yang lama:</label>
                <input
                  type="password"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  v-model="pass"
                />
                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('password')"
                >
                  {{ errors.password[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for=""
                  >Masukkan Password baru (jika tidak ingin mengganti dikosongi
                  saja)</label
                >
                <input
                  type="password"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  v-model="paswbaru"
                />
                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('passbaru')"
                >
                  {{ errors.passbaru[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for=""
                  >Masukkan Confirm Password baru (jika tidak ingin mengganti
                  dikosongi saja)</label
                >
                <input
                  type="password"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  v-model="cpaswbaru"
                />
              </div>
              <button type="submit" class="btn btn-md btn-primary">
                Simpan Perubahan
              </button>
            </div>
          </form>
          <button
            class="btn btn-md btn-primary"
            id="btnEdit"
            @click="editData()"
          >
            Edit Your Profile
          </button>
        </div>
        <div class="col-4">
          <h5>History Pembelian</h5>
          <hr />
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">No</th>
                <th>Nama Dokter</th>
                <th>Tanggal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(history, index) in htrans" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ history.nama_dokter }}</td>
                <td>{{ history.tanggal }}</td>
                <td>
                  <div
                    class="btn btn-sm btn-primary"
                    @click="getDetail(history)"
                    data-toggle="modal"
                    data-target="#myModal"
                  >
                    Detail
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div
      class="modal fade show"
      id="modal-edit"
      style="display: hidden; padding-right: 16px"
      aria-modal="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Kategori</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              Kode Struk : {{ detailHtrans.id }} <br />
              Nama Dokter : {{ detailHtrans.nama_dokter }} <br />
              Total Harga : {{ detailHtrans.total }} <br />
              Tanggal : {{ detailHtrans.tanggal }} <br />

              <span
                class="invalid-feedback d-block"
                v-if="errors.hasOwnProperty('nama')"
              >
                Keterangan : {{ detailHtrans.keterangan }} <br />
              </span>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Gambar</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(obats, index) in dtrans" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>
                      <img
                        class="card-img-top"
                        style="width: 50%"
                        :src="obats.gambar"
                        alt="Card image cap"
                      />
                    </td>
                    <td>{{ obats.nama }}</td>
                    <td>{{ obats.jumlah }}</td>
                    <td>{{ obats.harga }}</td>
                    <td>{{ obats.subtotal }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>
<script>
import Navbar from "./Navbar";
export default {
  name: "Profil",
  components: {
    Navbar: Navbar,
  },
  data() {
    return {
      isLogin: {},
      htrans: [],
      detailHtrans: {},
      dtrans: [],
      link: "/api/obat/getDetail/",
      nama: "",
      email: "",
      role: 0,
      notlp: "",
      pass: "",
      paswbaru: "",
      cpaswbaru: "",
      iduser: "",
      errors: {},
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("/api/profilUser")
        .then((result) => {
          this.isLogin = result.data.userLogin;
          this.htrans = result.data.dataHtrans;
          this.nama = this.isLogin.nama;
          this.email = this.isLogin.email;
          this.notlp = this.isLogin.noHp;
          this.iduser = this.isLogin.id;
          console.log(this.nama);
        })
        .catch((err) => {});
      document.getElementById("lanjutan").style.display = "none";
      document.getElementById("btnEdit").style.display = "inline";
      document.getElementById("email").disabled = true;
      document.getElementById("nama").disabled = true;
      document.getElementById("tlp").disabled = true;

      this.pass = "";
      this.cpaswbaru = "";
      this.paswbaru = "";
    },
    getDetail(htrans) {
      //clone kategori supaya tidak merubah isi dari tabel asli
      this.detailHtrans = htrans;
      axios.get("/api/getDtrans/" + htrans.id).then((result) => {
        this.dtrans = result.data;
      });
      $("#modal-edit").modal("show");
    },
    editData() {
      document.getElementById("lanjutan").style.display = "inline";
      document.getElementById("btnEdit").style.display = "none";
      document.getElementById("email").disabled = false;
      document.getElementById("nama").disabled = false;
      document.getElementById("tlp").disabled = false;
    },
    addData() {
      let formData = new FormData();
      formData.append("id", this.iduser);
      formData.append("email", this.email);
      formData.append("nama", this.nama);
      formData.append("noHp", this.notlp);
      formData.append("password", this.pass);
      formData.append("passbaru", this.paswbaru);
      formData.append("passbaru_confirmation", this.cpaswbaru);
      // alert(this.nama);
      // alert(this.notlp);
      axios

        .post("/api/profilUser/update", formData)
        .then((result) => {
          alert("data Berhasil di ubah");
          this.loadData();
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
          //alert(this.errors[0])
        });
    },
  },
};
</script>
