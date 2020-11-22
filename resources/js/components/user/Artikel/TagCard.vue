<template>
  <div class="card my-3 mx-1" style="max-width: 540px">
    <div class="row no-gutters">
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ tag.nama }}</h5>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TagCard",
  props: {
    tag: Object,
  },
};
</script>

<style>
</style>
