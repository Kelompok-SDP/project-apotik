<template>
        <div class="card my-3 mx-1" style="max-width: 540px;">
            <div class="row no-gutters">
            <div class="col-md-12" >
                <div class="card-body" style="background-image: url('https://media.istockphoto.com/vectors/abstract-blue-geometric-medical-cross-shape-medicine-and-science-vector-id911633220?b=1&k=6&m=911633220&s=612x612&w=0&h=-kgLljK7kqrDK_wLXAXyrPPbdJKJ2fgTPH310K6D6qY='); background-position: center; background-repeat: no-repeat;">
                <h5 style="text-align:center; font-weight: bold;">{{ tag.nama }}</h5>
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
