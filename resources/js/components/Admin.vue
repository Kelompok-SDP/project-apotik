<template>
    <div>
        <Sidebar @click="getCompState" ></Sidebar>
        <Navbar @click="getCompState"></Navbar>
        <div class="content-wrapper">
            <component v-bind:is="currentState"></component>
            <!-- <router-view></router-view> -->
        </div>
    </div>
    
</template>

<script>
import Navbar from './layouts/Navbar.vue';
import Sidebar from './layouts/Sidebar.vue';
import Kategori from './admin/Kategori.vue';
export default {
    components: {
        'Navbar': Navbar,
        'Sidebar': Sidebar,
        'Kategori': Kategori,
    },
    data(){
        return{
            isAdmin: false,
            currentState: '',
        }
    },
    methods:{
        getCompState(value){
            this.currentState = value;
            console.log('value parent: '+this.currentState);
        }
    }
}
</script>

<style>
    
</style>