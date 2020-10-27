<template>
    <div>
        <Sidebar></Sidebar>
        <Navbar></Navbar>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
    </div>
    
</template>

<script>
import Navbar from './layouts/Navbar.vue';
import Sidebar from './layouts/Sidebar.vue';
export default {
    components: {
        'Navbar': Navbar,
        'Sidebar': Sidebar,
    },
    data(){
        return{
            isAdmin: false
        }
    },
}
</script>

<style>
    
</style>