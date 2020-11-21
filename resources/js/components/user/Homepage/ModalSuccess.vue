<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Berhasil</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img
              src="data:image/png;base64,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"
              alt=""
              width="150rem"
              height="150rem"
              class="mb-5"
            />
            <br />
            <span class="font-weight-bold">{{ msg }} </span>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Oke
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ModalSuccess",
  props: {
    msg: String,
  },
};
</script>

<style>
</style>